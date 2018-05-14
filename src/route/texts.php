<?php
/**
 * App specific routes.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Show all content.
 */
$app->router->get("text/show-all", function () use ($app) {
    $data = [
        "title"  => "View all content",
    ];

    $app->db->connect();
    $sql = "SELECT * FROM content;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("text/show-all", $data);
    $app->page->render($data);
});


/**
 * Show all pages.
 */
$app->router->get("text/show-pages", function () use ($app) {
    $data = [
        "title"  => "View pages",
    ];

    $app->db->connect();

    $sql = <<<EOD
SELECT
*,
CASE
WHEN (deleted <= NOW()) THEN "isDeleted"
WHEN (published <= NOW()) THEN "isPublished"
ELSE "notPublished"
END AS status
FROM content
WHERE type=?
;
EOD;
    $res = $app->db->executeFetchAll($sql, ["page"]);

    $data["resultset"] = $res;

    $app->view->add("text/pages", $data);
    $app->page->render($data);
});


/**
 * Show all pages.
 */
$app->router->get("text/show-posts", function () use ($app) {
    $data = [
        "title"  => "View blogs",
    ];

    $app->db->connect();

    $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
ORDER BY published DESC
;
EOD;
    $res = $app->db->executeFetchAll($sql, ["post"]);

    $data["resultset"] = $res;

    $app->view->add("text/blog", $data);
    $app->page->render($data);
});

//$app->router->get("text/blog/", function () use ($app) {
$app->router->get("text/blog/{slug}", function ($slug) use ($app) {

    $data = [
        "title"  => "View blog",
    ];

    $app->db->connect();
    $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
slug = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
ORDER BY published DESC
;
EOD;
    //$slug = substr($route, 5);
    $pageContent = $app->db->executeFetch($sql, [$slug, "post"]);
    //$res = $app->db->executeFetchAll($sql, ["post"]);
    $textFilter = new \chvi17\TextFilter\TextFilter2();
    $data["textFilter"] = $textFilter;

    $data["title"] = $pageContent->title;
    $data["pageContent"] = $pageContent;
    $app->view->add("text/blogpost", $data);
    $app->page->render($data);
});

$app->router->get("text/page/{arg}", function ($arg) use ($app) {

    $data = [
        "title"  => "View page",
        "pageContent" => null,
    ];

    $textFilter = new \chvi17\TextFilter\TextFilter2();
    $data["textFilter"] = $textFilter;

    $app->db->connect();
    $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
path = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
;
EOD;

    $pageContent = $app->db->executeFetch($sql, [$arg, "page"]);
    //$res = $app->db->executeFetchAll($sql, ["post"]);
    $data["title"] = $pageContent->title;
    $data["pageContent"] = $pageContent;
    $app->view->add("text/page", $data);
    $app->page->render($data);
});


/**
 * Show all content for administration.
 */
$app->router->get("text/admin", function () use ($app) {
    $data = [
        "title"  => "Adminstration of content",
    ];

    $app->db->connect();
    $sql = "SELECT * FROM content;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("text/admin", $data);
    $app->page->render($data);
});

/**
 * Reset database to its original content.
 */
$app->router->any(["GET", "POST"], "text/reset", function () use ($app) {
    $data = [
        "title"  => "Resetting the database",
    ];

    if ($app->request->getPost("reset")) {
        $data["reset"] = true;
        //echo("in if doReset");
    }

    $app->view->add("text/reset", $data);
    $app->page->render($data);
});

/**
 * delete, will set a timestamp for delete.
 */
$app->router->any(["GET", "POST"], "text/delete", function () use ($app) {
    $data = [
        "title"  => "Delete content",
    ];

    $app->db->connect();

    $contentId = $app->request->getPost("contentId")
     ?:  $app->request->getGet("id");
    if (!is_numeric($contentId)) {
        die("Not valid for content id.");
    }

    if (hasKeyPost("doDelete")) {
        $contentId = $app->request->getPost("contentId");
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $app->db->execute($sql, [$contentId]);
        header("Location: admin");
        exit;
    }

    $sql = "SELECT id, title FROM content WHERE id = ?;";
    $pageContent = $app->db->executeFetch($sql, [$contentId]);
    $data["pageContent"] = $pageContent;
    $app->view->add("text/delete", $data);
    $app->page->render($data);
});


/**
 * edit content
 */
$app->router->any(["GET", "POST"], "text/edit", function () use ($app) {
    $data = [
        "title"  => "Edit content",
        "exception" => null,
    ];

    $app->db->connect();

    $contentId = $app->request->getPost("contentId")
     ?:  $app->request->getGet("id");
    if (!is_numeric($contentId)) {
        die("Not valid for content id.");
    }

    //if delete button in edit page is pushed
    if (hasKeyPost("doDelete")) {
        //echo("in doDelete");
        $contentId = $app->request->getPost("contentId");
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $app->db->execute($sql, [$contentId]);
        header("Location: admin");
        exit;
    } elseif (hasKeyPost("doSave")) {
        //echo("in doSave");
        $contentFilter = getPost("contentFilter"); //will get array like 0=> 'bbcode' 1=>"link" etc

        if ($contentFilter != null) { //rearrange array to wanted key => value
            $filterArrayString = array("contentFilter" => implode(",", $contentFilter));
        } else {
            $filterArrayString = array("contentFilter" => "");
        }

        //echo("contentFilter: ");
        //var_dump($contentFilter);
        //echo("filterArrayString");
        //var_dump($filterArrayString);
        $params = $filterArrayString;
        $params += getPost([
            "contentTitle",
            "contentPath",
            "contentSlug",
            "contentData",
            "contentType",
            "contentPublish",
            "contentId",
        ]);

        if (!$params["contentSlug"]) {
            $params["contentSlug"] = slugify($params["contentTitle"]);
        }

        if (!$params["contentPath"]) {
            //$params["contentPath"] = "";
            if ($params["contentType"] == "post") {
                $params["contentPath"] = null;
            } elseif ($params["contentType"] == "page") {
                $params["contentPath"] = slugify($params["contentTitle"]);
            }
        }
        //echo("params: ");
        //var_dump($params);
        //$filterArrayString["contentFilter"] = implode(",", $contentFilter);
        //$params = array_splice ($params, 4, 0, $filterArrayString); // splice filter in at position 4, doesn't keep keyname
        //$params = array_merge(array_slice($params, 0, 4),
        //            $filterArrayString,
        //            array_slice($params, 4, count($params)-4));
        //echo("params: ");
        //var_dump($params);

        try {
            $sql = "UPDATE content SET filter=?, title=?, path=?, slug=?, data=?, type=?, published=? WHERE id = ?;";
            $app->db->execute($sql, array_values($params));

            header("Location: edit?id=$contentId");
            exit;
        } catch (Exception $e) {
            $app->session->set("flash", "Got an error, update and save again! Errormessage: <br>" . $e->getMessage());
        }
    }

    $sql = "SELECT * FROM content WHERE id = ?;";
    $pageContent = $app->db->executeFetch($sql, [$contentId]);
    $data["pageContent"] = $pageContent;
    $app->view->add("text/edit", $data);
    $app->page->render($data);
});

/**
 * create new content. Add a title for a new text and send to edit
 */
$app->router->any(["GET", "POST"], "text/create", function () use ($app) {
    $data = [
        "title"  => "Create content",
    ];

    $app->db->connect();

    if (hasKeyPost("doCreate")) {
        $title = $app->request->getPost("contentTitle");
        $sql = "INSERT INTO content (title) VALUES (?);";

        $app->db->execute($sql, [$title]);
        $id = $app->db->lastInsertId();
        header("Location: edit?id=$id");
        exit;
    }

    $app->view->add("text/create", $data);
    $app->page->render($data);
});

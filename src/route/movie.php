<?php

/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    $data = [
        "title"  => "Movie database | oophp",
    ];

    $app->db->connect();

    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $data["res"] = $res;

    $app->view->add("movie/show-all", $data);
    $app->page->render($data);
});

/**
*   Reset database for testing convenience
*
*/
$app->router->any(["GET", "POST"], "movie/reset", function () use ($app) {
    $data = [
        "title"  => "Reset database | oophp",
    ];

    if ($app->request->getPost("DoReset")) {
        $data["reset"] = true;
        echo("in if doReset");
    }
    $app->view->add("movie/reset", $data);
    $app->page->render($data);
});


/**
 * Show all movies. (same as movie)
 */
$app->router->get("movie/show-all", function () use ($app) {
    $data = [
        "title"  => "Movie database | oophp",
    ];

    $app->db->connect();

    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $data["res"] = $res;

    $app->view->add("movie/show-all", $data);
    $app->page->render($data);
});


/**
 * Search on title page, get search part
 */
$app->router->get("movie/search-title", function () use ($app) {
    $data = [
        "title"  => "Search title in Movie database | oophp",
        "searchTitle" => "%%",
        "action" => "movie/show-search-title",
    ];

    $app->view->add("movie/search-title", $data);
    $app->page->render($data);
});

/**
 * Search on title page, present result.
 */
$app->router->post("movie/show-search-title", function () use ($app) {
    $data = [
        "title"  => "Search title in Movie database | oophp",
    ];

    $app->db->connect();

    $searchTitle = $app->request->getPost("searchTitle");
    $sql = "SELECT * FROM movie;";
    if ($searchTitle) {
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $res = $app->db->executeFetchAll($sql, [$searchTitle]);
    } else {
        $res = $app->db->executeFetchAll($sql);
    }
    $data["res"] = $res;

    $app->view->add("movie/show-all", $data);
    $app->page->render($data);
});

/**
 * Search on year page, get search part
 */
$app->router->get("movie/search-year", function () use ($app) {
    $data = [
        "title"  => "Search year in Movie database | oophp",
        "action" => "movie/show-search-year",
    ];

    $app->view->add("movie/search-year", $data);
    $app->page->render($data);
});

/**
 * Search on year page, present result.
 */
$app->router->post("movie/show-search-year", function () use ($app) {
    $data = [
        "title"  => "Search year in Movie database | oophp",
    ];

    $app->db->connect();

    $startYear = $app->request->getPost("year1");
    $endYear = $app->request->getPost("year2");

    if ($startYear && $endYear) {
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$startYear, $endYear]);
    } elseif ($startYear) {
        $sql = "SELECT * FROM movie WHERE year >= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$startYear]);
    } elseif ($endYear) {
        $sql = "SELECT * FROM movie WHERE year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$endYear]);
    }

    $data["res"] = $resultset;

    $app->view->add("movie/show-all", $data);
    $app->page->render($data);
});


/**
 * Select movie for update or deletion
 */
$app->router->any(["GET", "POST"], "movie/select", function () use ($app) {
    $data = [
        "title"  => "Select a movie",
        "action" => "movie/selectAction",
    ];

    $movieId = $app->request->getPost("movieId");
    if ($movieId != null) {
        //$_SESSION["movieId"] = $movieId;
        $app->session->set("movieId", $movieId);
    }
    // om delete är valt
    if ($app->request->getPost("doDelete")) {
        $app->db->connect();
        $sql = "DELETE FROM movie WHERE id = ?;";
        //echo("sql:" . $sql);
        $app->db->execute($sql, [$movieId]);
        header("Location: show-all");
        exit;
    //om edit är valt
    } elseif ($app->request->getPost("doEdit") && is_numeric($movieId)) {
        header("Location: edit-movie");
        exit;
    }

    $app->db->connect();
    $sql = "SELECT id, title FROM movie;";
    $movies = $app->db->executeFetchAll($sql);

    $data["movies"] = $movies;

    $app->view->add("movie/select-movie", $data);
    $app->page->render($data);
});

/**
 * Edit movie (after movie/select)
 */
$app->router->any(["GET", "POST"], "movie/edit-movie", function () use ($app) {
    $data = [
        "title"  => "Edit a movie",
        "action" => "movie/edit-movie",
    ];
    $app->db->connect();

    $movieId = $app->session->get("movieId");
    $movieTitle = $app->request->getPost("movieTitle");
    $movieYear  = $app->request->getPost("movieYear");
    $movieImage = $app->request->getPost("movieImage");

    if ($app->request->getPost("doSave")) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        header("Location: show-all");
        exit;
    }

    $sql = "SELECT * FROM movie WHERE id = ?;";
    $movie = $app->db->executeFetchAll($sql, [$movieId]);
    $movie = $movie[0];
    $data["movie"] = $movie;

    $app->view->add("movie/edit-movie", $data);
    $app->page->render($data);
});

 /**
  * Add movie
  */
$app->router->any(["GET", "POST"], "movie/add-movie", function () use ($app) {
    $data = [
         "title"  => "Add a movie",
         "action" => "movie/add-movie",
     ];
    $app->db->connect();

    $movieId = $app->session->get("movieId");
    $movieTitle = $app->request->getPost("movieTitle") ?: "title";
    $movieYear  = $app->request->getPost("movieYear") ?: "2018";
    $movieImage = $app->request->getPost("movieImage") ?: "img/noimage.png";

    if ($app->request->getPost("doSave")) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        header("Location: show-all");
        exit;
    }

     // save button is not pushed, add a default film to present
    $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
    $app->db->execute($sql, ["A title", 2018, "img/noimage.png"]);
    $movieId = $app->db->lastInsertId();
    $app->session->set("movieId", $movieId);

    $sql = "SELECT * FROM movie WHERE id = ?;";
    $movie = $app->db->executeFetchAll($sql, [$movieId]);
    $movie = $movie[0];
    $data["movie"] = $movie;

    $app->view->add("movie/edit-movie", $data);
    $app->page->render($data);
});

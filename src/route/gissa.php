<?php
/**
 * Specific route class for Guess my number.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Guess my number with GET.
 */
$app->router->get("gissa/get", function () use ($app) {

    // For the view
    $data = [
        "title" => "Gissa mitt nummer med GET | oophp",
        "method" => "GET",
    ];

    //incoming with GET
    $number = isset($_GET["number"]) ? htmlentities($_GET["number"]) : -1;
    $tries = isset($_GET["tries"]) ? htmlentities($_GET["tries"]) : 6;
    $guess = isset($_GET["guess"]) ? htmlentities($_GET["guess"]) : null;

    // Start up the game
    try {
        $game = new \chvi17\Guess\Guess($number, $tries);
        // Reset the game.
        if (isset($_GET["reset"])) {
            $game->random();
        }

        // Do a guess
        $res = null;
        if (isset($_GET["doGuess"])) {
            $res = $game->makeGuess($guess);
        }
    } catch (Exception $e) {
        echo "Got exception: " . get_class($e) . "<hr>";
        echo "Message: " . $e->getMessage() . "<hr>";
    }

    //prepare date
    $data["game"] = $game;
    $data["res"] = $res;
    $data["guess"] = $guess;

    //add view and render page
    $app->view->add("guess/gissa", $data);
    $app->page->render($data);
});

/**
 * Guess my number with POST.
 */
$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {

    // For the view
    $data = [
        "title" => "Gissa mitt nummer med POST | oophp",
        "method" => "POST",
    ];

    // Get incoming
    $number = $_POST["number"] ?? -1;
    $tries = $_POST["tries"] ?? 6;
    $guess = $_POST["guess"] ?? null;

    // Start up the game
    try {
        $game = new \chvi17\Guess\Guess($number, $tries);
        // Reset the game.
        if (isset($_POST["reset"])) {
            $game->random();
        }

        // Do a guess
        $res = null;
        if (isset($_POST["doGuess"])) {
            $res = $game->makeGuess($guess);
        }
    } catch (Exception $e) {
        echo "Got exception: " . get_class($e) . "<hr>";
        echo "Message: " . $e->getMessage() . "<hr>";
    }

    //prepare date
    $data["game"] = $game;
    $data["res"] = $res;
    $data["guess"] = $guess;

    //add view and render page
    $app->view->add("guess/gissa", $data);
    $app->page->render($data);
});

/**
 * Guess my number with SESSION.
 */
$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {

    session_name(md5(__FILE__));
    session_start();
    // For the view
    $data = [
        "title" => "Gissa mitt nummer med SESSION | oophp",
        "method" => "POST",
    ];
    try {
        //incoming POST data
        $guess = isset($_POST["guess"]) ? $_POST["guess"] : null;

        //get the game if exists or create a new game
        if (isset($_SESSION["game"])) {
            $game = $_SESSION["game"];
        } else {
            $game = new \chvi17\Guess\Guess();
            $_SESSION["game"] = $game;
        }

        // Reset the game.
        if (isset($_POST["reset"]) || isset($_GET["reset"])) {
            $game->random();
            $_SESSION["game"] = null;

            header("Location: session");
            exit;
        }

        // Do a guess
        $res = null;
        if (isset($_POST["doGuess"])) {
            $res = $game->makeGuess($guess);
            $_SESSION["game"] = $game;
        }
    } catch (Exception $e) {
        echo "Got exception: " . get_class($e) . "<hr>";
        echo "Message: " . $e->getMessage() . "<hr>";
    }

    //prepare data
    $data["game"] = $game;
    $data["res"] = $res;
    $data["guess"] = $guess;

    //add view and render page
    $app->view->add("guess/gissa", $data);
    $app->page->render($data);
});


/**
* Showing message Hello World, rendered within the page layout.
 */
$app->router->get("lek/hello-world-wrap", function () use ($app) {
    $data = [
        "title" => "Show hello world within page layout | oophp",
        "class" => "hello-world",
        "content" => "Hello World",
    ];

    $app->view->add("content/oophp/default", $data);

    $app->page->render($data);
});

<?php
/**
 * Specific routes for the game Play100.
 */
//var_dump(array_keys(get_defined_vars()));

/**
* initiation of game
*/
$app->router->get("lek/init100", function () use ($app) {
    $data = [
        "method" => "get",
        "action" => "lek/start100",
    ];

    $app->view->add("lek/Init100", $data);
    $app->page->render($data);
});

/**
* present starting top-values and who should start
*/
$app->router->get("lek/start100", function () use ($app) {
    $data = [
        "method" => "post",
        "action" => "lek/playing100",
    ];

    //set players name, check who will start
    $playerName = $app->request->getGet("name");
    $game = new \chvi17\Dice\Game100();

    $game->setPlayerName("Computer", 0);
    $game->setPlayerName($playerName, 1);
    $game->reset();
    $game->checkGameStarter();
    $app->session->set("Game100", $game);

    $app->view->add("lek/Start100", $data);
    $app->page->render($data);
});

/**
 * playing 100
 */
$app->router->any(["GET", "POST"], "lek/playing100", function () use ($app) {

    $game = $app->session->get("Game100");
    $computerHand = 0;
    $computerSum = 0;
    $gameStatus = "";

    $roundSum = 0;
    $player0 = $game->getPlayer(0);
    $player1 = $game->getPlayer(1);

    $isReset = $app->request->getPost("isReset") ?
        $app->request->getPost("isReset") : false;

    // if computer result was previously presented
    $computerAction =  $app->request->getPost("ComputerAction") ?
        $app->request->getPost("ComputerAction") : "";
    // if player has pushed save/continue button
    $playerAction =  $app->request->getPost("PlayerAction") ?
        $app->request->getPost("PlayerAction") : "";

    // if the winner was presented
    if ($app->request->getPost("Ending")) {
            $game->reset();
            $app->response->redirect("lek/init100");
    }

    if ($computerAction == "Save" || $computerAction == "Reset" || $playerAction == "Reset") {
        $game->setNextPlayer();
    }
    if ($playerAction == "Save") {
        //save and check if we have a winner
        if ($game->save() == "Winner") {
            $gameStatus = "Winner";
        } else { //no winner yet
            $game->setNextPlayer();
        }
    }
    // if to play
    if ($app->request->getPost("playing") && $gameStatus!= "Winner") {
        //är det datorn som spelar?
        if ($game->getCurrentPlayer() == 0) {
            //datorn spelar
            $computerHand = $game->playGame();
            $computerSum += $player0->getHandSum();

            //om 1:a så blir det reset
            $isReset = $game->isResultToBeReset();
            if ($isReset == true) {
                $computerAction = "Reset";
                $computerSum = 0;
            } else {
                //continue or save?
                $computerAction = $game->continueOrSave($player1->getResult());
                if ($computerAction == "Save") {
                    if ($game->save() == "Winner") {
                        $gameStatus = "Winner";
                    }
                } else {
                    $computerSum = $game->getRoundSum();
                }
            }
        } else {
            //spelaren spelar
            //slå tärningarna
            $game->playGame();
            //om 1:a så blir det reset
            $isReset = $game->isResultToBeReset();
        }
    }

    //prepare data
    $data["game"] = $game;
    $data["status"] = $gameStatus;
    $data["computerHand"] = $computerHand;
    $data["computerSum"] = $computerSum;
    $data["computerAction"] = $computerAction;
    $data["playerAction"] = $playerAction;
    $data["isReset"] = ($isReset  == true ? "true" : "false");

    $app->session->set("Game100", $game);

    //add view and render page
    $app->view->add("lek/Play100", $data);
    $app->page->render($data);
});

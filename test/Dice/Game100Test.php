<?php

namespace chvi17\Dice;

/**
 * Test cases for class Histogram.
 */
class Game100Test extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected default properties
     * @return void
     */
    public function testCreateDefaultGame100()
    {
        //default values
        $game = new Game100();

        $this->assertInstanceOf("\chvi17\Dice\Game100", $game);
        $this->assertEquals(2, $game->getNrOfPlayers());
        $this->assertEquals(0, $game->getCurrentPlayer());
        $this->assertEquals(0, $game->getRoundSum());
        $this->assertNotNull($game->getPlayer(0));
        $this->assertNotNull($game->getPlayer(1));
        $this->assertNull($game->getPlayer(2));
        //histogram is tested elsewhere
    }

    /**
     * Test case to construct object and verify that the object
     * has the expected properties
     * @return void
     */
    public function testCreateGame100()
    {
        //not the default values
        $game = new Game100(2, 1);

        $this->assertInstanceOf("\chvi17\Dice\Game100", $game);
        $this->assertEquals(1, $game->getNrOfPlayers());
    }

    /**
    *   testdata provider for testCreateGame
    *   @return [] testtitle, [$nrOfDices, $nrOfPlayers, $expDices, $expPlayers]
    */
    public function gameTestDataProvider()
    {
        return [
            'correct parameters'  => [2, 5, 2, 5],
            'wrong parameters bool' => [true, false, 5, 2],
            'wrong parameters null' => [null, null, 5, 2],
            'wrong parameters string'  => ["noInteger", "notAnInt", 5, 2],
            "wrong parameters float" => [5.6, 0.5, 5, 2],
        ];
    }

    /**
     * Test case to construct object and verify that the object
     * has the expected properties
     * @param int $nrOfDices, the nr of dices sent in to constructor
     * @param int $nrOfPlayers, the nr of Players sent in to constructor
     * @param int $expDices, the expected nr Of Dices
    *  @param int $expPlayers, the expected nr Of Players
     * @return void
     *  @dataProvider gameTestDataProvider
     */
    public function testCreateGame($nrOfDices, $nrOfPlayers, $expDices, $expPlayers)
    {
        $game = new Game100($nrOfDices, $nrOfPlayers);
        $this->assertInstanceOf("\chvi17\Dice\Game100", $game);
        $this->assertEquals($expPlayers, $game->getNrOfPlayers());
        $rolls = $game->playGame();
        $this->assertEquals($expDices, count($rolls));
    }

    /**
     * Test case to verify that the method setNextPlayer is working
     * setNextPlayer will also use method findNextPlayer
     * @return void
     */
    public function testSetNextPlayer()
    {
        //create game with  2 dices, 3 players
        $game = new Game100(2, 3);

        $this->assertEquals(3, $game->getNrOfPlayers());
        //in constructor, 0 is set to currentPlayer
        $this->assertEquals(0, $game->getCurrentPlayer());

        //setNextPlayer 3 times, verify order
        $game->setNextPlayer();
        $this->assertEquals(1, $game->getCurrentPlayer());

        $game->setNextPlayer();
        $this->assertEquals(2, $game->getCurrentPlayer());

        $game->setNextPlayer();
        $this->assertEquals(0, $game->getCurrentPlayer());
    }

    /**
     * Test case to verify that the method isResultToBeReset is working
     * @return void
     */
    public function testisResultToBeReset()
    {
        //create game with  5 dices, 2 players
        $game = new Game100();

        //the method to test should check if the currentPlayer has a 1 in its DiceHand
        //prepare expected result
        //$player = $game->getPlayer($game->getCurrentPlayer());
        //play until values contains a 1
        $expResetResult = 0;
        while ($expResetResult == 0) {
            $handValues = $game->playGame();
            if (in_array(1, $handValues)) {
                $expResetResult = 1;
                $this->assertEquals($expResetResult, $game->isResultToBeReset());
            } else {
                $this->assertEquals($expResetResult, $game->isResultToBeReset());
            }
        }
    }


    /**
    *   testdata provider for testgetPlayer
    *   @return [] testtitle, [$playerId]
    */
    public function getPlayerTestDataProvider()
    {
        return [
            'too high playerIndex' => [3],
            'too low playerIndex' => [-1],
            'playerIndex is null' => [null],
            'playerIndex is a string'  => ["noInteger"],
            "playerIndex is a float" => [5.6],
            "playerIndex is a bool" => [false],
        ];
    }

    /**
     * Test case to get player
     *  @param int $playerIdToGet
     *
     * @return void
     *  @dataProvider getPlayerTestDataProvider
     */
    public function testgetPlayer($playerIdToGet)
    {
        //create a game with default values (2 players)
        $game = new Game100();

        $player = $game->getPlayer($playerIdToGet);
        $this->assertNull($player);
    }

    /**
     * Test case to set player's name
     * @return void
     */
    public function testSetName()
    {
        //create a game with default values (2 players)
        $game = new Game100();
        //the players will get index names for default

        $player0 = $game->getPlayer(0);
        $player1 = $game->getPlayer(1);
        $namePlayer0 = $player0->getName();
        $this->assertEquals(0, $namePlayer0);

        //try to set name then (default values)
        $game->setPlayerName();
        $namePlayer0 = $player0->getName();
        $this->assertEquals("Computer", $namePlayer0);

        //set another name
        $game->setPlayerName("Peter", 1);
        $namePlayer1 = $player1->getName();
        $this->assertEquals("Peter", $namePlayer1);
    }

    /**
    *   testdata provider for testSetName
    *   @return [] testtitle, [$name]
    */
    public function negativeNameProvider()
    {
        return [
            'null name'  => [null],
            'int name' => [5],
            'float name' => [0.4],
            'bool name'  => [true],
        ];
    }


    /**
     * Test case to set player's name
     * @param string name
     * @return void
     * @dataProvider negativeNameProvider
     */
    public function testSetNameNegativeNameTests($name)
    {
        //create a game with default values (2 players)
        $game = new Game100();
        //the players will get index names for default

        $player0 = $game->getPlayer(0);
        $namePlayer0 = $player0->getName();
        $this->assertEquals(0, $namePlayer0);

        //try to set wrong types of name then (no change of names)
        $game->setPlayerName($name, 0);
        $namePlayer0 = $player0->getName();
        $this->assertEquals("0", $namePlayer0);
    }

    /**
    *   testdata provider for testSetName
    *   @return [] testtitle, [$id]
    */
    public function negativeIdProvider()
    {
        return [
            'too high Id'  => [5],
            'too low id' => [-10],
            'float id' => [0.4],
            'bool id'  => [true],
            'string id' => ["notAnInteger"],
            'null id' => [null]
        ];
    }


    /**
     * Test case to set player's name
     * @param string name
     * @return void
     * @dataProvider negativeIdProvider
     */
    public function testSetNameNegativeIdTests($id)
    {
        //create a game with 1 player
        $game = new Game100(1, 1);
        //the players will get index names for default

        $player0 = $game->getPlayer(0);
        $namePlayer0 = $player0->getName();
        $this->assertEquals(0, $namePlayer0);

        //try to set wrong types of name then (no change of names)
        $game->setPlayerName("new name", $id);

        $this->assertEquals(1, $game->getNrOfPlayers());
        $namePlayer0 = $player0->getName();
        //verify unchanged name
        $this->assertEquals("0", $namePlayer0);
    }

    /**
     * Test case to verify the handling of roundSum
     *
     * @return void
     */
    public function testRoundSumHandling()
    {
        //create a game with default values (2 players)
        $game = new Game100();

        $this->assertEquals(0, $game->getRoundSum());

        //playGame will add some value to RoundSum
        $game->playGame();
        $this->assertNotEquals(0, $game->getRoundSUm());

        //reset will clear roundsum again
        $game->reset();
        $this->assertEquals(0, $game->getRoundSUm());

        //save will also clear roundsum, play again and save
        $game->playGame();
        $this->assertNotEquals(0, $game->getRoundSUm());
        $game->save();
        $this->assertEquals(0, $game->getRoundSUm());

        //if we have a 1 in the hand, the roundsum will be reset
        // when calling isResultToBeReset
        $contains1 = 0;
        while ($contains1 == 0) {
            $handValues = $game->playGame();
            if (in_array(1, $handValues)) {
                $contains1 = 1;
                $game->isResultToBeReset();

                $this->assertEquals(0, $game->getRoundSum());
            } else {
                $game->isResultToBeReset();
                $this->assertNotEquals(0, $game->getRoundSum());
            }
        }
    }

    /**
     * Test case to verify reset
     *
     * @return void
     */
    public function testReset()
    {
        //create a game with 1 player
        $game = new Game100(1, 1);

        //play game and save to get some result
        $game->playGame();
        $game->save();
        $player = $game->getPlayer(0);
        $this->assertNotEquals(0, $player->getResult());
        $this->assertNotEquals("", $game->showHistogram(0));

        //do reset, verify result
        $game->reset();
        $this->assertEquals(0, $player->getResult());
        $this->assertEquals(0, $game->getCurrentPlayer());
        $this->assertEquals(0, $game->getRoundSum());
        $print = $game->showHistogram(0);

        $this->assertEquals(0, substr_count($print, "*"));
    }

    /**
     * Test case to verify Save
     *
     * @return void
     */
    public function testSave()
    {
        //create a game with 1 player
        $game = new Game100(1, 1);

        //get player
        $player = $game->getPlayer(0);

        //play game
        $playerSum = $game->getRoundSum();

        //save once, not a winner yet
        $answer = $game->save();
        $this->assertEquals("", $answer);
        $this->assertEquals($game->getRoundSum(), $player->getResult());
        //play until reaching GOAL
        while ($playerSum <= 100) {
            $game->playGame();
            $playerSum = $game->getRoundSum();
        }
        $this->assertEquals("Winner", $game->save());
        //$this->assertGreaterThanOrEqual(100, $game->getRoundSum());
    }

    /**
     * Test case to verify checkGameStarter
     *
     * @return void
     */
    public function testCheckGameStarter()
    {
        //create a game with 3 players
        $game = new Game100(1, 3);

        //calculate player with highest topDice
        //get players
        $player0 = $game->getPlayer(0);
        $player1 = $game->getPlayer(1);
        $player2 = $game->getPlayer(2);
        //get each players topDice
        $topDices[0] = $player0->topDice();
        $topDices[1] = $player1->topDice();
        $topDices[2] = $player2->topDice();

        //var_dump($topDices);
        //$keys = array_keys($topDices, max($topDices));
        $topKeyIndex = array_search(max($topDices), $topDices);

        //assert that checkGameStarter returns correct index
        $this->assertEquals($topKeyIndex, $game->checkGameStarter());
    }

    /**
     * Test case to verify checkShowHistogram
     * @param int $playerId (wrong types)
     * @return void
     * @dataProvider negativeIdProvider
     */
    public function testShowHistogramNegativeTest($playerId)
    {
        //create a game with 1 player
        $game = new Game100(1, 1);
        $print = $game->showHistogram($playerId);
        $this->assertEquals("", $print);
    }

    /**
    *   testdata provider for testSetName
    *   @return [] testtitle, [$result, $expectedAnswer]
    */
    public function resultProvider()
    {
        return [
            'low result'  => [74, "Save"],
            'result limit' => [75, "Continue"],
            'high result' => [76, "Continue"],
        ];
    }

    /**
     * Test case to verify continueOrSave
     * @param integer $otherResult
     * @param string $answer the expected recommendation
     * @return void
     * @dataProvider resultProvider
     */
    public function testContinueOrSaveWithOthersResult($otherResult, $answer)
    {
        $game = new Game100(1, 2);
        //should continue when otherPlayers result >= 75, otherwice save
        $recommendation = $game->continueOrSave($otherResult);
        $this->assertEquals($answer, $recommendation);
    }

    /**
     * Test case to verify continueOrSave
     * @return void
     */
    public function testContinueOrSaveWithOwnResult()
    {
        //lets have 10 dices
        $game = new Game100(10, 2);
        //$player = $game->getPlayer(0);

        $game->playGame();
        $roundSum = $game->getRoundSum();
        //verify recommendation is save if other player has lower than 75
        $this->assertEquals("Save", $game->continueOrSave(0));

        //lets get a higher roundSum
        while ($roundSum <= 100) {
            $game->playGame();
            if ($game->getRoundSum() < 100) {
                $this->assertEquals("Continue", $game->continueOrSave(80));
            } else {
                $this->assertEquals("Save", $game->continueOrSave(80));
            }
            $roundSum = $game->getRoundSum();
        }
        $this->assertEquals("Save", $game->continueOrSave(80));
    }
}

<?php

namespace chvi17\Dice;

/**
 * Test cases for class Guess.
 */
class PlayerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected default properties
     * @return void
     */
    public function testCreateDefaultPlayer()
    {
        //default values
        $player = new Player();
        $this->assertInstanceOf("\chvi17\Dice\Player", $player);
        $this->assertEquals("Player", $player->getName());
        $this->assertEquals(0, $player->getResult());

        $dice = $player->getDice();
        $this->assertNotNull($dice);
        $this->assertEquals(5, count($player->checkHand()));
    }

    /**
    *   testdata provider for testCreatePlayer
    *   @return [] testtitle, [$name, $nrOfDices, $expName, $expNrOfDices]
    */
    public function playerTestDataProvider()
    {
        return [
            'correct values'  => ["Anna", 2, "Anna", 2],
            'wrong name parameter int' => [5, 10, "Player", 10],
            'wrong parameters bool' => [true, false, true, 5], //why is it true?
            'wrong int parameter null' => ["", null, "", 5],
            'wrong nrOfDices parameter string'  => [5.6, "notAnInt", "5.6", 5]
        ];
    }

    /**
     *  Test case to construct object and verify that the object
     *  has the expected properties
     *  @param int $name the Players name
     *  @param int $nrOfDices the nr Of Dices
     *  @param int $expName the expected Players name
     *  @param int $expNrOfDices the expected nr Of Dices
     *  @return void
     *  @dataProvider playerTestDataProvider
     */
    public function testCreatePlayer($name, $nrOfDices, $expName, $expNrOfDices)
    {
        $player = new Player($name, $nrOfDices);
        $this->assertInstanceOf("\chvi17\Dice\Player", $player);
        $this->assertEquals($expName, $player->getName());
        $this->assertEquals($expNrOfDices, count($player->checkHand()));
    }

    /**
     * Test case to setName and verify with getName
     * @return void
     */
    public function testSetName()
    {
        //preparation
        $player = new Player();
        $this->assertInstanceOf("\chvi17\Dice\Player", $player);
        $this->assertEquals("Player", $player->getName());

        //test
        $player->setName("Herman");

        //assert
        $this->assertEquals("Herman", $player->getName());
    }

    /**
     * Test case to verify result handling
     * @return void
     */
    public function testResultHandling()
    {
        //preparation
        $player = new Player();
        $this->assertInstanceOf("\chvi17\Dice\Player", $player);
        $this->assertEquals(0, $player->getResult());

        //test addResult
        $player->addResult(25);
        $this->assertEquals(25, $player->getResult());

        //test add wrong resulttype
        $player->addResult("notAnInt");
        $this->assertEquals(25, $player->getResult());
        $player->addResult(false);
        $this->assertEquals(25, $player->getResult());
        $player->addResult(null);
        $this->assertEquals(25, $player->getResult());
        $player->addResult(0.5);
        $this->assertEquals(25, $player->getResult());

        //test resetResult
        $player->resetResult();
        $this->assertEquals(0, $player->getResult());
    }

    /**
     * Test case to verify result handling
     * @return void
     */
    public function testHandMethods()
    {
        //preparation
        $player = new Player();
        $this->assertInstanceOf("\chvi17\Dice\Player", $player);
        $this->assertEquals(0, $player->getResult());
        $startValues = $player->checkHand();

        //test to play, verify hand values are changed
        $player->play();
        $values = $player->checkHand();
        $this->assertNotEquals($startValues, $values);

        //verify getHandSum
        $handSum = $player->getHandSum();
        $this->assertEquals(array_sum($values), $handSum);

        //verify topDice
        $top = $player->topDice();
        $this->assertEquals(max($values), $top);
    }
}

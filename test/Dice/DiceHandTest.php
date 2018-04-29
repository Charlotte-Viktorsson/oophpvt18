<?php

namespace chvi17\Dice;

/**
 * Test cases for class Guess.
 */
class DiceHandTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Test case to construct object and verify that the object
     * has the expected default properties
     * @return void
     */
    public function testCreateDefaultDiceHand()
    {
        //default values
        $hand = new DiceHand();
        $this->assertInstanceOf("\chvi17\Dice\DiceHand", $hand);
        $values = $hand->values();
        $this->assertEquals(5, count($values));
        $this->assertEquals(array_sum($values), $hand->sum());
        $this->assertEquals(round(array_sum($values)/count($values), 2), $hand->average());
    }

    /**
     * Test case to construct object and verify that the object
     * has the expected properties
     * @return void
     */
    public function testCreateDiceHand()
    {
        //explicit values
        $hand = new DiceHand(8);
        $this->assertInstanceOf("\chvi17\Dice\DiceHand", $hand);
        $values = $hand->values();
        $this->assertEquals(8, count($values));
        $this->assertEquals(array_sum($values), $hand->sum());
        $this->assertEquals(round(array_sum($values)/count($values), 2), $hand->average());
    }

    /**
     * Test case to construct object and verify that the object
     * has the expected properties though wrong call to constructor
     * @return void
     */
    public function testCreateDiceHandWithWrongParameter()
    {
        //explicit values
        $hand = new DiceHand("åtta");
        $this->assertInstanceOf("\chvi17\Dice\DiceHand", $hand);
        $values = $hand->values();
        $this->assertEquals(5, count($values));
        $this->assertEquals(array_sum($values), $hand->sum());
        $this->assertEquals(round(array_sum($values)/count($values), 2), $hand->average());
    }

    /**
     * Test case to count the top Dice value
     * @return void
     */
    public function testTop()
    {
        //default values
        $hand = new DiceHand();
        $this->assertInstanceOf("\chvi17\Dice\DiceHand", $hand);
        $values = $hand->values();
        $this->assertEquals(max($values), $hand->top());
    }

    /**
     * Test case to get the Dice
     * @return void
     */
    public function testGetDice()
    {
        //default values
        $hand = new DiceHand();
        $this->assertInstanceOf("\chvi17\Dice\DiceHand", $hand);
        $dice = $hand->getDice();
        $this->assertInstanceOf("\chvi17\Dice\DiceHistogram", $dice);
    }
}

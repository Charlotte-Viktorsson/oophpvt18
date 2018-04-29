<?php

namespace chvi17\Dice;

/**
 * Test cases for class Guess.
 */
class DiceHistogramTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected default properties
     * @return void
     */
    public function testCreateDefaultDiceHistogram()
    {
        //default values
        $dice = new DiceHistogram();
        $this->assertInstanceOf("\chvi17\Dice\DiceHistogram", $dice);
        $this->assertEquals(6, $dice->getSize());
        $this->assertEquals(1, $dice->getNr());
    }

    /**
     * Test case to getHistogramMax of the dice.
     */
    public function testGetHistogramMax()
    {
        $dice = new DiceHistogram();
        $value = $dice->getHistogramMax();
        $this->assertEquals("6", $value);
    }

    /**
     * Test case to roll the dice.
     */
    public function testRoll()
    {
        // a histogram dice
        $dice = new DiceHistogram();
        $rolledNr = $dice->roll();
        $this->assertLessThanOrEqual(10, $rolledNr);
        $this->assertGreaterThan(0, $rolledNr);
    }

    /**
     * Test case to reset the dice.
     */
    public function testReset()
    {
        // a histogram dice
        $dice = new DiceHistogram();
        $dice->resetHistogramSerie();
        $serie = $dice->getHistogramSerie();
        $expectedSerie = [];
        $this->assertEquals($serie, $expectedSerie);
    }


    /**
     * Test case to getHistogramMin of the dice.
     */
    public function testGetHistogramMin()
    {
        $dice = new DiceHistogram();
        $value = $dice->getHistogramMin();
        $this->assertEquals("1", $value);
    }
}

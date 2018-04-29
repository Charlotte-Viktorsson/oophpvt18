<?php

namespace chvi17\Dice;

/**
 * Test cases for class Dice.
 */
class DiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected default properties
     * @return void
     */
    public function testCreateDefaultDice()
    {
        //default values
        $dice = new Dice();
        $this->assertInstanceOf("\chvi17\Dice\Dice", $dice);
        $this->assertEquals(6, $dice->getSize());
        $this->assertEquals(1, $dice->getNr());
    }

    /**
    *   testdata provider for Dice constructor
    *   @return [] testtitle, [$guess, $expectedSize]
    */
    public function diceTestDataProvider()
    {
        return [
            'size 0'  => [0, 0],
            'size 30' => [30, 30],
            'not-a-size'  => ["a", 6],
            'null'  => [null, 6]
        ];
    }

    /**
     * Test case to construct object and verify that the object
     * has the expected properties due various ways of constructing
     * it.
     * @param integer $size
     * @param integer $expectedSize
     * @return void
     * @dataProvider diceTestDataProvider
     */
    public function testCreateDice($size, $expectedSize)
    {
        //default values
        $dice = new Dice($size);
        $this->assertInstanceOf("\chvi17\Dice\Dice", $dice);
        //$this->assertEquals($expectedSize, $dice->getSize());
        $this->assertEquals(1, $dice->getNr());
    }

    /**
     * Test case to roll the dice.
     */
    public function testRoll()
    {
        // a Dice with only one side, random must be 1
        $dice = new Dice(1);
        $rolledNr = $dice->roll();
        $this->assertEquals(1, $rolledNr);

        // a dice with 10 sides, roll result should be between 1 and 10
        $dice = new Dice(10);
        $rolledNr = $dice->roll();
        $this->assertLessThanOrEqual(10, $rolledNr);
        $this->assertGreaterThan(0, $rolledNr);
    }
}

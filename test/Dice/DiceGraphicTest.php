<?php

namespace chvi17\Dice;

/**
 * Test cases for class Guess.
 */
class DiceGraphicTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected default properties
     * @return void
     */
    public function testCreateDefaultDiceGraphic()
    {
        //default values
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\chvi17\Dice\DiceGraphic", $dice);
        $this->assertEquals(6, $dice->getSize());
        $this->assertEquals(1, $dice->getNr());
    }

    /**
     * Test case to roll the dice.
     */
    public function testgraphic()
    {
        $dice = new DiceGraphic();
        //default will be 1
        $representation = $dice->graphic();
        $this->assertEquals("dice-1", $representation);
    }
}

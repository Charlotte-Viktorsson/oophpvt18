<?php

namespace chvi17\Dice;

/**
 * Test cases for class Histogram.
 */
class HistogramTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected default properties
     * @return void
     */
    public function testCreateDefaultHistogram()
    {
        //default values
        $hg = new Histogram();
        $this->assertInstanceOf("\chvi17\Dice\Histogram", $hg);

        //prepare object to do histogram on
        $diceData = new DiceHistogram();
        $this->assertEquals(6, $diceData->getSize());
        $this->assertEquals(1, $diceData->getNr());
    }

    /**
    *   test injection and getSerie behaves ok.
    *
    */
    public function testInjectionAndGetSerie()
    {
        //preparations
        $hg = new Histogram();

        //prepare object to do histogram on
        $diceData = new DiceHistogram();
        //create some values in the serie
        $diceData->roll();
        $diceValue1 = $diceData->getNr();
        $diceData->roll();
        $diceValue2 = $diceData->getNr();

        //injectData
        $hg->injectData($diceData);

        //check getSerie
        $serie = $hg->getSerie();

        //assert injected serie follows the rolling
        $this->assertEquals($diceValue1, $serie[0]);
        $this->assertEquals($diceValue2, $serie[1]);
    }

    /**
    *   test injection and getSerie behaves ok.
    *
    */
    public function testInjectionAndResetSerie()
    {
        //preparations
        $hg = new Histogram();

        //prepare object to do histogram on
        $diceData = new DiceHistogram();
        //create a value in the serie
        $diceData->roll();
        $diceValue1 = $diceData->getNr();

        //injectData
        $hg->injectData($diceData);

        //check serie before reset
        $serie = $hg->getSerie();

        //assert injected serie contians one value
        $this->assertEquals($diceValue1, $serie[0]);
        $this->assertEquals(1, count($serie));

        //reset
        $hg->resetHistogramSerie($diceData);

        //check serie after reset
        $serie = $hg->getSerie();
        //var_dump($diceData);
        //var_dump($hg);

        //assert serie is empty
        $this->assertEquals(0, count($serie));
    }

    /**
    *   test getasText.
    */
    public function testGetAsText()
    {
        //preparations
        $hg = new Histogram();

        //prepare object to do histogram on
        $diceData = new DiceHistogram();
        //create values in the serie
        for ($i = 0; $i < 5; $i++) {
            $diceData->roll();
        }
        //injectData
        $hg->injectData($diceData);

        //check serie after inject
        $serie = $hg->getSerie();
        //assert serie contains 5 elements
        $this->assertEquals(5, count($serie));

        //test getAsText
        $textString = $hg->getAsText();
        //var_dump($textString);
        //assert * in the String
        $this->assertEquals(5, substr_count($textString, "*"));
        //asserts all 6 nr are presented
        $this->assertEquals(6, substr_count($textString, "<li>"));
    }
}

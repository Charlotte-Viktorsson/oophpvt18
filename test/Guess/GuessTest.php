<?php

namespace chvi17\Guess;

/**
 * Test cases for class Guess.
 */
class GuessTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected properties due various ways of constructing
     * it.
     */
    public function testCreateObject()
    {
        $guess = new Guess();
        $this->assertInstanceOf("\chvi17\Guess\Guess", $guess);
        $this->assertEquals(6, $guess->tries());

        $guess = new Guess(42);
        $this->assertInstanceOf("\chvi17\Guess\Guess", $guess);
        $this->assertEquals(6, $guess->tries());
        $this->assertEquals(42, $guess->number());

        $guess = new Guess(42, 7);
        $this->assertInstanceOf("\chvi17\Guess\Guess", $guess);
        $this->assertEquals(7, $guess->tries());
        $this->assertEquals(42, $guess->number());
    }


    /**
     * Test case for random
     */
    public function testRandom()
    {
        $guess = new Guess();
        $guess->random();
        $this->assertLessThanOrEqual(100, $guess->number());
        $this->assertGreaterThan(0, $guess->number());
    }

    /**
    *   testdata provider for testMakeGuess
    *   @return [] testtitle, [$goal, $nrOfTries, $guess, $expectedMessage]
    */
    public function guessTestDataProvider()
    {
        return [
            'guess too high'  => [15, 2, 20, " too high"],
            'guess too low' => [15, 2, 1, " too low"],
            'correct guess' => [15, 2, 15, " correct!!"],
            'out of tries'  => [1, 0, 12, " too late.. Sorry... You are out of tries!"]
        ];
    }

    /**
     * Test case to test makeGuess method.
     * Test with different testdata from dataprovider
     * @param integer $goal the correct number
     * @param integer $nrOfTries left
     * @param integer $testGuess the guess to test
     * @param integer $expectedMessage the expected return string from makeGuess
     * @return void
     *
     * @dataProvider guessTestDataProvider
     */
    public function testMakeGuess($goal, $nrOfTries, $testGuess, $expectedMessage)
    {
        $guess = new Guess($goal, $nrOfTries);
        $returnStr = $guess->makeGuess($testGuess);
        $this->assertEquals($returnStr, $expectedMessage);
    }
}

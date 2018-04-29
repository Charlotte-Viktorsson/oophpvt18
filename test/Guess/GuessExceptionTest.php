<?php

namespace chvi17\Guess;

/**
 * Test cases for class GuessException.
 */
class GuessExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to test makeGuess method that should trigger an exception.
     * trying out the doc block expectedException notation
     *
     * @expectedException \chvi17\Guess\GuessException
     * @expectedExceptionMessage The number is out of the range 1-100!
     */
    public function testMakeGuessOutOfRangeHigh()
    {
        $guess = new Guess(15, 3);
        $guess->makeGuess(110);
    }

    /**
     * Test case to test makeGuess method that should trigger an exception.
     * trying the expectException inside testmethod
     */
    public function testMakeGuessOutOfRangeLow()
    {
        $this->expectException(\chvi17\Guess\GuessException::class);
        $this->expectExceptionMessage("The number is out of the range 1-100!");
        $guess = new Guess(15, 3);
        $guess->makeGuess(-2);
    }



    /**
    *   testdata provider for testMakeGuess
    *   @return [] testtitle, [$guess, $expectedMessage]
    */
    public function guessExceptionTestDataProvider()
    {
        $expNullMessage= "You forgot to write a number, try again!";
        $expRangeErrorMessage = "The number is out of the range 1-100!";
        return [
            'guess a character'  => ['q',  $expNullMessage],
            'guess a string'  => ["hej", $expNullMessage],
            'guess a boolean' => [false,  $expNullMessage],
            'guess null' => [null,  $expNullMessage]
        ];
    }

    /**
     * Test case to test makeGuess method that should trigger an exception.
     * trying out the doc block expectedException notation
     *
     * @dataProvider guessExceptionTestDataProvider
     */
    public function testMakeGuessWrongTypeOfGuess($actualGuess, $expectedMessage)
    {
        $this->expectException(\chvi17\Guess\GuessException::class);
        $this->expectExceptionMessage($expectedMessage);
        $guess = new Guess(15, 3);
        $guess->makeGuess($actualGuess);
    }
}

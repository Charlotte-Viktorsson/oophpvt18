<?php
namespace chvi17\Dice;

/**
 *  Class that has a nr of Dices
 */
class DiceHand
{
    /**
    * @var integer $nrOfSides  The nr of sides for the Dice.
    * @var Dice $dice          The dice to roll
    * @var array $handResult    Array of diceresults
    * @var integer $sumOfThrow The sum of a throw
    */
    private $nrOfDices;
    private $dice;
    private $handResult = array();
    private $sumOfThrow = 0;

    /**
    * Constructor for a DiceHand
    *
    * @param int $nrOfDices the nr of Dices, default = 5
    * @return void
    */
    public function __construct($nrOfDices = 5)
    {
        $this->nrOfDices = $nrOfDices;
        $this->dice = new Dice();
        $this->throwHand();
    }

    /**
    * function that rolls the dice(s) in the hand
    * @return void
    */
    public function throwHand()
    {
        $sum = 0;
        for ($i = 0; $i < $this->nrOfDices; $i++) {
            $this->handResult[$i] = $this->dice->roll();
            $sum += $this->handResult[$i];
        }
        $this->sumOfThrow = $sum;
    }

    /**
    *   function that returns the values of the dices
    *   @return array handResult
    */
    public function values()
    {
        return $this->handResult;
    }

    /**
    *   function that returns the sum of the dices
    *   @return integer sum of the handResult
    */
    public function sum()
    {
        return $this->sumOfThrow;
    }

    /**
    *   function that returns the average of the dices
    *   @return float average of the handResult
    */
    public function average()
    {
        return round($this->sumOfThrow/$this->nrOfDices, 2);
    }

    /**
    *   function that returns the highest value of the thrown dices
    *   @return integer highest value of the handResult
    */
    public function top()
    {
        $top = 0;
        for ($i = 0; $i < $this->nrOfDices; $i++) {
            if ($this->handResult[$i] > $top) {
                $top = $this->handResult[$i];
            }
        }
        return $top;
    }
}

<?php
namespace chvi17\Dice;

/**
*   Class Player for the 100 game
*
*/
class Player
{
    /**
    * @var string  $name   The name of the player.
    * @var integer $result The current saved result for the player.
    * @var DiceHand $hand The current DiceHand for the player.
    */
    private $name;
    private $result;
    private $hand;

    /**
    * Constructor to create a Player.
    *
    * @param string $name The name of the person, default Player
    * @param int $nrOfDices, nr of Dices, default 5
    * @return void
    */
    public function __construct($name = "Player", $nrOfDices = 5)
    {
        if (!is_int($nrOfDices)) {
            $nrOfDices = 5;
        } elseif (!is_string($name)) {
            $name = "Player";
        }
        $this->name = $name;
        $this->result = 0;
        $this->hand = new DiceHand($nrOfDices);
    }

    /**
    * method to get the current Result
    *
    * @return int $result
    */
    public function getResult()
    {
        return $this->result;
    }

    /**
    * method to reset the Result
    * @return void
    */
    public function resetResult()
    {
        $this->result = 0;
    }

    /**
    * method to add result
    * @param int $sum
    * @return void
    */
    public function addResult($sum)
    {
        if (is_int($sum)) {
            $this->result += $sum;
        }
    }

    /**
    * method to throw the hand
    * @return void
    */
    public function play()
    {
        $this->hand->throwHand();
    }

    /**
    * method to check the hand
    * @return values
    */
    public function checkHand()
    {
        return $this->hand->values();
    }

    /**
    * method to get the hand's Sum
    * @return integer sum of hand
    */
    public function getHandSum()
    {
        return $this->hand->sum();
    }

    /**
    * method to check the highest value of the dices
    * @return integer topValue
    */
    public function topDice()
    {
        return $this->hand->top();
    }

    /**
    * method to set players name
    * @param string $aName
    * @return void
    */
    public function setName($aName)
    {
        $this->name=$aName;
    }

    /**
    * method to set players name
    * @return string name
    */
    public function getName()
    {
        return $this->name;
    }

    /**
    * method to set players name
    * @return DiceHistogram the Dice to count in the Histogram
    */
    public function getDice()
    {
        return $this->hand->getDice();
    }
}

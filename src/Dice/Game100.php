<?php
namespace chvi17\Dice;

define("GAMEGOAL", 100);
/**
*   Class Player for the 100 game
*
*/
class Game100
{
    /**
    * @var integer  $nrOfPlayers       The nr of players.
    * @var integer  $nrOfDices         The current result for the player.
    * @var Player  $players            An array of Player.
    * @var integer $currentPlayerIndex The index of the current playing player
    * @var integer $roundSum           The current player's current value to risk or save
    */
    private $nrOfPlayers;
    private $nrOfDices;
    public $players;
    private $currentPlayerIndex;
    private $roundSum;

    /**
    * Constructor to create Players for the game.
    *
    * @param int $nrOfDices, nr of Dices default 5
    * @param int $nrOfPlayers, nr of Players default 2
    * @return void
    */
    public function __construct($nrOfDices = 5, $nrOfPlayers = 2)
    {
        $this->players = array();
        for ($i = 0; $i < $nrOfPlayers; $i++) {
            $this->players[$i] = new Player($i, $nrOfDices);
        }
        $this->nrOfPlayers = $nrOfPlayers;
        $this->nrOfDices = $nrOfDices;
        $this->currentPlayerIndex = 0;
        $this->roundSum = 0;
    }

    /**
    * Method to reset the game.
    *
    * @return void
    */
    public function reset()
    {
        for ($i = 0; $i < $this->nrOfPlayers; $i++) {
            $aPlayer = $this->players[$i];
            $aPlayer->resetResult();
        }
        $this->currentPlayerIndex = 0;
        $this->roundSum = 0;
    }

    /**
    * method for save option
    * saves the roundSum and resets it.
    * @return String winner or empty sting
    */
    public function save()
    {
        $thePlayer = $this->players[$this->currentPlayerIndex];
        $thePlayer->addResult($this->roundSum);
        $this->roundSum = 0;
        if ($thePlayer->getResult() >= GAMEGOAL) {
            return "Winner";
        } else {
            return "";
        }
    }

    /**
    * method for setting next player
    * @return void
    */
    public function setNextPlayer()
    {
        $this->currentPlayerIndex = $this->findNextPlayer();
    }

    /**
    * method for playing the Game
    * @return int[] the players hand
    */
    public function playGame()
    {
        $playerId = $this->currentPlayerIndex;
        $this->players[$playerId]->play();
        //if(!$this->isResultToBeReset()) {
        $this->roundSum += $this->players[$playerId]->getHandSum();
        //}
        return $this->players[$playerId]->checkHand();
    }

    /**
    * method for checking if result contain 1
    * if 1 is found, the currentplayers sum will be reset.
    * @return int $returnValue
    */
    public function isResultToBeReset()
    {
        $returnValue = 0;
        $playerId = $this->currentPlayerIndex;

        $checkedHand = $this->players[$playerId]->checkHand();
        if (in_array(1, $checkedHand)) {
            $returnValue = 1;
            $this->roundSum = 0;
        }

        return $returnValue;
    }


    /**
    * method for checking which player should start the Game
    * @return int Index of the starting player
    */
    public function checkGameStarter()
    {
        for ($i = 0; $i < $this->nrOfPlayers; $i++) {
            $this->players[$i]->play();
        }
        $topIndex = 0;
        $topValue = 0;
        for ($index = 0; $index < $this->nrOfPlayers; $index++) {
            $tempTopValue = $this->players[$index]->topDice();
            if ($tempTopValue > $topValue) {
                $topValue = $tempTopValue;
                $topIndex = $index;
            }
        }
        $this->currentPlayerIndex = $topIndex;
        return $topIndex;
    }

    /**
    * method for finding out who is next to play
    * @return int Id which player should play next
    */
    public function findNextPlayer()
    {
        $nextPlayer = 1 + $this->currentPlayerIndex;
        if ($nextPlayer == $this->nrOfPlayers) {
            $nextPlayer = 0;
        }

        return $nextPlayer;
        //return $nextPlayer == $this->nrOfPlayers ? 0 : $nextPlayer;
    }


    /**
    * method for getting nrOfPlayers
    * @return int nrOfPlayers
    */
    public function getNrOfPlayers()
    {
        return $this->nrOfPlayers;
    }

    /**
    * method for getting theCurrentPlayer
    * @return int index of currentPlayer
    */
    public function getCurrentPlayer()
    {
        return $this->currentPlayerIndex;
    }

    /**
    * method for getting a player
    * @param int index of Player
    * @return Player a Player
    */
    public function getPlayer($playerId)
    {
        return $this->players[$playerId];
    }

    /**
    * method for getting current RoundSum
    * @return int current RoundSum
    */
    public function getRoundSum()
    {
        return $this->roundSum;
    }

    /**
    * method for setting current RoundSum
    * @param int current RoundSum
    */
    public function addRoundSum($sum)
    {
        $this->roundSum += $sum;
    }
}

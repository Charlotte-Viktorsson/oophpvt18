<?php

namespace Anax\View;

/**
 * Template file for Guess to render a view.
 * data needed are title, method, game, guess, res
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

/*FOOTER <?= __FILE__ ?>

<?= showEnvironment(get_defined_vars(), get_defined_functions()) ?>
*/
/*<pre>RoundSum: <?=$game->getRoundSum();?></pre>
<pre>currentPlayerIndex: <?=$game->getCurrentPlayer();?></pre>
<pre>computer Result: <?=$game->players[0]->getResult();?></pre>
<pre>player Result: <?=$game->players[1]->getResult();?></pre>
<p>---------------------------</p>*/
?>

<!--when starting the game-->
<?php if ($status == "init") :?>
<p>Welcome to play 100 with the Computer!</p>
<p>Press Start to start playing!</p>
<form method=GET>
    <input type="submit" name="init" value="Start">
</form>
<?php endif; ?>

<!--present who will start-->
<?php if ($status == "starting") :?>
<p>Computer's topDice is <?=$player0->topDice()?></p>
<p>Your topDice is <?= $player1->topDice() ?></p>
<p><?=$game->getcurrentPlayer() == 0 ? "Computer starts" : "You start"?></p>
<form method=GET>
    <input type="submit" name="playing" value="Ok">
</form>
<?php endif; ?>

<!--computer is playing-->
<?php if ($status == "playing" && $game->getCurrentPlayer() == 0) :?>
<p>Computer get: <?=implode(", ", $computerHand)?></p>
<p>Computer sum:  <?=$computerSum?></p>
<p>Computer action: <?=$computerAction?></p>

<form method=GET>
    <input type="hidden" name="ComputerAction" value="<?=$computerAction?>">
    <input type="submit" name="playing" value="Ok">
</form>
<?php endif; ?>

<?php if ($status == "playing" && $game->getCurrentPlayer() == 1) :?>
<p>You get: <?=implode(", ", $player1->checkHand())?></p>
<p>Reset is needed: <?=$isReset?></p>
<p>Your Sum:  <?=$game->getRoundSum()?></p>

<?php endif; ?>
<?php if ($status == "playing" && $game->getCurrentPlayer() == 1 && $isReset == "true") :?>
    <form method=GET>

        <input type="hidden" name="PlayerAction" value="Reset">
        <input type="submit" name="playing" value="Ok">
    </form>
<?php endif; ?>

<?php if ($status == "playing" && $game->getCurrentPlayer() == 1 && $isReset == "false") :?>
    <form method=GET>
        <input type="hidden" name="playing" value="Ok">
        <input type="submit" name="PlayerAction" value="Save">
        <input type="submit" name="PlayerAction" value="Continue">
    </form>
<?php endif; ?>
<?php if ($status == "playing") :?>
    <p>Computer Total Sum = <?=$player0->getResult();?>
    <p>Your Total Sum = <?=$player1->getResult();?>
<?php endif; ?>
<?php if ($status == "Winner" && $game->getCurrentPlayer() == 0) :?>
    <p>Computer get: <?=implode(", ", $computerHand)?></p>
    <p>Computer sum:  <?=$computerSum?></p>
    <p>Computer action: <?=$computerAction?></p>
<?php endif; ?>
<?php if ($status == "Winner") :?>
    <p>The winner is found!</p>
    <p>Computer Total Sum = <?=$player0->getResult();?>
    <p>Your Total Sum = <?=$player1->getResult();?>
    <form method=GET>
        <input type="submit" name="Ending" value="Ok">
    </form>
<?php endif; ?>



<!--<p>
    <a href="?restart">Restart the game</a>
</p>-->

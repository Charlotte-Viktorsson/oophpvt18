<?php

namespace Anax\View;

/**
 * Template file for playing game to render a view.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());

/*FOOTER <?= __FILE__ ?>

<?= showEnvironment(get_defined_vars(), get_defined_functions()) ?>
*/

//check incoming values
$game = $app->session->get("Game100");
$status = $status ?? "";
$computerHand = $computerHand ?? null;
$computerSum = $computerSum ?? 0;
$computerAction = $computerAction ?? "";
$playerAction = $playerAction ?? "";
$isReset = $isReset ?? 0;

//get some local variables
$player0 = $game->getPlayer(0);
$player1 = $game->getPlayer(1);
$name0 = $player0->getName();
$name1 = $player1->getName();
$playerId = $game->getCurrentPlayer();


?>
<div class="play100Game">
    <img src="<?= asset("img/dice.png") ?> " alt="dicepicture">
</div>

<!--computer is playing-->
<?php if ($playerId == 0 && $status != "Winner") :?>
<p><?=$name0?> get: <?=implode(", ", $computerHand)?></p>
<p><?=$name0?> Sum:  <?=$computerSum?></p>
<p><?=$name0?> Action: <?=$computerAction?></p>

<form method=POST>
    <input type="hidden" name="ComputerAction" value="<?=$computerAction?>">
    <input type="submit" name="playing" value="Ok">
</form>


<!--player is playing-->
<?php elseif ($playerId == 1 && $status != "Winner") :?>
<p><?=$name1?> get: <?=implode(", ", $player1->checkHand())?></p>
<p><?=$name1?> Sum:  <?=$game->getRoundSum()?></p>
<p><?=$name1?> Action: </p>
    <!-- isReset-> only Reset button -->
    <?php if ($isReset == "true") :?>
        <form method=POST>
            <input type="hidden" name="PlayerAction" value="Reset">
            <input type="submit" name="playing" value="Reset">
        </form>
        <!-- else, save and continue buttons -->
        <?php else :?>
            <form method=POST>
                <input type="hidden" name="playing" value="Ok">
                <input type="submit" name="PlayerAction" value="Save">
                <input type="submit" name="PlayerAction" value="Continue">
            </form>
    <?php endif; ?>
<?php endif; ?>

<!-- If we have a winner, present the hands -->
<?php if ($status == "Winner" && $playerId == 1) :?>
    <p><?=$name1?> get: <?=implode(", ", $player1->checkHand())?></p>
    <p><?=$name1?> sum:  <?=$game->getRoundSum()?></p>
    <p><?=$name1?> Action: <?=$playerAction?></p>
<?php endif; ?>

<?php if ($status == "Winner" && $playerId == 0) :?>
    <p><?=$name0?> get: <?=implode(", ", $computerHand)?></p>
    <p><?=$name0?> sum:  <?=$computerSum?></p>
    <p><?=$name0?> Action: <?=$computerAction?></p>
<?php endif; ?>

<!-- always present total for each player -->
<hr>
<p><?=$name0?> total Sum = <?=$player0->getResult();?> </p>
<p><?=$name1?> total Sum = <?=$player1->getResult();?> </p>
<hr>

<!-- ok button if a winner -->
<?php if ($status == "Winner") :?>
    <H3>The winner is found!</h3>
    <form method=POST>
        <input type="submit" name="Ending" value="Ok">
    </form>
<?php endif; ?>

<!-- present histogram for each player -->
<div>
    <h4>Total distribution of rolls for <?=$name0?></h4>
    <pre><?= $game->showHistogram(0) ?></pre>
</div>
<div>
    <h4>Total distribution of rolls for <?=$name1?></h4>
    <pre><?= $game->showHistogram(1) ?></pre>
</div>

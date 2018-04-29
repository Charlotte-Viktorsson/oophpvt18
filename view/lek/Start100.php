<?php

namespace Anax\View;

/**
 * Template file for StartGame to render a view.
 * data needed are method, action
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

/*FOOTER <?= __FILE__ ?>

<?= showEnvironment(get_defined_vars(), get_defined_functions()) ?>
*/

$method = $method ?? post;
$action = $action ?? null;


$game = $app->session->get("Game100");
$player0 = $game->getPlayer(0);
$player1 = $game->getPlayer(1);
?>

<!--present who will start-->
<div class="play100Game">
    <img src="<?= asset("img/dice.png") ?> " alt="dicepicture">
</div>
<p><?=$player0->getName()?>'s topDice is <?=$player0->topDice()?></p>
<p><?=$player1->getName()?>'s topDice is <?= $player1->topDice() ?></p>
<p><?=$game->getPlayer($game->getcurrentPlayer())->getName()?> starts</p>
<form method="<?= $method ?>" action="<?=url($action)?>" >
    <input type="submit" name="playing" value="Ok">
</form>

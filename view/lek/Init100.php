<?php

namespace Anax\View;

/**
 * Template file for Init Game to render a view.
 * data needed are method, action
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

/*FOOTER <?= __FILE__ ?>

<?= showEnvironment(get_defined_vars(), get_defined_functions()) ?>
*/

$method = $method ?? get;
$action = $action ?? null;

?>


<!--when starting the game -->
<div class="play100Game">
    <img src="<?= asset("img/dice.png") ?> " alt="dicepicture">
</div>
<p>Welcome to play 100 with the Computer!</p>
<p>Press Start to start playing!</p>
<form method="<?= $method ?>" action="<?=url($action)?>" >
    <div>
        <p>
            <label> Spelarens namn: <br>
                <input type="text" name="name" value="Spelare 1">
            </label>
        </p>
        <p><input type="submit" value="Start"></p>
    </div>
</form>

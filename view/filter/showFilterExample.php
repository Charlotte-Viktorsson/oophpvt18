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
?>

<h1><?= $title ?></h1>

<h2>Original text from textfile</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Filter <?=$textType?> applied, source</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>Filter <?=$textType?> applied, HTML</h2>
<?=$html?>

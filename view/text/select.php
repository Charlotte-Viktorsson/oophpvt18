<?php
namespace Anax\View;

if (!$resultset) {
    return;
}

require("header.php");
?>

<pre><?= $sql ?>

<pre>
<?= print_r($resultset, true) ?>
</pre>

<?php require("footer.php");

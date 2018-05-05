<?php
namespace Anax\View;

/**
* Template file to render a view
*/

// show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$resultset) {
    return;
}

$filePrefix = "";
$route = currentRoute();
//echo("current route:" . $route);

if (substr_count($route, "?") == 1) {
    $filePrefix = "/";
}

$defaultRoute = $filePrefix . "show-all-sort?";
?>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id <?= orderby("id", $defaultRoute) ?></th>
        <th>Bild <?= orderby("image", $defaultRoute) ?></th>
        <th>Titel <?= orderby("title", $defaultRoute) ?></th>
        <th>År <?= orderby("year", $defaultRoute) ?></th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++;
?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= asset($row->image) ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>
<?php require("footer.php");

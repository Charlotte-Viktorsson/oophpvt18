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

if (substr_count($route, "?") == 1) {
    $filePrefix = "/";
}

$defaultRoute = $filePrefix . "show-all-paginate?";
?>

<p>Items per page:
    <a href="<?= mergeQueryString(["hits" => 2], $defaultRoute) ?>">2</a> |
    <a href="<?= mergeQueryString(["hits" => 4], $defaultRoute) ?>">4</a> |
    <a href="<?= mergeQueryString(["hits" => 8], $defaultRoute) ?>">8</a>
</p>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id <?= orderby2("id", $defaultRoute) ?></th>
        <th>Bild <?= orderby2("image", $defaultRoute) ?></th>
        <th>Titel <?= orderby2("title", $defaultRoute) ?></th>
        <th>År <?= orderby2("year", $defaultRoute) ?></th>
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

<p>
    Pages:
    <?php for ($i = 1; $i <= $max; $i++) : ?>
        <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a>
    <?php endfor; ?>
</p>

<?php require("footer.php");

<?php

namespace Anax\View;

/**
* Template file to render a view
*/

// show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$action = $action ?? null;
$searchTitle = $searchTitle ?? null;
?>

<form method="post" action="<?=url($action)?>">
    <fieldset>
    <legend>Search</legend>
    <input type="hidden"  value="search-title">
    <p>
        <label>Title (use % as wildcard):
            <input type="search" name="searchTitle" value="<?= esc($searchTitle) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form>

<?php require("footer.php");

<?php

namespace Anax\View;

/**
* Template file to render a view
*/

// show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
$movie = $movie ?? null;
$action = $action ?? null;

if ($action != null && substr_count($action, "edit") > 0) {
    $buttonText = "Edit";
} elseif ($action != null && substr_count($action, "add") > 0) {
       $buttonText = "Add";
}
?>

<form method="post" action="<?=url($action)?>">
    <fieldset>
    <legend><?=$buttonText?></legend>
    <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>

    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle" value="<?= $movie->title ?>"/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear" value="<?= $movie->year ?>"/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage" value="<?= $movie->image ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
        <input type="reset" value="Reset">
    </p>
    </fieldset>
</form>

<?php require("footer.php");

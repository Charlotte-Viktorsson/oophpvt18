<?php

namespace Anax\View;

/**
* Template file to render a view
*/

// show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$action = $action ?? null;
$buttonText = "Ok";
if ($action != null && substr_count($action, "edit") > 0) {
    $buttonText = "Edit";
} elseif ($action != null && substr_count($action, "delete") > 0) {
    $buttonText = "Delete";
}
?>
<form method="post">
    <fieldset>
    <legend>Select Movie</legend>

    <p>
        <label>Movie:<br>
        <select name="movieId">
            <option value="">Select movie...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
    </fieldset>
</form>

<?php require("footer.php");

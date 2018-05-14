<?php
namespace Anax\View;

if (!$pageContent) {
    return;
}

require("header.php");
?>

<form method="post">
    <fieldset>
    <legend>Delete</legend>

    <input type="hidden" name="contentId" value="<?= esc($pageContent->id) ?>"/>

    <p>
        <label>Title:<br>
            <input type="text" name="contentTitle" value="<?= esc($pageContent->title) ?>" readonly/>
        </label>
    </p>

    <p>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>

<?php require("footer.php");

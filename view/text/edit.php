<?php
namespace Anax\View;

//echo showEnvironment(get_defined_vars(), get_defined_functions());
//var_dump($data);
require("header.php");

if (isset($_SESSION['flash']) && !empty($_SESSION['flash'])) {
    echo '<div id="flash_container">' . $_SESSION['flash'] . '</div>';
    unset($_SESSION['flash']);
}
?>
<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?= esc($pageContent->id) ?>"/>

    <p>
        <label>Title:<br>
        <input type="text" name="contentTitle" value="<?= esc($pageContent->title) ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="contentPath" value="<?= esc($pageContent->path) ?>"/>
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="contentSlug" value="<?= esc($pageContent->slug) ?>"/>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="contentData"><?= esc($pageContent->data) ?></textarea>
    </p>

    <p>

        <label>Type:<br>
            <select name="contentType" value="<?= esc($pageContent->type) ?>">
                <option <?php echo(checkSelected($pageContent->type, "post"));?> value="post">post</option>
                <option <?php echo(checkSelected($pageContent->type, "page"));?> value="page">page</option>
                <!--<option value="block">block</option>-->
            </select>
    </p>
    <p>
        <label>Filter: <br>
            <?php $filter = esc($pageContent->filter);?>
            <input type="checkbox" name="contentFilter[]" <?php echo(checkChecked($filter, "bbcode"));?> value="bbcode" /> bbcode <br />
            <input type="checkbox" name="contentFilter[]" <?php echo(checkChecked($filter, "link"));?> value="link"/> link <br />
            <input type="checkbox" name="contentFilter[]" <?php echo(checkChecked($filter, "markdown"));?> value="markdown"/> markdown <br />
            <input type="checkbox" name="contentFilter[]" <?php echo(checkChecked($filter, "nl2br"));?> value="nl2br"/> nl2br <br />
    </p>

    <p>
     <label>Publish:<br>
     <input type="datetime" name="contentPublish" value="<?= esc($pageContent->published) ?>"/>
    </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>

<?php require("footer.php");

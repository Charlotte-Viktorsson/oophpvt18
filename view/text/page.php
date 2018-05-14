<?php
namespace Anax\View;

//echo showEnvironment(get_defined_vars(), get_defined_functions());
//var_dump($data);

require("header.php");
?>

<article>
    <header>
        <h1><?= esc($pageContent->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= esc($pageContent->modified_iso8601) ?>" pubdate><?= esc($pageContent->modified) ?></time></i></p>
    </header>
    <?=$textFilter->parse(esc($pageContent->data), explode(",", esc($pageContent->filter)));?>
</article>

<?php require("footer.php");

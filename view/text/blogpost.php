<?php
namespace Anax\View;

require("header.php");
?>

<article>
    <header>
        <h1><?= esc($title) ?></h1>
        <p><i>Published: <time datetime="<?= esc($pageContent->published_iso8601) ?>" pubdate><?= esc($pageContent->published) ?></time></i></p>
    </header>
    <?=$textFilter->parse(esc($pageContent->data), explode(",", esc($pageContent->filter)));?>
</article>

<?php require("footer.php");

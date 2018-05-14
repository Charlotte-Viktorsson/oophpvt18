<?php
namespace Anax\View;

if (!$resultset) {
    return;
}

require("header.php");
?>

<article>
<h1><?=$title?></h1>
<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="<?= url("text/blog/" . esc($row->slug))?>"><?= esc($row->title) ?> </a></h1>
        <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
    </header>
    <!-- not working $textFilter->doFilter(esc($row->data), esc($row->filter)); -->
    <?= esc($row->data)  ?>
</section>
<?php endforeach; ?>

</article>
<?php require("footer.php");

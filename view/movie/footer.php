<?php

namespace Anax\View;

$filePrefix = "";
$route = currentRoute();
if (substr_count($route, "/") == 0) {
    $filePrefix = "movie/";
}

?>
<navbar class="submenu">
    <a href=<?=$filePrefix . "show-all" ?>>Show all movies</a> |
    <a href=<?=$filePrefix . "show-all-sort" ?>>Show all movies with sorting</a> |
    <a href=<?=$filePrefix . "show-all-paginate" ?>>Show all movies with pagination</a> |
    <br>
    <a href=<?=$filePrefix . "search-title" ?>>Search movie title</a> |
    <a href=<?=$filePrefix . "search-year" ?>>Search movie year</a> |
    <br>
    <a href=<?=$filePrefix . "select" ?>>Update movie</a> |
    <a href=<?=$filePrefix . "select" ?>>Delete movie</a> |
    <a href=<?=$filePrefix . "add-movie" ?>>Add movie</a> |
</navbar>
<figure class="play100Game">
    <img src=<?=asset("image/filmslinga.png")?> alt="filmbild">
</figure>

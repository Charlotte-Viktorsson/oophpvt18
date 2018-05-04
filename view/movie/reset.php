<?php

namespace Anax\View;

/**
* Template file to render a view
*/

// show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());

// Restore the database to its original settings
$file   = "../sql/movie/setup.sql";
//$mysql  = "/usr/bin/mysql";
$mysql  = "C:/xampp/mysql/bin/mysql";

$reset = $reset ?? null;

$output = null;

// Extract hostname and databasename from dsn
$dsnDetail = [];
preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $app->db->getConfig("dsn"), $dsnDetail);
$host = $dsnDetail[1];
$database = $dsnDetail[2];
$login = $app->db->getConfig("username");
$password = $app->db->getConfig("password");

if ($reset != null) {
    $command = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
    $output = [];
    $status = null;
    $res = exec($command, $output, $status);
    $output = "<p>The command was: <code>$command</code>.<br>The command exit status was $status."
        . "<br>The output from the command was:</p><pre>"
        . print_r($output, 1);
}

?>
<form method="post">
    <br>
    <input type="submit" name="DoReset" value="Reset database">
    <?= $output ?>
</form>

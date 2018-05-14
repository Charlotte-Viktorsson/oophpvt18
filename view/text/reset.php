<?php
namespace Anax\View;

require("header.php");

// Restore the database to its original settings
if ($app->request->getServer('SERVER_NAME') == "www.student.bth.se") {
    $mysql  = "/usr/bin/mysql";
} else {
    $mysql  = "C:/xampp/mysql/bin/mysql";
}

$file   = "../sql/content/setup.sql";
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
    <input type="submit" name="reset" value="Reset database">
    <?= $output ?>
</form>
<?php require("footer.php");

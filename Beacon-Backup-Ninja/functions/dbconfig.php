<?php
$dbhost = "localhost";
$dbuser = "bbninja_zenmonk";
$dbpass = "LSphT7gt7";
$dbname = "bbninja_ninjastar";

$db_conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($db_conn->connect_error) {
	die("Database does not exist.");
}
?>
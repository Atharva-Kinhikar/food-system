<?php
session_start();

define('SITEURL', 'http://localhost/Food-Order/');
define('LOCALHOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'foodorder');

$con = mysqli_connect(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error());
$db_select = mysqli_select_db($con, DATABASE) or die(mysqli_error());

?>
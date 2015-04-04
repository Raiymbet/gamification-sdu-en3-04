<?php
$url = "localhost";
$user = "root";
$password = "";
$DB = "db_gamification";
$con = mysqli_connect($url, $user, $password, $DB) or die("Connection error");
if (!$con) {
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n";
    exit($errno.":".$error);
}

mysqli_query($con, 'set names utf8');
mysqli_query($con, 'set character_set_server=utf8');
header("Content-Type: text/html; charset=utf-8");
?>

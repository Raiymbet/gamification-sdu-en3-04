<?php
define ("url", "localhost");
define ("user", "root");
define ("password", "");
define ("DB", "db_gamification");
if (!defined("url") || !defined("user") || !defined("password") || !defined("DB")){ 
	exit('Error DB: Please check constraint');
}else{
	$con = mysqli_connect(url, user, password, DB) or die("Connection error");
	if (!$con) {
	    $error = mysqli_connect_error();
	    $errno = mysqli_connect_errno();
	    print "$errno: $error\n";
	    exit($errno.":".$error);
	}
	mysqli_query($con, 'set names utf8');
	mysqli_query($con, 'set character_set_server=utf8');
	header("Content-Type: text/html; charset=utf-8");
}
?>

<?php
include ("bd.php");
$name = $_GET['name'];
$query = mysql_query("INSERT INTO test (name_student) VALUES ('$name')",$db);
$query1 = mysql_query("SELECT * FROM test WHERE name_student = '$name'",$db);
$qqq = mysql_fetch_array($query1);
$id = $qqq['id'];
header("Location:page.php?id=$id");
?>

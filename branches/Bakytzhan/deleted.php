<?php
include_once 'connect.php';
$query=mysqli_query($con,"DELETE FROM tb_student_result WHERE 1=1") or die(mysqli_error($con));
echo 'DONE';
?>
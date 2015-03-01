<?php
include_once 'connect.php';
$ID = 1;
$query = mysqli_query($con, "SELECT * FROM FINDQUESTION WHERE ID=$ID");
$num_rows = mysqli_num_rows($query);
while ($row = mysqli_fetch_array($query)) {
    $array = array('Question'=>$row['Question'],'ANS1' => $row['ANS1'], 'ANS2' => $row['ANS2'], 'ANS3' => $row['ANS3'], 'ANS4' => $row['ANS4'], 'CORRECT' => $row['CORRECT']);
   echo json_encode($array);
}
?>
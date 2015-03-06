<?php
if (isset($_POST['ID'])) {
    include_once 'connect.php';
    $ID = $_POST['ID'];
    $query = mysqli_query($con, "SELECT * FROM FINDQUESTION WHERE ID=$ID");
    $num_rows = mysqli_num_rows($query);
    while ($row = mysqli_fetch_array($query)) {
        $array = array(
            'ID' => $row['ID'],
            'Question' => $row['Question'],
            'ANS1' => $row['ANS1'],
            'ANS1_ID'=>$row['ANS1_ID'],
            'ANS2_ID'=>$row['ANS2_ID'],
            'ANS3_ID'=>$row['ANS3_ID'],
            'ANS4_ID'=>$row['ANS4_ID'],
            'ANS2' => $row['ANS2'],
            'ANS3' => $row['ANS3'],
            'ANS4' => $row['ANS4'],
            'CORRECT' => $row['CORRECT']);
        echo json_encode($array);
    }
}
?>
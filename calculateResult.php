<?php
function calculateResult()
{
    //TODO: Результат санау, соны studentsResultсалу
    //ID,id_student,id_tournament,score,time_end,percent_correct,datetime
    include_once 'connect.php';
    echo 'Hello';   
    setcookie('id_student','1',3600*3600);
    if(!isset($_POST['id_tournament'])){
        exit('id_tournament');
    }
    if(!isset($_POST['total_question'])){
        exit('total_question');
    }
    if(!isset($_POST['time_end'])){
        exit('time_end');
    }
    $id_student = 1;
    echo 'HEELLO';
    $id_tournament=$_POST['id_tournament'];
    $total_question = $_POST['total_question'];
    $count_correct_answers = $_POST['count_correct_answers'];
    $time_end=$_POST['time_end'];// Секунд  
    $percent_correct =(int)($count_correct_answers/$total_question)*100;
    print $percent_correct;
    $score ='5000';
    $datetime=date("Y-m-d H:i:s");
    $query=mysqli_query($con,"SELECT COUNT(*) as COUNT FROM 
                              tb_student_result 
                              WHERE id_student='$id_student' and id_tournament='$id_tournament'") or die(mysqli_error($con));

    $row=mysqli_fetch_array($query);
    $count=$row['COUNT'];
    print $count."<br>";
    if(!$row){
        exit('Error: '.mysqli_error($con));
    }
    else if($count!=0){
        echo 'PHE<br>';
         $query=mysqli_query($con,"INSERT INTO tb_student_result(id_student,id_tournament,score,time_end,percent_correct,datetime)
             VALUES('$id_student','$id_tournament','$score','$time_end','$percent_correct','$datetime')") or die(mysqli_error($con));
         exit('Record succesfully added');
    }
    else{
        exit('Record already have');
    }
}

if(isset($_POST['command']) && $_POST['command']!=''){
    $command=$_POST['command'];
    if($command=='cResult')
        calculateResult();
}else{
    exit('Command not found');
}
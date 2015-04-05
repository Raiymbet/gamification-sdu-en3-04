<?php
function calculateResult()
{
    //TODO: Результат санау, соны studentsResultсалу
    //ID,id_student,id_tournament,score,time_end,percent_correct,datetime
    include_once 'connect.php';
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

    if(!isset($_POST['count_correct_answers'])){
        exit('count_correct_answers');
    }
    $id_student = 1;
    $id_tournament=$_POST['id_tournament'];
    $total_question = (double)$_POST['total_question'];
    $count_correct_answers = (double)$_POST['count_correct_answers'];
    $time_end=$_POST['time_end'];// Секунд  
    $percent_correct =($count_correct_answers/$total_question)*100;
    $score ='5000';
    $datetime=date("Y-m-d H:i:s");
    $query=mysqli_query($con,"SELECT COUNT(*) as COUNT FROM 
      tb_student_result 
      WHERE id_student='$id_student' and id_tournament='$id_tournament'") or die(mysqli_error($con));

    $row=mysqli_fetch_array($query);
    $count=$row['COUNT'];
    if(!$row){
        exit('Error: '.mysqli_error($con));
    }
    else if($count==0){
       $query=mysqli_query($con,"INSERT INTO tb_student_result(id_student,id_tournament,score,time_end,percent_correct,datetime)
           VALUES('$id_student','$id_tournament','$score','$time_end','$percent_correct','$datetime')") or die(mysqli_error($con));
       header("finish.php?score=5000");
   }
   else{
    exit('Record already have');
}
}
function addStudentToGroup()
{
        //Integer::id_student, Integer::id_teacher, Integer::id_group,Integer::status
    include_once 'connect.php';
    setcookie('id_student','1',3600*3600);
    if(!isset($_POST['id_tournament']) || empty($_POST['id_tournament']))
        exit('id_tournament');
    if(!isset($_POST['id_teacher'])  || empty($_POST['id_teacher']))
        exit('id_teacher');
    if(!isset($_POST['id_group']) ||  empty($_POST['id_group']))
        exit('id_group');
    if(!isset($_POST['status']) || empty($_POST['status']))
        exit('status');
    if(!isset($_POST['approved']) || empty($_POST['approved']))
        exit('approved');

    $id_tournament=$_POST['id_tournament'];
    $id_teacher=$_POST['id_teacher'];
    $id_group=$_POST['id_group'];
    $status=$_POST['status'];
    $approved=$_POST['approved'];
    $query="SELECT COUNT(*) as COUNT FROM tb_groups_students WHERE id_groups='$id_group' and id_student='$id_student' ";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $count=$row['count'];
    $date_request=date("Y-m-d H:i:s");
    $date_approved=date("Y-m-d H:i:s");
    if($count==0){
        $query="INSERT INTO tb_groups_students(id_groups,id_student,approved,data_request,data_approved)
        VALUES($id_groups,$id_student,'$approved','$date_request',$date_approved)" or die(mysqli_error($con));
        mysqli_query($con,$query) or die(mysqli_error($con));
    }else{
        $query="UPDATE tb_groups_students SET  
        approved='$approved' and date_approved='$date_approved' 
        WHERE id_groups='$id_group' and id_student='$id_student')" or die(mysqli_error($con));
        mysqli_query($con,$query) or die(mysqli_error($con));
    }
}
function createGroup(){
    include_once 'connect.php';
    //Integer::id_teacher,String::title,String::category
     if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
    if(!isset($_POST['title']) || empty($_POST['title']))
        exit('title'); 
    if(!isset($_POST['category']) || empty($_POST['category']))
        exit('category');
    $id_teacher=$_POST['id_teacher'];
    $title=$_POST['title'];
    $category=$_POST['category'];
    $secret_code=random_secret_code(5);
    if($stmt = $con->prepare("INSERT INTO tb_groups(title,teacher_id,secret_code,category) VALUES( ?, ?, ?, ?)")){
        $stmt->bind_param("siss", $title,$id_teacher,$category);
        $stmt->execute();
    }else{
        exit("Fail:  Something wrong".mysqli_error($con));
    }
}
function destroyGroup(){

    //1.Закрывает целою группу
    //2. Берет список студентов и удаляет из группы
    //3. Каждому студенту отправляет элеткронной почту сообщение
    //4. 
    //Q:Integer::id_teacher,Integer::id_group,String::message
    //tb_students_groups - > берет список студентов
    //
    include_once 'connect.php';
    if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
    if(!isset($_POST['id_groups']) || empty($_POST['id_groups']))
        exit('id_teacher');
    if(!isset($_POST['message']) || empty($_POST['message']))
        exit('message');
    $id_groups=$_POST['id_groups'];
    $id_teacher=$_POST['id_teacher'];   
    $message=$_POST['message'];
    $message=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $message);

    $students=array();
    $count=0;
    $query=("SELECT B.id as id,B.name as name,B.email as email,COUNT(*) as count
        FROM tb_group_students A,tb_student B 
        WHERE A.id_student=B.id AND A.id_groups='$id_groups'");
    $result=mysqli_query($con,$query) or die(mysqli_error($con));
    if($result){
       while($row=mysqli_fetch_array($result)){
            $element=array('id'=>$row['id'],
            'name'=>$row['name'],
            'email'=>$row['email']);
            array_push($students,$element);
            $count=$row['count'];
        }
        echo 'В группе сидят '.$count.' студент(ов)<br>';
        $i=0;
        while($i<count($students)){
            echo $students[$i]['id'].':'.$students[$i]['name'].":".$students[$i]['email'];
            
            $to=$students[$i]['email'];
            $subject='Удаление из группы';
            $message_mail.='Здраствуйте,'.$students[$i]['name'].'\n';
            $message_mail.='Вы удалены из группы\n';
            $message_mail.='Причина: \n\r'.$message.'\n';
            $message_mail.='C уважением Администрация\n';
            $message_mail .= str_replace("\n.", "\n..",$message_mail);
            $headers = "From: system@bb.com <system@bb.com>\r\n" .
                        "MIME-Version: 1.0" . "\r\n" .
                         "Content-type: text/html; charset=UTF-8" . "\r\n";
            $message_mail = wordwrap($message_mail, 70, "\r\n") . "\r\n";
            $status=mail($to, $subject, $message_mail, $headers);
            if($status){
                echo 'Сообщение было отправлено'.$students[$i]['email'].'\n'; 
            }else{
                echo 'Сообщение не было отправлено'.$students[$i]['email'].'\n';
            }
            $i++;
        }
        if($count>0){
            $query="DELETE FROM tb_groups_students WHERE id_groups='$id_groups'";
            $result=mysqli_query($con,$query) or die(mysqli_error($con));
            if(!$result){echo 'Fail!Studnet not found';}
        }
            $query="DELETE FROM tb_groups WHERE id_group='$id_groups'";
            $result=mysqli_query($con,$query) or die(mysqli_error($con));
        }
}
function createTournaments(){
    //Integer::id_teacher,integer::id_group,
    //String::title,String:: description,long::limit_time,String::status
    if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
     if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
     if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
     if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
     if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
     if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
}
/*USEFUL FUNCTION*/
function random_secret_code($chars = 5) {
   $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
   return substr(str_shuffle($letters), 0, $chars);
}
//*******************
if(isset($_POST['command']) && !empty($_POST['command'])){
    $command=$_POST['command'];
    if($command=='cResult')
        calculateResult();
    else if($command=='cGroupAdd'){

    }else if($command=='cGroupDestroy'){
        destroyGroup();
    }

}else{
    exit('Command not found');
}
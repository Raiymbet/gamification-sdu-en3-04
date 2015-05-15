<?php
function calculateResult()
{
    //TODO: Результат санау, соны studentsResultсалу
    //ID,id_student,id_tournament,score,time_end,percent_correct,datetime
    //Заметка:total_question,time_end - > забери из база данных
    include_once 'connect.php';
    if(!isset($_POST['id_tournament'])){
        exit('id_tournament');
    }
    if(!isset($_POST['time_end'])){
        exit('time_end');
    }
    if(!isset($_POST['count_correct_answers'])){
        exit('count_correct_answers');
    }
    if(!isset($_POST['id_student'])){
        exit('id_student');
    }
    if(!isset($_POST['correct_answers'])){
        exit('correct_answers');
    }
    $id_student = $_POST['id_student']; //MUST BE: $_COOKIE['id_student']
    $id_tournament=$_POST['id_tournament'];
    $total_question=0;
    $time_limit=0;
    $when_closed=0;
    $query=mysqli_query($con,"SELECT A.time_limit as time_limit,A.when_closed as when_closed, 
        COUNT(B.id) as count FROM tb_tournaments A,
        tb_questions B where A.id='$id_tournament' and A.id=B.id_tournament") 
    or die(mysqli_error($con));
    if($query==True && mysqli_num_rows($query)>0){
        while($row=mysqli_fetch_array($query)){
         $total_question=$row['count'];
         $time_limit= $row['time_limit'];
         $when_closed=$row['when_closed'];
               //when_closed; - >Если пользователь опоздал, то его данные не заноситься
     }
 }else{
    exit("Error404!Tournament not found");
}

$count_correct_answers = (double)$_POST['count_correct_answers'];
    $time_end=$_POST['time_end'];// Секунд  
    $percent_correct =($count_correct_answers/$total_question)*100;
    $score =$_POST['score'];
    $correct_answers=$_POST['correct_answers'];
    $datetime=date("Y-m-d H:i:s");
    if($datetime>$when_closed){
        exit('late');
    }
    if(!is_numeric($id_student) 
        || !is_numeric($id_tournament) 
        || !is_numeric($time_end) 
        || !is_numeric($percent_correct) 
        || !is_numeric($score)){
        exit("<span>Fail.Some value is not numeric.Please,Check it!</span>");
}
$query=mysqli_query($con,"SELECT COUNT(*) as COUNT FROM 
  tb_student_result 
  WHERE id_student='$id_student' and id_tournament='$id_tournament'") or die('Error0'.mysqli_error($con));

$row=mysqli_fetch_array($query);
$count=$row['COUNT'];
if(!$row){
    exit('Error: '.mysqli_error($con));
}
else if($count==0){
    $query=mysqli_query($con,"INSERT INTO tb_student_result(id_student,id_tournament,score,time_end,percent_correct,correct_answers,datetime)
     VALUES('$id_student','$id_tournament','$score','$time_end','$percent_correct','$correct_answers','$datetime')") or die('Error1:'.mysqli_error($con));
 $query=mysqli_query($con,"SELECT id from tb_student_result WHERE id_student='$id_student' and id_tournament='$id_tournament'");
 $row=mysqli_fetch_array($query);
 header("Content-Type: application/json; charset=utf-8");
 exit('{ "OK" :'.$row['id'].'}');

}
else{
    exit('<span>Record already have</span>');
}
}
function addStudentToGroup()
{
        //Integer::id_student, Integer::id_teacher, Integer::id_groups,Integer::status
    include_once 'connect.php';
    if(!isset($_POST['id_tournament']) || empty($_POST['id_tournament']))
        exit('id_tournament');
    if(!isset($_POST['id_teacher'])  || empty($_POST['id_teacher']))
        exit('id_teacher');
    if(!isset($_POST['id_groups']) ||  empty($_POST['id_groups']))
        exit('id_groups');
    if(!isset($_POST['status']) || empty($_POST['status']))
        exit('status');
    if(!isset($_POST['approved']) || empty($_POST['approved']))
        exit('approved');

    $id_tournament=$_POST['id_tournament'];
    $id_teacher=$_POST['id_teacher'];
    $id_groups=$_POST['id_groups'];
    $status=$_POST['status'];
    $id_student=$_POST['id_student'];
    $approved=$_POST['approved'];
    $query="SELECT COUNT(*) as COUNT FROM tb_groups_students WHERE id_groups='$id_groups' and id_student='$id_student' ";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $count=$row['count'];
    $date_request=date("Y-m-d H:i:s");
    $date_approved=date("Y-m-d H:i:s");
    if($count==0){
        $query="INSERT INTO tb_groups_students(id_groups,id_student,approved,data_request,data_approved)
        VALUES($id_groups,$id_student,'$approved','$date_request',$date_approved)" or die('Error2'.mysqli_error($con));
        mysqli_query($con,$query) or die('Error3'.mysqli_error($con));
    }else{
        $query="UPDATE tb_groups_students SET  
        approved='$approved' and date_approved='$date_approved' 
        WHERE id_groups='$id_groups' and id_student='$id_student')" or die('Error4'.mysqli_error($con));
mysqli_query($con,$query) or die('Error5'.mysqli_error($con));
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
    //Q:Integer::id_teacher,Integer::id_groups,String::message
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
    $result=mysqli_query($con,$query) or die('Error6'.mysqli_error($con));
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
        $result=mysqli_query($con,$query) or die('Error7'.mysqli_error($con));
        if(!$result){echo 'Fail!Studnet not found';}
    }
}
$query="DELETE FROM tb_groups WHERE id_groups='$id_groups'";
$result=mysqli_query($con,$query) or die('Error8'.mysqli_error($con));
return $result;
}
function createTournaments(){
    include_once 'connect.php';
    //Integer::id_teacher,integer::id_groups,
    //String::title,String:: description,long::time_limit,String::status
    if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
        exit('id_teacher');
    if(!isset($_POST['id_groups']) || empty($_POST['id_groups']))
        exit('id_groups');
    if(!isset($_POST['title']) || empty($_POST['title']))
        exit('title');
    if(!isset($_POST['description']) || empty($_POST['description']))
        exit('description');
    if(!isset($_POST['time_limit']) || empty($_POST['time_limit']))
        exit('time_limit');
    if(!isset($_POST['status']) || empty($_POST['status']))
        exit('status');
    $id_teacher=$_POST['id_teacher'];
    $id_groups=$_POST['id_groups'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $time_limit=$_POST['time_limit'];
    $status=$_POST['status'];
    /*CHECK VALUES*/
    if(!is_numeric($id_teacher) || !is_numeric($id_groups) || !is_numeric($time_limit)){
        exit('Error: Wrong value');
    }
    $title=removeSpecialCharacters($title);
    $description=removeSpecialCharacters($description);
    $status=removeSpecialCharacters($status);
    $datetime_added=date("Y-m-d H:i:s"); //2014-01-10 14:03:21
    $when_opened=date("Y-m-d H:i:s");
    $time_limit=$_POST['time_limit'];
    if(is_null($time_limit) || empty($time_limit)){
        $time_limit=360;
    }
    $when_closed=date("Y-m-d H:i:s")+24*3600;
    $public=1;
    echo "INSERT INTO tb_tournaments(title,id_groups,id_teacher,datetime_added,time_limit,status,when_opened,when_closed,public,description) 
    VALUES('$title','$id_groups','$id_teacher','$datetime_added','$time_limit','$status','$when_opened','$when_closed','$public','$description')";
    
    $result=mysqli_query($con,"INSERT INTO tb_tournaments(title,id_groups,id_teacher,datetime_added,time_limit,status,when_opened,when_closed,public,description) 
        VALUES('$title','$id_groups','$id_teacher','$datetime_added','$time_limit','$status','$when_opened','$when_closed','$public','$description')") or die('Error9 : '.mysqli_errno($con).'/'.mysqli_error($con));
    return $result;
}
/*USEFUL FUNCTION*/  
function random_secret_code($chars = 5) {
 $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
 return substr(str_shuffle($letters), 0, $chars);
}
function my_statistics(){
    include_once 'connect.php';
    //$id;
    if(!isset($_POST['id']) || empty($_POST['id']))
        exit('id');
    $id_student=$_POST['id_student'];
    if(!is_numeric($id_student)){
        exit('id');
    }
    //id_student, nagrada, score
}
function show_students_raitings(){
    include_once 'connect.php';
    $query="SELECT A.id as id,A.score as score,
    B.id as user_id,B.name as name,
    B.surname as surname,
    E.title,E.id as group_id 
    FROM tb_student_result A,tb_student B,tb_group_students C,tb_groups E 
    WHERE A.id_student=B.id and A.id_student=C.id_student and C.id_groups=E.id 
    ORDER BY A.score DESC";
    $result=mysqli_query($con,$query) or die('Error12: '.mysqli_error($con));
    $array_result=array();
    $count=mysqli_num_rows($result);
    while($row=mysqli_fetch_array($result)){
        $item=array(
            'id'=>$row['id'],
            'user_id'=>$row['user_id'],
            'name'=>$row['name'],
            'surname'=>$row['surname'],
            'group_id'=>$row['group_id'],
            'score'=>$row['score']);
        array_push($array_result,$item);
    }
    if($count>0){
        echo json_encode($array_result,JSON_UNESCAPED_UNICODE);}
        else{
            exit("Erorr 400!Table is empty!");
        }
        function editTournament(){
            include_once 'connect.php';
    //Integer::id_teacher,integer::id_groups,
    //String::title,String:: description,long::time_limit,String::status

            if(!isset($_POST['id']) || empty($_POST['id']))
                exit('id');
            if(!isset($_POST['id_teacher']) || empty($_POST['id_teacher']))
                exit('id_teacher');
            if(!isset($_POST['id_groups']) || empty($_POST['id_groups']))
                exit('id_groups');
            if(!isset($_POST['title']) || empty($_POST['title']))
                exit('title');
            if(!isset($_POST['description']) || empty($_POST['description']))
                exit('description');
            if(!isset($_POST['time_limit']) || empty($_POST['time_limit']))
                exit('time_limit');
            if(!isset($_POST['status']) || empty($_POST['status']))
                exit('status');
            $id=$_POST['id'];
            $id_teacher=$_POST['id_teacher'];
            $id_groups=$_POST['id_groups'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $time_limit=$_POST['time_limit'];
            $status=$_POST['status'];
            /*CHECK VALUES*/
            if(!is_numeric($id) || !is_numeric($id_teacher) || !is_numeric($id_groups) || !is_numeric($time_limit)){
                exit('Error: Wrong value');
            }
            $title=removeSpecialCharacters($title);
            $description=removeSpecialCharacters($description);
            $status=removeSpecialCharacters($status);
    $datetime_added=date("Y-m-d H:i:s"); //2014-01-10 14:03:21
    $when_opened=date("Y-m-d H:i:s");
    $time_limit=$_POST['time_limit'];
    if(is_null($time_limit) || empty($time_limit)){
        $time_limit=360;
    }
    $when_closed=date("Y-m-d H:i:s")+24*3600;
    $public=1;
    echo "INSERT INTO tb_tournaments(title,id_groups,id_teacher,datetime_added,time_limit,status,when_opened,when_closed,public,description) 
    VALUES('$title','$id_groups','$id_teacher','$datetime_added','$time_limit','$status','$when_opened','$when_closed','$public','$description')";

    $result=mysqli_query($con,"INSERT INTO tb_tournaments(title,id_groups,id_teacher,datetime_added,time_limit,status,when_opened,when_closed,public,description) 
        VALUES('$title','$id_groups','$id_teacher','$datetime_added','$time_limit','$status','$when_opened','$when_closed','$public','$description')") or die('Error9 : '.mysqli_errno($con).'/'.mysqli_error($con));
    return $result;
}
}
function removeSpecialCharacters($str=''){
    mb_regex_encoding('UTF-8');
    $pattern = '/[^A-Za-z0-9А-Яа-я\- ]/';
    return preg_replace($pattern,"",$str);
}
//*******************
if(isset($_POST['command']) && !empty($_POST['command'])){
    $command=$_POST['command'];
    if($command=='cResult')
        calculateResult();
    else if($command=='cGroupAdd'){
        addStudentToGroup();
    }else if($command=='cGroupDestroy'){
        destroyGroup();
    }else if($command=='cCreateTournament'){
        createTournaments();
    }else if($command=='cRaintings'){
        show_students_raitings();
    }else{
        exit('Command not found');   
    }
}else{
    exit('Command not found');
}
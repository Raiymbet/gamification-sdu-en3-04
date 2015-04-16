<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 20.03.2015
 * Time: 22:23
 */
include_once 'connect.php';
$user = $name = $surname = $birthday = $gender = $email = $tel = $password = $group = "";

//Проверка пользователя студент или учитель
if (isset($_POST['teacher_submit'])) {
    global $user;
    $user = 'teacher';
} else if (isset($_POST['student_submit'])) {
    global $user;
    $user = 'student';
}

//check all information
/*if (!isset($_POST['name']) || empty($_POST['name']) || !preg_match('[a-zA-Z\-]{2,50}', $_POST['name'])) {
    $err[] = "Неправильное имя";
}if (!isset($_POST['surname']) || empty($_POST['surname']) || !preg_match('[a-zA-Z\-]{2,50}', $_POST['surname'])) {
    $err[] = "Неправильное фамилия";
}if(!isset($_POST['birthday']) || empty($_POST['birthday']) || !preg_match('/[0-9]{2}\.[0-9]{2}\.[0-9]{4}/', $_POST['birthday'])){
    $err[] = "Неправильное дата рождение";
}if(!isset($_POST['gender']) || empty($_POST['gender'])){
    $err[] = "Неопределено ваш пол";
}if(!isset($_POST['e_mail']) || empty($_POST['e_mail'])){
    $err[] = "Неопределен ваш email";
}if(!isset($_POST['telephone']) || empty($_POST['telephone'])){
    $err[] = "Неопределен ваш telephone";
}
//checking password
if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
    $err[] = "Password shall consists of lower and upper case, numbers";
} else if (strlen($password) < 6 or strlen($password) > 100) {
    $err[] = "Password length shall be between 6-100";
}*/

if ($user=='student' || $user=='teacher') {
   // echo "$user<br>";
    $err = array();
    //Принимаем данные форма через пост
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $gender = htmlspecialchars($_POST['gender']);
    $email = htmlspecialchars($_POST['e_mail']);
    $tel = htmlspecialchars($_POST['telephone']);
    $password = md5(md5(htmlspecialchars($_POST['password'])));
    if($user=='student'){
        $group = htmlspecialchars($_POST['group']);
    }

    //checking user on db
    $count_user = "";
    if($user=='student'){
        $count_user = mysqli_query($con, "SELECT COUNT(email) as COUNT FROM tb_student WHERE email='$email'");
    }else if($user=='teacher'){
        $count_user = mysqli_query($con, "SELECT COUNT(email) as COUNT FROM tb_teacher WHERE email='$email'");
    }
    $row = mysqli_fetch_assoc($count_user);
    if ($row['COUNT'] > 0) {
        $err[] = "User already exists on database";
    }
    $row = null;
    //if no error we can register user
    if (count($err) == 0) {
        if ($user == 'student') {
            mysqli_query($con,
                "INSERT INTO tb_student (name, surname, group_name, birthday, gender, email, phone_number, password)
            VALUES ('$name',
                    '$surname',
                    '$group',
                    '$birthday',
                    '$gender',
                    '$email',
                    '$tel',
                    '$password')")
            or die(mysqli_error($con));

        } else if ($user == 'teacher') {
           mysqli_query($con, "INSERT INTO tb_teacher(name, surname, birthday, gender, email, phone_number, password)
            VALUES('$name',
                   '$surname',
                   '$birthday',
                   '$gender',
                   '$email',
                   '$tel',
                   '$password')")
           or die(mysqli_error($con));
         }
        if($con==true)
            echo "Регистрация прошла успешно";
    } else {
        echo "<p>При регистрации произошло ошибка</p>";
        foreach ($err AS $error) {
            echo "<p>". $error . "</p>";
        }
    }
    mysqli_close($con);
}
?>
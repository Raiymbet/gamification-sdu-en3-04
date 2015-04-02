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

if ($user=='student' || $user=='teacher') {
    print "$user<br>";
    $err = array();
    //Принимаем данные форма черех пост
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

    //check all information
    if (!isset($_POST['name']) || empty($_POST['name'])) {
        $err[] = "Name has error";
    }
    //checking password
    if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
        $err[] = "Password shall consists of lower and upper case, numbers";
    } else if (strlen($password) < 8 or strlen($password) > 100) {
        $err[] = "Password length shall be between 8-100";
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
                "INSERT INTO tb_student (name, surname, group_name, birthday, gender, email, phone_number, password, photo_url)
            VALUES ('$name',
                    '$surname',
                    '$group',
                    '$birthday',
                    '$gender',
                    '$email',
                    '$tel',
                    '$password',
                    '')")
            or die(mysqli_error($con));

        } else if ($user == 'teacher') {
           mysqli_query($con, "INSERT INTO tb_teacher(name, surname, birthday, gender, email, phone_number, password, photo_url)
            VALUES('$name',
                   '$surname',
                   '$birthday',
                   '$gender',
                   '$email',
                   '$tel',
                   '$password',
                   '')")
           or die(mysqli_error($con));
         }
        if($con==true)
            print "<b>Регистрация прошла успешно</b>";
        else
            print $con;
    } else {
        print "<b>При регистрации произошло ошибка</b><br>";
        foreach ($err AS $error) {
            print $error . "<br>";
        }
    }
    mysqli_close($con);
}
?>
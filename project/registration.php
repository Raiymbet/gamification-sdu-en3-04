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
}else if(isset($_POST['forgot_password'])){
    $email = htmlspecialchars($_POST['e_mail']);
    $new_password = md5(md5(htmlspecialchars($_POST['password'])));
    if (!is_null($email)) {
        $count_user = mysqli_query($con, "SELECT COUNT(email) as COUNT FROM tb_student WHERE email='$email'");
        $row = mysqli_fetch_assoc($count_user);
        if ($row['COUNT'] > 0) {
            mysqli_query($con,"UPDATE tb_student SET password='$new_password' WHERE email='$email'")
            or die(mysqli_error($con));
            echo "<p class='text-success'><strong>Ваш пароль изменен!</strong></p>";
        }else{
                $count_user = mysqli_query($con, "SELECT COUNT(email) as COUNT FROM tb_teacher WHERE email='$email'");
                $row = mysqli_fetch_assoc($count_user);
                if ($row['COUNT'] > 0) {
                    mysqli_query($con,"UPDATE tb_teacher SET password='$new_password' WHERE email='$email'")
                    or die(mysqli_error($con));
                    echo "<p class='text-success'><strong>Ваш пароль изменен!</strong></p>";
                }else {
                    echo "<p class='text-danger'><strong>Такого пользователя нет!</strong></p>";
                }
        }
    }
    mysqli_close($con);
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

if ($user == 'student' || $user == 'teacher') {
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
    //Проверка email на обоих таблицах, есть ли найдется в один из них, то вернеть ошибку.
    $q1 = mysqli_query($con, "SELECT COUNT(id) as COUNT FROM tb_student WHERE email='$email'");
    $q2 = mysqli_query($con, "SELECT COUNT(id) as COUNT FROM tb_teacher WHERE email='$email'");
    $r1 = mysqli_fetch_array($q1);
    $r2 = mysqli_fetch_array($q2);

    if ($user == 'student') {
        $group = htmlspecialchars($_POST['group']);
    }

    //checking user on db
    $count_user = "";
    if ($user == 'student') {
        $count_user = mysqli_query($con, "SELECT COUNT(email) as COUNT FROM tb_student WHERE email='$email'");
    } else if ($user == 'teacher') {
        $count_user = mysqli_query($con, "SELECT COUNT(email) as COUNT FROM tb_teacher WHERE email='$email'");
    }
    $row = mysqli_fetch_assoc($count_user);
    if ($row['COUNT'] > 0) {
        $err[] = "Такой пользователь уже существует";
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
        $time = time() + 3600 * 3600;
        if ($user == 'student') {
            $q = mysqli_query($con, "SELECT id,photo_url,gender from tb_student WHERE email='$email' LIMIT 1");
        } else {
            $q = mysqli_query($con, "SELECT id,photo_url,gender from tb_teacher WHERE email='$email' LIMIT 1");
        }
        //  echo 'Число строк: '.mysqli_num_rows($q);
        $r = mysqli_fetch_array($q);
            setcookie("id", $r['id'], $time);
            setcookie("name", $name, $time);
            setcookie("surname", $surname, $time);
            setcookie("birthday", $birthday, $time);
        if ($user == 'student')
            setcookie("group", $group, $time);
            setcookie("telephone", $tel, $time);
        setcookie("user",$user);
        //  echo  $r['gender'];
        setcookie("gender", $r['gender'], $time);
        setcookie("photo_url", $r['photo_url'], $time);
            setcookie('email', $email, $time);
            setcookie("time", $time, $time);
        echo "<p class='text-success'><strong>Регистрация прошла успешно!</strong></p>";
    } else {
        echo "<p class='text-danger'><strong>При регистрации произошло ошибка!</strong></p>";
        foreach ($err AS $error) {
            echo "<p class='text-danger'>" . $error . "</p>";
        }
            //header("Location: error.php?message=$message");
    }
    mysqli_close($con);
}

?>
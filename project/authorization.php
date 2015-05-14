<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 20.03.2015
 * Time: 21:42
 * 1. Priniat danniye polzovatelia
 * 2. Proverka polzovatelia
 * 3. Resultat logged, ili vy ne zaregistrirovani ili je ne pravilniy password
 * 4. Если человек зашел, но еще хочет авторизоватся. То проверит данные его заново.
 * !Переавторизовать
 * *Уничтожить cookie
 * *Переавторизовать
 */
echo "<meta charset='utf-8'>";
if (isset($_COOKIE['id']) || !empty($_COOKIE['id'])) {
    echo '<span>Cookie status: Есть</span><br>';
    if (isset($_COOKIE['user']) || !empty($_COOKIE['user'])) {
        if ($_COOKIE['user'] == 'student') {
            header("Location: student.php");
        } else if ($_COOKIE['user'] == 'teacher') {
            header("Location: teacher.php");
        }
    } else {
        header("main_page.html");
    }
} else {
    echo '<span>Cookie status: Нет</span><br>';
}

/* Соединение с базы */
include_once 'connect.php';
if (!isset($_POST['e_mail']) || empty($_POST['e_mail'])) {
    exit("e_mail");
}
if (!isset($_POST['password']) || empty($_POST['password'])) {
    exit("password");
}
$e_mail = $_POST['e_mail'];
$password = md5(md5($_POST['password']));
$q1 = mysqli_query($con, "SELECT COUNT(id) as COUNT FROM tb_student WHERE email='$e_mail'");
$q2 = mysqli_query($con, "SELECT COUNT(id) as COUNT FROM tb_teacher WHERE email='$e_mail'");
$r1 = mysqli_fetch_array($q1);
$r2 = mysqli_fetch_array($q2);
if ($r1['COUNT'] > 0) {
    //$r1 -- > student
if ($stmt = $con->prepare("SELECT * FROM tb_student WHERE email= ?  AND password= ? ")
) {
    /* Bind parameters
       s - string, b - blob, i - int, etc */
    $stmt->bind_param("ss", $e_mail, $password);
    /* Execute it */
    $stmt->execute();
    /* Bind results */

    $stmt->bind_result($id, $name, $surname, $password, $birthday, $gender, $email, $photo, $phone_number, $group_name);


    $stmt->fetch();
    if ($id == null) {
        mysqli_close($con);
        exit('<span>Неправильный логин или пароль!</span>');
    } else {
        echo $id . " " . $name . " " . $surname;
        /* Fetch the value */
        $time = time() + 3600 * 24;
        setcookie("id", $id, $time);
        setcookie("name", $name, $time);
        setcookie("surname", $surname, $time);
        setcookie("birthday", $birthday, $time);
        setcookie("group", $group_name, $time);
        setcookie("user", "student", $time);
        setcookie("telephone", $phone_number, $time);
        setcookie("gender", $gender, $time);
        setcookie("photo_url", $photo, $time);
        setcookie('email', $email, $time);
        setcookie("time", $time, $time);
        //    echo "<span>Авторизация прошла успешно! Ваши данные:</span><br>";
        /*  if (isset($_COOKIE['id'])) {
              echo $_COOKIE['id'], "\n",
              $_COOKIE['name'], "\n",
              $_COOKIE['surname'], "\n",
              $_COOKIE['birthday'], "\n",
              $_COOKIE['group'], "\n",
              $_COOKIE['telephone'], "\n",
              $_COOKIE['gender'], "\n",
              $_COOKIE['photo_url'], "\n",
              $_COOKIE['time'];
          }*/
        header("Location: student.php");//Должен перенаправлять на страницу пользователя
    }
    /* Close statement */
    $stmt->close();
} else {
    echo "<span>Неправильный логин или пароль!</span>";
    /* Close connection */
    mysqli_close($con);
}
} else if ($r2['COUNT'] > 0) {
    //r2 -- > teacher
    if ($stmt = $con->prepare("SELECT * FROM tb_teacher WHERE email= ?  AND password= ? ")
    ) {
        /* Bind parameters
           s - string, b - blob, i - int, etc */
        $stmt->bind_param("ss", $e_mail, $password);
        /* Execute it */
        $stmt->execute();
        /* Bind results */

        $stmt->bind_result($id, $name, $surname, $password, $birthday, $gender, $email, $photo, $phone_number, $group_name);


        $stmt->fetch();
        if ($id == null) {
            mysqli_close($con);
            exit('<span>Неправильный логин или пароль!</span>');
        } else {
            echo $id . " " . $name . " " . $surname;
            /* Fetch the value */
            $time = time() + 3600 * 24;
            setcookie("id", $id, $time);
            setcookie("name", $name, $time);
            setcookie("surname", $surname, $time);
            setcookie("birthday", $birthday, $time);
            setcookie("user", "teacher", $time);
            setcookie("telephone", $phone_number, $time);
            setcookie("gender", $gender, $time);
            setcookie("photo_url", $photo, $time);
            setcookie('email', $email, $time);
            setcookie("time", $time, $time);
            // echo "<span>Авторизация прошла успешно! Ваши данные:</span><br>";
            /*if (isset($_COOKIE['id'])) {
                echo $_COOKIE['id'], "\n",
                $_COOKIE['name'], "\n",
                $_COOKIE['surname'], "\n",
                $_COOKIE['birthday'], "\n",
                $_COOKIE['group'], "\n",
                $_COOKIE['telephone'], "\n",
                $_COOKIE['gender'], "\n",
                $_COOKIE['photo_url'], "\n",
                $_COOKIE['time'];
            }*/
            header("Location: teacher.php");//Должен перенаправлять на страницу пользователя
        }
        /* Close statement */
        $stmt->close();
    } else {
        mysqli_close($con);
        exit("<span>Неправильный логин или пароль!</span>");
        /* Close connection */
    }
} else {
    mysqli_close($con);
    exit("<span>Неправильный логин или пароль!</span>");
}
mysqli_close($con);


?>
<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 20.03.2015
 * Time: 21:42
 * 1. Priniat danniye polzovatelia
 * 2. Proverka polzovatelia
 * 3. Resultat logged, ili vy ne zaregistrirovani ili je ne pravilniy password
 */
include_once 'connect.php';

if (isset($_POST['submit'])) {
    if (!isset($_POST['e_mail']) || empty($_POST['e_mail'])) {
        exit("'e_mail' not found");
    }
    if (!isset($_POST['password']) || empty($_POST['password'])) {
        exit("'password' not found");
    }
    if (!isset($_POST['remember_checkbox']) || empty($_POST['remember_checkbox'])) {
        exit("'remember_checkbox' not found");
    }

    $e_mail = $_POST['e_mail'];
    $password = md5(md5($_POST['password']));
    $remember_checkbox = $_POST['remember_checkbox'];

    if ($stmt = $con->prepare("SELECT * FROM tb_student WHERE email= ?  and password= ? ")
    ) {

        /* Bind parameters
           s - string, b - blob, i - int, etc */
        $stmt->bind_param("ss", $e_mail, $password);

        /* Execute it */
        $stmt->execute();

        /* Bind results */
        $res = $stmt->bind_result($result);

        /* Fetch the value */
        $stmt->fetch();

        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $time = time() + 3600 * 24;
        setcookie("id", $row['id'], $time);
        setcookie("name", $row['name'], $time);
        setcookie("surname", $row['surname'], $time);
        setcookie("birthday", $row['birthday'], $time);
        setcookie("group", $row['group_name'], $time);
        setcookie("telephone", $row['phone_number'], $time);
        setcookie("gender", $row['gender'], $time);
        setcookie("photo_url", $row['photo_url'], $time);
        setcookie("time", $time, $time);
        echo "<span>Авторизация прошла успешно! Ваши данные:</span><br>";
        echo $_COOKIE['id'], "\n",
        $_COOKIE['name'], "\n",
        $_COOKIE['surname'], "\n",
        $_COOKIE['birthday'], "\n",
        $_COOKIE['group'], "\n",
        $_COOKIE['telephone'], "\n",
        $_COOKIE['gender'], "\n",
        $_COOKIE['photo_url'], "\n",
        $_COOKIE['time'];
        /* Close statement */
        $stmt->close();
    } else {
        echo "<span>Неправильный логин или пароль!</span>";
    }

    /* Close connection */
    myslqi_close($con);
}
?>
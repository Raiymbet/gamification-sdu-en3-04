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
    $e_mail = $_POST['e_mail'];
    $password = md5(md5($_POST['password']));
    $remember_checkbox = $_POST['remember_checkbox'];
    $query = mysqli_query($con, "SELECT * FROM tb_student WHERE email='$e_mail' and password='$password'");
    if ($query and mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
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
        echo "Авторизация прошла успешно! Ваши данные:\n";
        echo $_COOKIE['id'],"\n",
        $_COOKIE['name'],"\n",
        $_COOKIE['surname'] ,"\n",
        $_COOKIE['birthday'],"\n",
        $_COOKIE['group'],"\n",
        $_COOKIE['telephone'],"\n",
        $_COOKIE['gender'],"\n",
        $_COOKIE['photo_url'],"\n",
        $_COOKIE['time'];
    } else {
        echo "Неправильный логин или пароль!";
    }
}
?>
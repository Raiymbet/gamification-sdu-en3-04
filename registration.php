<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 20.03.2015
 * Time: 22:23
 */
include_once 'connect.php';

if (isset($_POST['submit'])) {
    $err = array();

    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $gender = htmlspecialchars($_POST['gender']);
    $email = htmlspecialchars($_POST['e_mail']);
    $photo = htmlspecialchars($_POST['photo_url']);
    $tel = htmlspecialchars($_POST['phone_number']);
    $group = htmlspecialchars($_POST['group']);
    $password = md5(md5(htmlspecialchars($_POST['password'])));

    //checking password
    if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
        $err[] = "Password shall consists of lower and upper case, numbers";
    }
    if (strlen($password) < 6 or strlen($password) > 32) {
        $err[] = "Password length shall be between 6-32";
    }

    //checking user on db
    $count_user = mysqli_query($con, "SELECT COUNT(email) FROM tb_student WHERE email='" . mysql_real_escape_string($email) . "'");
    if ($count_user > 0) {
        $err[] = "User already exists on database";
    }

    //if no error we can register user
    if (count($err) == 0) {
        mysqli_query($con, "INSERT INTO tb_student VALUES ('','$name','$surname','$password','$birthday','$gender'
                                                    ,'$email','$photo','$tel','$group')") or die(mysql_error());
    } else {
        echo "$err";
    }
}
?>
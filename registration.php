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

    //check all information
    if(!isset($_POST['name']) || empty($_POST['name'])){
        echo "Name is required";
    }
    //checking password
    if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
        $err[] = "Password shall consists of lower and upper case, numbers";
    } else if (strlen($password) < 8 or strlen($password) > 100) {
        $err[] = "Password length shall be between 8-100";
    }

    //checking user on db
    $count_user = mysqli_query($con, "SELECT COUNT(email) as COUNT FROM tb_student WHERE email='$email'");
    mysqli_close($con);
    $row = mysqli_fetch_assoc($count_user);
    if ($row['COUNT'] > 0) {
        $err[] = "User already exists on database";
    }
    $row = null;

    //if no error we can register user
    $user = 'student';
    if (count($err) == 0) {
        if ($user == 'student') {
            mysqli_query($con, "
            INSERT INTO tb_student (name, surname, password, birthday, gender, email, photo_url, phone_number, group_name)
            VALUES ('$name',
                    '$surname',
                    '$password',
                    '$birthday',
                    '$gender',
                    '$email',
                    '$photo',
                    '$tel',
                    '$group')")
            or die(mysqli_error($con));
            mysqli_close($con);
        } else if ($user == 'teacher') {
            mysqli_query($con,
            "INSERT INTO tb_teacher(name, surname, password, birthday, gender, email, photo_url, phone_number)
            VALUES( '$name',
                    '$surname',
                    '$password',
                    '$birthday',
                    '$gender',
                    '$email',
                    '$photo',
                    '$tel')")
            or die(mysqli_error($con));
            mysqli_close($con);
        }
        echo "Name: $name \n";
        echo "Surname: $surname \n";
        echo "Password: $password \n";
    } else {
        print "<b>При регистрация произошло ошибка</b><br>";
        foreach ($err AS $error) {
            print $error . "<br>";
        }
    }
}
?>
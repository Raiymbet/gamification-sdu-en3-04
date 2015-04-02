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
echo "<meta charset=\"utf-8\">";
if (isset($_COOKIE['id'])) {
    echo '<span>Cookie status: Есть</span><br>';
} else {
    echo '<span>Cookie status: Нет</span><br>';
}
if (isset($_COOKIE['id'])) {
    $time = time() - 3600 * 24;
    $maps = array('group', 'time', 'id', 'email', 'name', 'surname', 'password', 'birthday', 'photo_url', 'gender', 'telephone');
    for ($i = 0; $i < 11; $i++) {
        setcookie($maps[$i], '', $time);
    }
}

if (!isset($_POST['e_mail']) || empty($_POST['e_mail'])) {
    echo("'e_mail' not found");
}
if (!isset($_POST['password']) || empty($_POST['password'])) {
    exit("'password' not found");
}

/* Соединение с базы */
include_once 'connect.php';

$e_mail = $_POST['e_mail'];
$password = md5(md5($_POST['password']));

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
        echo '<span>Неправильный логин или пароль!</span>';
    } else {
        echo $id . " " . $name . " " . $surname;
        /* Fetch the value */
        $time = time() + 3600 * 24;
        setcookie("id", $id, $time);
        setcookie("name", $name, $time);
        setcookie("surname", $surname, $time);
        setcookie("birthday", $birthday, $time);
        setcookie("group", $group_name, $time);
        setcookie("telephone", $phone_number, $time);
        setcookie("gender", $gender, $time);
        setcookie("photo_url", $photo, $time);
        setcookie('email', $email, $time);
        setcookie("time", $time, $time);
        echo "<span>Авторизация прошла успешно! Ваши данные:</span><br>";
        if (isset($_COOKIE['id'])) {
            echo $_COOKIE['id'], "\n",
            $_COOKIE['name'], "\n",
            $_COOKIE['surname'], "\n",
            $_COOKIE['birthday'], "\n",
            $_COOKIE['group'], "\n",
            $_COOKIE['telephone'], "\n",
            $_COOKIE['gender'], "\n",
            $_COOKIE['photo_url'], "\n",
            $_COOKIE['time'];
        }
        header("Location: main_page.html");//Должен перенаправляет на страницу пользователя

    }
    /* Close statement */
    $stmt->close();
} else {
    echo "<span>Неправильный логин или пароль!</span>";
    /* Close connection */
    mysqli_close($con);
}

?>
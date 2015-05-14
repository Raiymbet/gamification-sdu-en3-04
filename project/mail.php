<?php
/* TODO:
 * Форма обратной связи
 * Цели
 * 1. Принимать сообщение через Post с помощью AJAX
 * 2. Отправка об успешной почты
 * 3. Занесение в базу об почте
 * 4. Параллельно отправить уведомление администрацию
 *
 * */
date_default_timezone_set('UTC');
if (isset($_POST['q'])) {
    $ip_address_client = $_SERVER['REMOTE_ADDR'];
    $today = date("Y-m-d H:i:s"); // // 2001-03-10 17:16:18 (формат MySQL DATETIME)

    $to = 'akzhol.b93@gmail.com'; //admin email
    if (!isset($_POST['e_mail']) || empty($_POST['e_mail'])) {
        echo 'Email is empty field';
        return false;
    }
    if (!isset($_POST['message']) || empty($_POST['message'])) {
        echo 'Message is empty field';
        return false;
    }
    if (!isset($_POST['subject']) || empty($_POST['subject'])) {
        echo 'Subject is empty field';
        return false;
    }
    $subject = $_POST['subject'];
    $email = $_POST['e_mail'];
    /*if (!preg_match("/^[А-Яа-яa-zA-Z0-9]*$/", $subject)) {
        echo 'Invalid subject format';
    }*/
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        return false;
    }
    if (empty($_POST["message"])) {
        $nameErr = "Name is required";
    }
    $message=$_POST['message'];
    $message = "Date:" . $today . "\n";
    $message .= "E-MAIL: " . $_POST['e_mail'] . "\n";
    $message .= "IP-Address: " . $ip_address_client;
    $message .= str_replace("\n.", "\n..", $_POST['message']);

    $headers = "From: system@bb.com <system@bb.com>\n" .
        "MIME-Version: 1.0" . "\r\n" .
        "Content-type: text/html; charset=UTF-8" . "\n";
    $message = wordwrap($message, 70, "\r\n") . "\n";
    echo $to . "\n";
    echo $headers . "\n";
    echo $message . "\n";
    echo $subject . "\n";
    return mail($to, $subject, $message, $headers);
} else {
    return false;
}
?>
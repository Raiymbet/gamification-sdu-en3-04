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
    include_once 'connect.php';
    $ip_address_client = $_SERVER['REMOTE_ADDR'];
    $today = date("Y-m-d H:i:s"); // // 2001-03-10 17:16:18 (формат MySQL DATETIME)

    $to = 'admin@bb.com';
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
    if (!preg_match("/^[a-zA-Z0-9]*$/", $subject)) {
        echo 'Invalid subject format';
        $text="Hello2";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        return false;
    }
    if (empty($_POST["message"])) {
        $nameErr = "Name is required";
    }
    $query = mysqli_query($con, "INSERT INTO mail(email, subject, message, ip_address, DATE_SEND) VALUES ('$email','$subject',$message,'$ip_address_client','$today')");
    $message = "Date:" . $today . "\r\n";
    $message .= "E-MAIL: " . $_POST['e_mail'] . "\r\n";
    $message .= "IP-Address: " . $ip_address_client;
    $message .= str_replace("\n.", "\n..", $_POST['message']);

    $headers = "From: system@bb.com <system@bb.com>\r\n" .
        "MIME-Version: 1.0" . "\r\n" .
        "Content-type: text/html; charset=UTF-8" . "\r\n";
    $message = wordwrap($message, 70, "\r\n") . "\r\n";
    echo $to . "\r\n";
    echo $headers . "\r\n";
    echo $message . "\r\n";
    echo $subject . "\r\n";
    return mail($to, $subject, $message, $headers);
} else {
    return false;
}
?>
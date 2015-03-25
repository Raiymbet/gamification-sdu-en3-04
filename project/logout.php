<?php
if (isset($_COOKIE['login_user'])) {
    $time = time() - 3600 * 24;
    setcookie('id', '', $time);
    setcookie('email', '', $time);
    setcookie('email', '', $time);
}
header("Location: main_page.html");
?>
<?php
if (isset($_COOKIE['login_user'])) {
    $time = time() - 3600 * 24;
    setcookie('login_user', 'bigbaak', $time);
}
header("Location: main_page.html");
?>
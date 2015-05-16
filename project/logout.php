<?php
    $time = time() - 3600 * 3600;
    setcookie("id", '', $time);
    setcookie("name", '', $time);
    setcookie("surname", '', $time);
    setcookie("birthday", '', $time);
    setcookie("group", '', $time);
    setcookie("user", '', $time);
    setcookie("telephone", '', $time);
    setcookie("gender", '', $time);
    setcookie("photo_url", '', $time);
    setcookie('email', '', $time);
    setcookie("time", '', $time);

header("Location: main_page.html");
?>
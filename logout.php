<?php
if (isset($_COOKIE['login_user'])) {
    setcookie('login_user', 'bigbaak', time() + (3600*24*3));
}
header("index.html");
//Здесь дополняешь значение, который хранятся в cookie.Абсолютно все
?>
<html>
<body>
My name is <?php
if (isset($_COOKIE['username'])) {
    echo $_COOKIE['username'];
    echo $_COOKIE['time'];
} else {
    echo 'NONE';
}
?>
<?php

setcookie('username', 'Bako', time() - 60);
setcookie('time', time() + 60, time() - 60);
?>
</body>
</html>
<?php
function check_user($con)
{
    if (!isset($_COOKIE['id']) || empty($_COOKIE['id'])) {
        return false;
    } else if (!isset($_COOKIE['email']) || empty($_COOKIE['email'])) {
        return false;
    } else if (!isset($_COOKIE['name']) || empty($_COOKIE['name'])) {
        return false;
    } else {
        $id = $_COOKIE['id'];
        $email = $_COOKIE['email'];
        $name = $_COOKIE['name'];
        $query = "SELECT id,email,name FROM tb_student WHERE id = ? && email = ? && name = ?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            print "Ошибка подготовки запроса\n";
            return false;
        } else {
            mysqli_stmt_bind_param($stmt, "iss", $id, $email, $name);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if ($res) {
                //$row = $res->fetch_assoc();
                mysqli_stmt_close($stmt);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        }

    }
}

?>
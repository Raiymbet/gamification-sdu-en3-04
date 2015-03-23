<?php
getUserData();
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

function getUserData()
{
    session_start();
    header("Content-Type: application/json; charset=utf-8");
    if (isset($_COOKIE['id'])) {
        $json = array('id' => $_COOKIE['id'], 'name' => $_COOKIE['name'], 'surname' => $_COOKIE['surname'], 'birthday' => $_COOKIE['birthday'], 'group' => $_COOKIE['group'], 'telephone' => $_COOKIE['telephone'], 'gender' => $_COOKIE['gender'], 'photo_url' => $_COOKIE['photo_url'], 'time' => $_COOKIE['time']);
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    } else if (isset($_SESSION['id'])) {
        $json = array('id' => $_SESSION['id'], 'name' => $_SESSION['name'], 'surname' => $_SESSION['surname'], 'birthday' => $_SESSION['birthday'], 'group' => $_SESSION['group'], 'telephone' => $_SESSION['telephone'], 'gender' => $_SESSION['gender'], 'photo_url' => $_SESSION['photo_url'], 'time' => $_SESSION['time']);
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        header("Location: main_page.html?problems=auth");
    }
}

?>
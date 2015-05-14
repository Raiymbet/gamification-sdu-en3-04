<?php
function check_user($con)
{
    if (!isset($_COOKIE['id']) || empty($_COOKIE['id'])) {
        return false;
    } else if (!isset($_COOKIE['email']) || empty($_COOKIE['email'])) {
        return false;
    } else if (!isset($_COOKIE['name']) || empty($_COOKIE['name'])) {
        return false;
    } else if (!isset($_COOKIE['user']) || empty($_COOKIE['user'])) {
        return false;
    } else {
        $id = $_COOKIE['id'];
        $email = $_COOKIE['email'];
        $name = $_COOKIE['name'];
        $user = $_COOKIE['user'];
        $query="";
        if ($user == 'student') {
            $query = "SELECT id,email,name FROM tb_student WHERE id = ? && email = ? && name = ?";
        } else {
            $query = "SELECT id,email,name FROM tb_teacher WHERE id = ? && email = ? && name = ?";
        }
        if ($stmt = $con->prepare($query)) {
            /* Execute it */
            $stmt->bind_param("sss", $id, $email, $name);
            $stmt->execute();
            $id_stmt = NULL;
            $email_stmt = NULL;
            $name_stmt = NULL;
            $stmt->bind_result($id_stmt, $email_stmt, $name_stmt);
            /* Bind results */
            $stmt->fetch();
            mysqli_stmt_close($stmt);
            if ($id_stmt != NULL) {
                echo 'GOOD'.$id_stmt;
                return true;
            } else {
                echo 'BAD';
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
        $json = array('id' => $_COOKIE['id'], 'email' => $_COOKIE['email'], 'name' => $_COOKIE['name'], 'surname' => $_COOKIE['surname'], 'birthday' => $_COOKIE['birthday'], 'group' => $_COOKIE['group'], 'telephone' => $_COOKIE['telephone'], 'gender' => $_COOKIE['gender'], 'photo_url' => $_COOKIE['photo_url'], 'time' => $_COOKIE['time']);
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    } else if (isset($_SESSION['id'])) {
        $json = array('id' => $_SESSION['id'], 'name' => $_SESSION['name'], 'surname' => $_SESSION['surname'], 'birthday' => $_SESSION['birthday'], 'group' => $_SESSION['group'], 'telephone' => $_SESSION['telephone'], 'gender' => $_SESSION['gender'], 'photo_url' => $_SESSION['photo_url'], 'time' => $_SESSION['time']);
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        header("Location: main_page.html?problems=auth");
    }
}

if (isset($_POST['q']) && $_POST['q'] == 'getUserData()') {
    getUserData();
}
?>
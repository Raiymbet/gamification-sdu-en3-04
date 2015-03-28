<?php
/**
 * TODO:
 * 1. Загрузка фото
 * 2. Регистрация в базе
 * 3.
 */
$id = 0;
//Перед отправкой, надо проверить пользователя.
//Совет: Не верь пользователю, не верь его слову и его cookie!Надо каждый действие проверять
//Проверка пользователя
include_once 'utils.php';
include_once 'connect.php';
if (check_user($con)) {
    $id = $_COOKIE['id'];
} else {
    header("auth.html?c=1");
}
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/jpeg"))
    && ($_FILES["file"]["size"] < 2000000)//approx. 2mb files can be uploaded
    && in_array($file_extension, $validextensions)
) {
    $filename = $_FILES["file"]["name"];
    $type = $_FILES["file"]["type"];
    $size = ($_FILES["file"]["size"] / 1024);
    $temp_file = $_FILES["file"]["tmp_name"];

    if (file_exists("upload/" . $_FILES["file"]["name"])) {
        echo $_FILES["file"]["name"] . " <b>already exists.</b> ";
    } else {
        move_uploaded_file($_FILES["file"]["tmp_name"],
            "upload/" . $_FILES["file"]["name"]);
    }

    $result = mysqli_query($con, "UPDATE tb_student SET photo_url='$filename' WHERE id=$id") or die("2");
    if (mysqli_num_rows($result) > 0) {
        //Комманда 2F:Что-то не так!
        mysqli_close($con);
        return 0;
    } else {
        mysqli_close($con);
        return 2;
    }
} else {
    echo "<span>***Invalid file Type or file Size Exceeded***<span>";
}
mysqli_close($con);
//PHP Image Uploading Code
?>

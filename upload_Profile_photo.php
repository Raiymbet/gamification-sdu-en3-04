<?php
/**
 * TODO:
 * 1. Загрузка фото
 * 2. Регистрация в базе
 * 3.
 */
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/jpeg"))
    && ($_FILES["file"]["size"] < 2000000)//approx. 2mb files can be uploaded
    && in_array($file_extension, $validextensions)
) {
    echo "<span>Your File Uploaded Succesfully...!!</span><br/>";
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
} else {
    echo "<span>***Invalid file Type or file Size Exceeded***<span>";
}
//PHP Image Uploading Code
?>

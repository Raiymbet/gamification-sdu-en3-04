<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 20.03.2015
 * Time: 21:42
 * 1. Priniat danniye polzovatelia
 * 2. Proverka polzovatelia
 * 3. Resultat logged, ili vy ne zaregistrirovani ili je ne pravilniy password
 */
include_once 'connect.php';

if (isset($_POST['submit'])) {
    $e_mail = $_POST['e_mail'];
    $password = $_POST['password'];
    $remember_checkbox = $_POST['remember_checkbox'];

    $db_password = mysqli_query($con,'SELECT  FROM tb_student');
}
?>
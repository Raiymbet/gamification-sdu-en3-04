<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Успешная регистрация</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/stylish-portfolio.css" rel="stylesheet" media="screen">
    <link href="css/mystyle.css" rel="stylesheet" media="screen">
    <!-- Add custom CSS here -->
    <!--
    Цель: Создать окно для студента
-->
</head>
<style>
    body {
        padding-top: 70px;
    }
</style>
<body>

<?php
include_once 'utils.php';
include_once 'connect.php';
//Для пробный проверки достаточные эти данные
if (check_user($con) == True) {
    printf("<script>console.log('Пользователь найден ... OK')</script>");
} else {
    header("Location: main_page.html");
}
mysqli_close($con);
require_once 'nav.php';
?>
<div class="container" style="margin-top:10%">
    <div class="row">
        <div class="col-8 col-offset-2">
            <div style="background:rgb(230, 224, 224);border-radius: 20px">
                <div class="row" style="margin:8px;padding: 8px">
                    <div class="col-3"><img src="img/symbol_correct.png" height="128px" width="128px" alt="">
                    </div>
                    <div class="col-9">
                        <?php
                        if(isset($_GET['name'])){
                            $name=$_GET['name'];
                        }else{
                            $name="Студент";
                        }
                        ?>
                        <h3 style="margin-top:2%;margin-left:2%;">Успешная регистрация</h3>
                        <h4 style="margin-left:10px;color:#7D7D7D">Добро Пожаловать,<?php echo $name."  "; ?>.Вы успешно зарегистрировались и вы можете использовать сервисы BattleBrains. </h4>
                        <div class="row">
                            <div class="col-6"><a role="button"  href="main_page.html" class="btn btn-default">Вернутся на главною страницу</a></div>
                            <div class="col-4 col-offset-1"><a role="button" href="student.php" class="btn btn-default">Зайти в свою страницу</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>
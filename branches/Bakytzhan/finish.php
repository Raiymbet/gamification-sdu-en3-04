<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BB: Результат</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="../../project/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../../project/fonts/glyphicons-halflings-regular.woff">
    <link href="../../project/css/stylish-portfolio.css" rel="stylesheet" media="screen">
    <link href="css/mystyle.css" rel="stylesheet" media="screen">
    <link href="../../project/fonts/glyphicons-halflings-regular.ttf">
    <!-- Add custom CSS here -->
    <!--
    Цель: Создать окно для студента
    -->
    </head>
<style>
    body {
        padding-top: 70px;
        background: url("img/gold.jpg");
        -moz-background-size: 100%; /* Firefox 3.6+ */
        -webkit-background-size: 100%; /* Safari 3.1+ и Chrome 4.0+ */
        -o-background-size: 100%; /* Opera 9.6+ */
        background-size: 100%;
    }
</style>
<body>
<?php
include_once 'utils.php';
include_once 'connect.php';
//Для пробный проверки достаточные эти данные
setcookie("id", "1", time() + 3600);
setcookie("name", "Raiymbet", time() + 3600);
setcookie("email", "tukpetov@bk.ru", time() + 3600);
setcookie("photo_url", "person_1.png", time() + 3600);
if (check_user($con) == True) {
    printf("<script>console.log('Пользователь найден ... OK')</script>");
} else {
    header("Location: main_page.html");
}
mysqli_close($con);
require_once 'nav.php';
?>
<div class="container" style="margin-top:70px">
    <div class="row">
        <div class="col-6 col-offset-3 nagrada-finish">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-2">
                            <h3 class="nagrada-finish">Поздравляю</h3></div>
                        <div class="col-2 col-offset-3">
                            <img class="img-thumbnail img-circle" src="img/person.png"
                                 style="width: 64px;height: 64px;margin-left: 40px">
                            <span class="player_name">Player1</span>
                        </div>
                        <div class="col-2 col-offset-1">
                            <img class="img-thumbnail img-circle" src="img/person_1.png"
                                 style="width: 64px;height: 64px;margin-left: 40px">
                            <span class="player_name">Player2</span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row ">
                        <div class="row ">
                            <div class="col-4 col-offset-1">
                                <p class="fd_text">Осталось времени</p>
                            </div>
                            <div class="col-3">
                                <span id="time_1">00:20</span>
                            </div>
                            <div class="col-3">
                                <span id="time_2">00:20</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-offset-1">
                                <p class="fd_text">Правильные ответы</p>
                            </div>
                            <div class="col-3">
                                <span id="corr_1">7</span>
                            </div>
                            <div class="col-3">
                                <span id="corr_2">7</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-offset-1">
                                <p class="fd_text">Выигранные награды</p>
                            </div>
                            <div class="col-3">
                                <img class="nagrada-finish" src="img/icon_award%20(1).png">
                                <img class="nagrada-finish" src="img/icon_award%20(2).png">
                                <img class="nagrada-finish" src="img/icon_award%20(4).png">
                                <img class="nagrada-finish" src="img/icon_award%20(6).png">
                                <img class="nagrada-finish" src="img/icon_award%20(5).png">
                            </div>
                            <div class="col-3">
                                <img class="nagrada-finish" src="img/icon_award%20(1).png">
                                <img class="nagrada-finish" src="img/icon_award%20(2).png">
                                <img class="nagrada-finish" src="img/icon_award%20(4).png">
                                <img class="nagrada-finish" src="img/icon_award%20(6).png">
                                <img class="nagrada-finish" src="img/icon_award%20(5).png">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-offset-1"><p class="fd_text">Общий счет</p></div>
                            <div class="col-3 col">
                                <p class="text-center gold_text" id="total_1">4090</p>
                            </div>
                            <div class="col-3">
                                <p class="text-center gold_text" id="total_2">4090</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-offset-5 col-3"><a href="student.php" role="button"
                                               class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-home" style="margin-left:-10px;"> </span> Перейти в
                    домой
                </a></div>
        </div>
    </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/finish_js.js"></script>
</body>
</html>
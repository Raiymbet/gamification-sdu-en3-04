<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student page</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="../../project/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../../project/css/stylish-portfolio.css" rel="stylesheet" media="screen">
    <link href="css/mystyle.css" rel="stylesheet" media="screen">
    <!-- Add custom CSS here -->
    <!--
    Цель: Создать окно для студента
    -->
</head>
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
<body>
<style>
    #editor {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
<div style="margin-left: 20px">
    <div class="row">
        <div style="margin-top:50px"></div>
        <div class="col-2" style="">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-3">
                            <img src="img/person.png" style="width:48px;height: 48px" class="img img-circle">
                        </div>
                        <div class="col-8" style="margin-top: 4px">
                            <a href="profile.php">Player1</a>

                            <div class="progress" style="margin-top: 6px">
                                <div class="progress-bar progress-bar-success" role="progressbar" id="progress1"
                                     aria-valuenow="40"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 40%"> 2 из 10
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-3">
                            <img src="img/person.png" style="width:48px;height: 48px" class="img-circle">
                        </div>
                        <div class="col-8" style="margin-top: 4px">
                            <a href="profile.php">Player2</a>

                            <div class="progress" style="margin-top: 6px">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 40%" id="progress2"> 2 из 10
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th class="text-center">Question</th>
                    <th class="text-center">Limit</th>
                    <th class="text-center">Score</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <p class="gold_text" style="color:green" name="ques">2/10</p>
                    </td>
                    <td>
                        <p class="gold_text" style="color:blue" id="time">00:00</p></td>
                    <td>
                        <p class="gold_text" name="score">0</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="type_1">
        <div class="col-7 col-offset-2">
            <div class="panel panel-default">
                <div class="question" id="que" style="margin-bottom: 50px">
                    Пожалуйста, найдите и исправьте ошибку в коде
                </div>
                <div class="row" id="editor">
                    ssss
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/dreamweaver");
    editor.getSession().setMode("ace/mode/python").resize();
//    editor.getSession().setMode("ace/mode/json");

  //  editor.getSession().setMode("ace/mode/java");
    //editor.setValue("the new text here"); // or session.setValue
    //editor.getValue(); // or session.getValue
</script>
<script>
</script>
</body>
</html>
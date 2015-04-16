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
    <!--
    Пробле
    Цель: Создать окно вопроса для студента-->
</head>
<style>
</style>
<body>
    <?php
    if(isset($_GET['id'])){
        printf('<script type="text/javascript">var id_tournament=%s;
    </script>',$_GET['id']);}
        else{
           printf('<script type="text/javascript">window.open("error.php","_self");
       </script>');
       }
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
    -require_once 'nav.php';
    ?>
    <div class="col-2" style="margin-top:4%">
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
</div>
<div class="row">
    <div class="col-7">
        <table class="table table-bordered text-center" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Question</th>
                    <th class="text-center">Limit</th>
                    <th class="text-center">Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><p class="gold_text" style="color:green" name="ques">2/10</p> </td>
                    <td> <div id="circle"></div>
                    </td>
                    <td> <p class="gold_text" name="score">0</p> </td>
                </tr>
            </tbody>
        </table>
    </div> <div class="row" id="type_1">
    <div class="col-7">
        <div class="panel panel-default" style="width:98%">
            <div class="question" id="que" style="margin-bottom: 50px;margin-top:">
                <!-- Здесь задается вопрос -->
            </div>
            <div class="row">
                <p class="col-10 answers_item" id="ANS1" name="1">
                    Вариант А
                </p>
            </div>
            <div class="row">
                <p class="col-10 col-offset-1 answers_item" name="2" id="ANS2">
                    Вариант Б
                </p>
            </div>
            <div class="row">
                <p class="col-10 answers_item" name="3" id="ANS3" >
                    Вариант В
                </p>
            </div>
            <div class="row">
                <p class="col-10 col-offset-1 answers_item" name="4" id="ANS4">
                    Вариант Г
                </p>
            </div>
        </div>
    </div>
</div>
<div class="col-7" id="type_2">
    <div class="panel panel-default">
        <div class="question" id="p_for_question" style="margin-bottom: 50px">
            <!-- Здесь задается вопрос -->
        </div>
        <div class="col-11 col-offset-1">
            <ul id="ul_for_answer"></ul>
        </div>
        <button id="finish" class="btn btn-danger" style="margin-left: 70%">Next >>></button>
        <div style="margin-top:50px"></div>
    </div>
</div>

</div>
    <!-- Каждый тип вопроса буду звать как type_1
        type_1 - > Обычный вопрос
        type_2 - > Вопрос с разбросанным ответом
    -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../../project/js/jquery-ui.js"></script>
    <script src="js/lightweight.js"></script>
    <script  src="js/script_js_question.js"></script>
</body>
</html>
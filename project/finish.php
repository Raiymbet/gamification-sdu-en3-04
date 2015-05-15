<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BB: Результат</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="fonts/glyphicons-halflings-regular.woff">
    <link href="css/stylish-portfolio.css" rel="stylesheet" media="screen">
    <link href="css/mystyle.css" rel="stylesheet" media="screen">
    <link href="fonts/glyphicons-halflings-regular.ttf">
    <!-- Add custom CSS here -->
    <!--
    Цель: Создать окно для студента
    Проблема:
    1.Cтудент шешімін шығару жерінде бірнеше зат жетпей жатыр.
     1.1 екі студент ойнаса, сол кім ұтқаның көрсететін 
    белгі
    1.2.Фон ұнап тұр. Ортаңғы беті өте аз орын алады
    Решено.20:30
    2.Finish.php серверден мәлімет POST аркылы алу керек.
    2.1.question.php - > finishResult() жане calculateResult.php жерлерін дұрыстатшы

    3.Одно изменение и еще одна таблица
    3.1.Добавиль счетчик для правильных ответов в tb_student_result
    3.2. Таблица для определение победителя. 
    ::id,id_studen_result1,id_student_result2, 
    which_winner='Player1'
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
if (check_user($con) == True) {
    printf("<script>console.log('Пользователь найден ... OK')</script>");
} else {
    header("Location: main_page.html");
}
include_once 'nav.php';
$data = array();
$id_result = $_GET['id_result'];
if (!isset($_GET['id_result']) && empty($_GET['id_result'])) {
    header("Location: error.php");
}
$query = mysqli_query($con, "SELECT
        A.id as id,
        D.name as name,
        D.surname as surname,
        D.photo_url as photo_url,
        B.time_limit as time_limit,
        B.title as title,
        B.when_closed as date_closed,
        COUNT(C.id) as total_questions,
        A.score as score,
        A.time_end as time_end,
        A.datetime as datetime_played,
        A.correct_answers as correct_answers
        FROM tb_student_result A,tb_tournaments B, tb_questions C,tb_student D WHERE 
        A.id_student=D.id and A.id_tournament=B.id and A.id_tournament=C.id_tournament and A.id='$id_result'") or die("Error: " . mysqli_error($con));
if ($query && mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $data['player']['name'] = $row['name'];
        $data['player']['surname'] = $row['surname'];
        $data['player']['time_limit'] = $row['time_limit'];
        $data['player']['title'] = $row['time_limit'];
        $data['player']['total_questions'] = $row['total_questions'];
        $data['player']['date_closed'] = $row['date_closed'];
        $data['player']['score'] = $row['score'];
        $data['player']['time_end'] = $row['time_end'];
        $data['player']['photo_url'] = $row['photo_url'];
        $data['player']['datetime_played'] = $row['datetime_played'];
        $data['player']['correct_answers'] = $row['correct_answers'];
    }
    $player1_score = $data['player']['correct_answers'] * 100 + $data['player']['time_end'];
    $player2_score = $data['player']['correct_answers'] * 100 + $data['player']['time_end'] + 10;

    if (isset($_REQUIRE['id_player2'])) {
    }
}
?>
<div class="container" style="margin-top:70px">
    <div class="row">
        <div class="col-6 col-offset-3 nagrada-finish">
            <div class="panel panel-info">
                <div class="panel-heading">
                        <div class="row">

                            <div class="col-2">
                                <h3 class="nagrada-finish">Поздравляю</h3></div>
                            <div class="col-2 col-offset-4">
                                <img class="img-thumbnail img-circle"
                                     src="img/<?php echo $data['player']['photo_url'] ?>"
                                     style="width: 64px;height: 64px;margin-left: 40px">
                                <span class="player_name"><? echo $data['player']['name']; ?></span>
                            </div>
                       <!--     <div class="col-2 col-offset-2">
                                <img class="img-thumbnail img-circle"
                                     src="img/<?php echo $data['player']['photo_url'] ?>"
                                     style="width: 64px;height: 64px;margin-left: 40px">
                                <span class="player_name"><? echo $data['player']['name']; ?></span>
                            </div> -->
                            </div>
                        </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-4 col-offset-2">
                                <p class="fd_text">Осталось времени</p>
                            </div>
                            <div class="col-3">
                                        <span id="time_1"><?
                                            $hours = floor($data['player']['time_end'] / 3600);
                                            $mins = floor(($data['player']['time_end'] - ($hours * 3600)) / 60);
                                            $secs = floor($data['player']['time_end'] % 60);
                                            printf("%s:%s", ($mins > 9) ? $mins : '0' . $mins, ($secs > 9) ? $secs : '0' . $secs);
                                            ?></span>
                            </div>
                            <!--<div class="col-3  col-offset-2">
                                            <span id="time_2"><?
                                                $hours = floor($data['player']['time_end'] / 3600);
                                                $mins = floor(($data['player']['time_end'] - ($hours * 3600)) / 60);
                                                $secs = floor($data['player']['time_end'] % 60);
                                                printf("%s:%s", ($mins > 9) ? $mins : '0' . $mins, ($secs > 9) ? $secs : '0' . $secs);
                                                ?></span>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-4 col-offset-2">
                                <p class="fd_text">Правильные ответы</p>
                            </div>
                            <div class="col-3">
                                <span id="corr_1"><?php echo $data['player']['correct_answers']; ?></span>
                            </div>
                           <!-- <div class="col-3 col-offset-2">
                                <span id="corr_2"><?php echo $data['player']['correct_answers']; ?></span>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-4 col-offset-2">
                                <p class="fd_text">Выигранные награды</p>
                            </div>
                            <div class="col-3">
                                <img class="nagrada-finish" src="img/icon_award%20(1).png">
                                <img class="nagrada-finish" src="img/icon_award%20(2).png">
                                <img class="nagrada-finish" src="img/icon_award%20(4).png">
                                <img class="nagrada-finish" src="img/icon_award%20(6).png">
                                <img class="nagrada-finish" src="img/icon_award%20(5).png">
                            </div>
                       <!--     <div class="col-3 col-offset-2">
                                <img class="nagrada-finish" src="img/icon_award%20(1).png">
                                <img class="nagrada-finish" src="img/icon_award%20(2).png">
                                <img class="nagrada-finish" src="img/icon_award%20(4).png">
                                <img class="nagrada-finish" src="img/icon_award%20(6).png">
                            </div> -->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-offset-2"><p class="fd_text">Общий счет</p></div>
                            <div class="col-3 col">
                                <p class="text-center gold_text" id="total_1">
                                    <?php echo $player1_score > $player2_score ? '
                                                    <img class="nagrada-finish" src="img/cup.png">' : '';
                                    echo $player1_score;
                                    ?></p>
                            </div>
                         <!--   <div class="col-3  col-offset-2">
                                <p class="text-center gold_text" id="total_2">
                                    <?php echo $player2_score > $player1_score ? '
                                                        <img class="nagrada-finish" style="margin:4px;width:36px;height:36px" src="img/cup.png">' : '';
                                    echo $player2_score; ?></p>
                            </div> -->
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
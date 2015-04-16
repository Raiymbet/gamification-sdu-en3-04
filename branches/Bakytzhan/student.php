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
    <link href="css/mystyle.css" rel="stylesheet" media="screen"></head>
    <body>
    <!--
    Проблема:
    1.Решить проблему с запросом рейтинг
    РЕШЕНО 17:15
    2.Решить проблему с собирание данных людей
    SUM(),COUNT,COUNT,CUNT
-->
<?php
include_once 'utils.php';
include_once 'connect.php';
//Для пробный проверки достаточные эти данные
setcookie("id", "1", time() + 3600);
setcookie("name", "Raiymbet", time() + 3600);
setcookie("email", "tukpetov@bk.ru", time() + 3600);
setcookie("photo_url", "person_1.png", time() + 3600);
if (check_user($con) == True) {
    printf("<script>console.log('Пользователь найден ... OK')</script>
        ");
} else {
    header("Location: main_page.html");
}
require_once 'nav.php';
?>
<div class="container">
    <div class="row">
        <div class="col-2" style="position:fixed">
            <div class="list-group">
                <a role="link" href="#" name="Home" class="list-group-item active">Главная</a>
                <a role="link" href="#" name="Profile" class="list-group-item">Награды</a>
                <a role="link" href="#" name="Messages" class="list-group-item">Рейтинг</a>
                <a role="link" class="list-group-item">...</a>
            </div>
        </div>
        <div class="col-8 col-offset-3" id="main-frame">
            <div class="well" style="height:660px">
                <?php
                $query = mysqli_query($con, "SELECT A.id as id,A.title as title,A.id_teacher as teacher,A.time_limit as time_limit,A.description as description,COUNT(B.id) as tQuestion FROM `tb_tournaments` A,tb_questions B WHERE B.id_tournament=A.id and A.public=1 and A.id_groups=1 GROUP BY id,title,teacher,time_limit,description") or die(mysqli_errr($con));

                if ($query && mysqli_num_rows($query) >
                    0
                    ) {
                    while ($row = mysqli_fetch_array($query)) {
                        $hours = floor($row['time_limit'] / 3600);
                        $mins = floor(($row['time_limit'] - ($hours * 3600)) / 60);
                        $secs = floor($row['time_limit'] % 60);
                        printf('
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">%s</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="col-2">
                                        <img class="img-circle" src="img/sc1.png" style="width:50px;height: 50px"></div>
                                        <div class="col-8">
                                            <p>Время: %s:%s</p>
                                            <p>500 Очко</p>
                                            <p>%s вопросов</p>
                                        </div>
                                        <div class="col-1">
                                            <a href="question.php?id=%s" class="btn btn-danger btn-lg">Play</a>
                                        </div>
                                    </div>
                                </div>
                                ', $row['title'], ($mins > 9) ? $mins : '0' . $mins, ($secs > 9) ? $secs : '0' . $secs, $row['tQuestion'], $row['id']);
}
}
?>
</div>
</div>
<!-- Nagrada frame -->
<div class="col-8  col-offset-3" id="nagrada-frame" style="display: none">
    <div class="well">
        <div class="panel">
            <div id="staticChart"></div>

        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff">
                    <h4>Общая статистика</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <?php
                        $query = mysqli_query($con, "SELECT A.id_student,
                            SUM(A.score) as SUM_SCORE,
                            SUM(A.time_end) as SUM_TIME,
                            SUM(A.correct_answers) as SUM_CORRECT
                            FROM tb_student_result A 
                            where A.id_student=1") or die(mysqli_error($con));
                        $row = mysqli_fetch_array($query);
                        $query2 = mysqli_query($con, "SELECT COUNT(B.id) as COUNT
                            FROM tb_student_result A,tb_questions B 
                            WHERE A.id_tournament=B.id_tournament and A.id_student=1;");
                        $row2 = mysqli_fetch_array($query2);
                        $COUNT = $row2['COUNT'];
                        $NEPRAVILNIE = $COUNT - $row['SUM_CORRECT'];
                        $AVG = $NEPRAVILNIE / $COUNT * 100;
                        printf(" <tr>
                            <td>Общие балл</td>
                            <td>%s</td>
                        </tr>
                        <tr>
                            <td>Рейтинг</td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td>Количество правильных ответов</td>
                            <td>%s</td>
                        </tr>
                        <tr>
                            <td>Количество неправильных ответов</td>
                            <td>%s</td>
                        </tr>
                        <tr>
                            <td>Средний успех</td>
                            <td>%s</td>
                        </tr>
                        <tr>
                            <td>Общие количество задание</td>
                            <td>%s</td>
                        </tr>", $row['SUM_SCORE'], $row['SUM_CORRECT'], $NEPRAVILNIE, $AVG, $COUNT);
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="note_awards"
                    style="display:none;z-index:2; background-color:rgba(255,255,255,0.8);position:absolute;min-width:50px;min-height:50px;left:200px;top:100px;border-radius:5%;border:1px solid black">
                    <div class="col-3"><img id="note_img" src="img/icon_award (1).png" height="64" width="64"></div>
                    <div id="note_description" class="col-6">Он получил это за доблесть</div>
                </div>
                <div class="nagrada">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
                    width="100px">
                    <div class="carousel-inner" role="listbox" style="">
                        <div class="item active">
                            <div class="nagrada">
                                <img name="0" src="img/icon_award (3).png" alt="...">
                                <img name="1" src="img/symbol_correct.png" alt="...">
                                <img name="2" src="img/body_arm.png" height="64" width="64" alt="...">
                                <img name="3" src="img/stopwatch.png" alt="...">
                                <img name="4" src="img/award.png" height="64" width="64" alt="...">
                                <img name="5" src="img/cup.png" alt="...">
                            </div>
                        </div>
                        <div class="item">
                            <div class="nagrada">

                            </div>
                        </div>
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0"
                            class="active"></li>
                            <!--     <li data-target="#carousel-example-generic" data-slide-to="1"></li> -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Raiting frame -->
<div class="col-8 col-offset-3" id="raiting-frame">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-1 ">
                    <img src="img/cup.png" width="54px" height="54px"></div>
                    <div class="col-4 ">
                        <h3><b>ТОП ЛУЧШИХ</b>
                        </h3>
                    </div>
                </div>
            </div>
            <!-- Надо укоротить код -->
            <div class="panel-body" style="min-height:560px">
                <div class="raiting_item">
                    <?php
                    $query = mysqli_query($con, "SELECT
                        B.id as id_student,
                        B.name as name,
                        B.surname as surname,
                        B.photo_url as photo_url,
                        SUM(A.score) as total_score,
                        C.id_groups as id_groups,
                        D.title as group_name 
                        FROM tb_student_result A,tb_student B,tb_group_students C,tb_groups D 
                        where A.id_student=B.id and A.id_student=C.id_student and C.id_groups=D.id
                        GROUP BY id_student,name,surname,photo_url,id_groups,group_name ORDER BY total_score DESC LIMIT 10") or die(mysqli_error($con));
                    $i = 1;
                    if (!$query || mysqli_num_rows($query) >
                        0
                        ) {
                        while ($row = mysqli_fetch_array($query)) {
                            printf('
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-1">
                                            <h2>%s</h2>
                                        </div>
                                        <div class="col-1">
                                            <img src="img/%s"></div>
                                            <div class="col-6">
                                                <h4>
                                                    <a href="../ALimkhan/profile.php?id=%s">%s</a>
                                                </h4>
                                                <h4>%s</h4>
                                            </div>
                                            <div class="col-2">
                                                <h4 class="gold_text">%s</h4>
                                            </div>
                                        </div>
                                    </div>
                                    ', $i++, $row['photo_url'], $row['id_student'], $row['surname'] . ' ' . $row['name'], $row['group_name'], $row['total_score']);
}
}
?> </div>
</div>
</div>
</div>
</div>
</div>
<div class="footer"> 
    <span class="text-info left"> © 2015 Gamers Team.</span>
    <span class="text-info right" style="float:right">Students of <a href="http://sdu.edu.kz"> Suleyman
        Demirel University</a></span>
    </div>
</body>
<script src="../../project/js/jquery-1.10.2.js"></script>
<script src="../../project/js/bootstrap.js"></script>

<script type="text/javascript" src="../../project/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="../../project/js/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="../../project/js/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="../../project/js/jqplot.cursor.min.js"></script>
<script type="text/javascript" src="../../project/js/jqplot.pointLabels.min.js"></script>
<link rel="stylesheet" type="text/css" hrf="../../project/css/jquery.jqplot.min.css" />
<script type="text/javascript" src="js/student_js.js"></script>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student page</title>
    <link rel="shortcut icon" href="../../project/img/favicon.ico" type="image/x-icon">
    <link href="../../project/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../../project/css/stylish-portfolio.css" rel="stylesheet" media="screen">
    <link href="../../project/css/mystyle.css" rel="stylesheet" media="screen">
</head>
<body>
<?php
include_once 'utils.php';
include_once 'connect.php';
//Для пробный проверки достаточные эти данные
if (check_user($con) == True) {
    printf("<script>console.log('Пользователь найден ... OK')</script>
        ");
} else {
    //header("Location: main_page.html");
}
//require_once 'nav.php';
if(!isset($_GET['id'])){
    header("Location: error.php?message='Не найден идентификатор турнира'");
}
$id=$_GET['id'];
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img alt="Brand" src="img/icon.png" style="width: 32px;height: 32px"> BattleBrains
                </a>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../ALimkhan/profile.php?id="><img src="img/%s"
                                                               style="width: 32px;height: 32px;margin-right: 8px;margin-top: -8px">%s</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">More
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-book"></span> Contacts</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse   -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="row">
        <div class="col-6 col-offset-2">

        </div>
    </div>
    <div class="row">
            <div class="panel panel-info">

                <div class="panel-body" style="max-height: 400px;overflow: auto">
                    <!-- Student spisok -->
                    <!--Sleva, pokazivaet sostayenie u4ineka... ili tablica?Skoree vsego, tablicta -->
                    <table class="table table-bordered">
                        <!-- Student id,Student name,Added_time, Marks, Time -->
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя студента</th>
                            <th>Время сдачи</th>
                            <th>Оценка</th>
                            <th>Время</th>
                            <th>Ответы</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        include_once 'connect.php';
                        $average_score = 0;
                        $i = 0;
                        $average_time = 0;
                        $max_score = 0;
                        $min_score = 0;
                        $query = mysqli_query($con, "SELECT B.id as id,CONCAT(B.name,' ',B.surname) as name,B.photo_url as photo_url,A.score as score,A.time_end as time_end,A.datetime as datetime,A.correct_answers as correct_answers,(SELECT COUNT(id) from tb_questions D where D.id_tournament=A.id_tournament) as Koli4estvo,C.time_limit as time_limit
          FROM tb_student_result A,tb_student B,tb_tournaments C
          WHERE A.id_student=B.id and A.id_tournament=C.id and A.id_tournament=$id") or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($query)) {
                            $average_score = $row['score'] + $average_score;
                            $average_time = $row['time_end'] + $average_time;
                            $i++;
                            printf("<tr><td>%s</td><td><img  class='img img-circle' src='img/%s' width='32' height='32'>%s</td><td>%s секунд из %s секунд</td><td>%s</td><td>%s</td><td>%s из %s</td></tr>", $row['id'], $row['photo_url'], $row['name'], $row['time_end'], $row['time_limit'], $row['score'], $row['datetime'], $row['correct_answers'], $row['Koli4estvo']);
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="panel-panel-default">
                <div class="panel-body">
                    <table>
                        <tr>
                            <td><p><span
                                        class="glyphicon glyphicon-unchecked"></span><? echo ' Средняя оценка: ' . round($average_score / $i); ?>
                                    очко</p></td>
                        </tr>
                        <tr>
                            <td><p><span
                                    class="glyphicon glyphicon-time"></span><? echo ' Средняя время: ' . round($average_time / $i); ?>
                                секунд
                            </p></td>
                        </tr>
                        <tr>
                            <td> <a href="student.php" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"></span> Назад к домашнный странице</a></td>
                        </tr>
                    </table>

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
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>

</html>
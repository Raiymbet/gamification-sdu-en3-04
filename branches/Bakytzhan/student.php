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
                <div class="col-2 small" style="position:fixed">
                    <div class="list-group">
                        <a role="link" href="#" name="Home" class="list-group-item active">Главная</a>
                        <a role="link" href="#" name="Profile" class="list-group-item">Награды</a>
                        <a role="link" href="#" name="Messages" class="list-group-item">Рейтинг</a>
                        <a role="link" class="list-group-item">...</a>
                    </div>
                </div>
                <div class="col-8 small col-offset-2" id="main-frame">
                    <div class="well" style="height:660px">
                        <?php
                        $query = mysqli_query($con, "SELECT A.id as id,A.title as title,A.id_teacher as teacher,A.time_limit as time_limit,A.description as description,COUNT(B.id) as tQuestion FROM `tb_tournaments` A,tb_questions B WHERE B.id_tournament=A.id and A.public=1 and A.id_groups=1 GROUP BY id,title,teacher,time_limit,description") or die(mysqli_errr($con));

                        if($query && mysqli_num_rows($query)>
                            0){
                            while($row=mysqli_fetch_array($query)){
                                $hours = floor($row['time_limit'] / 3600);
                                $mins = floor(($row['time_limit'] - ($hours*3600)) / 60);
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
                                                    <a href="question.php?id=%s" class="btn btn-danger">Play</a>
                                                </div>
                                            </div>
                                        </div>
                                        ',$row['title'],($mins>9)?$mins:'0'.$mins,($secs>9)?$secs:'0'.$secs,$row['tQuestion'],$row['id']);}
}
?>
</div>
</div>
<!-- Nagrada frame -->
<div class="col-8 small col-offset-2" id="nagrada-frame" style="display: none">
    <div class="well">
        <div class="panel">
            <div class="row">
                <div class="col-12">
                    <div id="container"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff">
                    <h4>Общая статистика</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Общие балл</td>
                            <td>4003</td>
                        </tr>
                        <tr>
                            <td>Рейтинг</td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td>Количество правильных ответов</td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td>Количество неправильных ответов</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>Общие количество задание</td>
                            <td>30</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="nagrada">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
                        width="100px">
                        <div class="carousel-inner" role="listbox" style="">
                            <div class="item active">
                                <div class="nagrada">
                                    <img src="img/sc1.png" alt="...">
                                    <img src="img/sc1.png" alt="...">
                                    <img src="img/sc1.png" alt="...">
                                    <img src="img/sc1.png" alt="...">
                                    <img src="img/sc1.png" alt="..."></div>
                                </div>
                                <div class="item">
                                    <div class="nagrada">
                                        <img src="img/sc1.png" alt="...">
                                        <img src="img/sc1.png" alt="...">
                                        <img src="img/sc1.png" alt="...">
                                        <img src="img/sc1.png" alt="...">
                                        <img src="img/sc1.png" alt="..."></div>
                                    </div>
                                    <div class="item">
                                        <div class="nagrada">
                                            <img src="img/sc1.png" alt="...">
                                            <img src="img/sc1.png" alt="...">
                                            <img src="img/sc1.png" alt="...">
                                            <img src="img/sc1.png" alt="...">
                                            <img src="img/sc1.png" alt="..."></div>
                                        </div>
                                    </div>
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-generic" data-slide-to="0"
                                        class="active"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Raiting frame -->
        <div class="col-8 small col-offset-2" id="raiting-frame">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-1 small">
                            <img src="img/cup.png" width="54px" height="54px"></div>
                            <div class="col-4 small">
                                <h3> <b>ТОП ЛУЧШИХ</b>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!-- Надо укоротить код -->
                    <div class="panel-body" style="min-height:560px">
                        <div class="raiting_item">
                            <?php
                            $query = mysqli_query($con, "SELECT
                                A.id as id,
                                B.id as id_student,
                                B.name as name,
                                B.surname as surname,
                                B.photo_url as photo_url,
                                A.score as score, 
                                SUM(A.score) as total_score,
                                C.id_groups as id_groups,
                                D.title as group_name 
                                FROM tb_student_result A,tb_student B,tb_group_students C,tb_groups D 
                                where A.id_student=B.id and A.id_student=C.id_student and C.id_groups=D.id and A.score>200
                                GROUP BY id,id_student,name,surname,photo_url,score,id_groups,group_name ORDER BY total_score,id_student") or die(mysqli_error($con));
                            $i = 1;
                            if (!$query || mysqli_num_rows($query) >
                                0) {
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
?>
</div>
</div>
</div>
</div>
</div>
</body>
<script src="../../project/js/jquery-1.10.2.js"></script>
<script src="../../project/js/bootstrap.js"></script>
<script type="text/javascript" src="../../project/js/flotr2.min.js"></script>
<script type="text/javascript" src="js/student_js.js"></script>
</html>
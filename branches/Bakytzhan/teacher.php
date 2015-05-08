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
    <link href="css/mystyle.css" rel="stylesheet" media="screen"></head>
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
        ?>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <img alt="Brand" src="img/icon.png" alt="No photo" style="width: 32px;height: 32px">BattleBrains</a>
                        </div>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="../ALimkhan/profile.php?id=">
                                    <img src="img/%s" alt="User_photo"
                                    style="width: 32px;height: 32px;margin-right: 8px;margin-top: -8px">%s</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        More
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="#">
                                                <span class="glyphicon glyphicon-cog"></span>
                                                Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="glyphicon glyphicon-question-sign"></span>
                                                Help
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="glyphicon glyphicon-book"></span>
                                                Contacts
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="logout.php">
                                                <span class="glyphicon glyphicon-off"></span>
                                                Log Out
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse   --> </div>
                        <!-- /.container-fluid -->
                    </nav>
                    <div class="container">
                        <div class="row">
                            <div class="col-2" style="position:fixed">
                                <div class="list-group">
                                    <a role="link" href="#" name="Home" class="list-group-item active">
                                        <span class="glyphicon glyphicon-home"></span>
                                        Главная
                                    </a>
                                    <a role="link" href="#" name="Messages" class="list-group-item">
                                        <span class="glyphicon glyphicon-stats"></span>
                                        Рейтинг студентов
                                    </a>
                                    <a role="link" href="#" name="group" class="list-group-item">
                                        <img src="img/group_icon.png" style="margin-bottom:-1px;weight:18px;height:18px;">Группа</a>
                                        <a role="link" href="#" name="Messages" class="list-group-item">
                                            <span class="glyphicon glyphicon-stats"></span>
                                            Статистика
                                        </a>
                                        <a role="link" class="list-group-item">...</a>
                                    </div>
                                </div>
                                <div class="col-8 col-offset-3" id="main-frame">
                                    <div class="well" style="height:660px;">
                                        <?php
                                        $query = mysqli_query($con, "SELECT A.id as id,A.title as title,DATE_FORMAT(A.datetime_added,'%d.%m.%Y') as datetime_added,A.id_teacher as teacher,A.time_limit as time_limit,A.description as description,COUNT(B.id) as tQuestion FROM `tb_tournaments` A,tb_questions B
                                            WHERE B.id_tournament=A.id and A.public=1 and A.id_groups=1 GROUP BY id,title,teacher,time_limit,description") or die(mysqli_errr($con));

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
                                                            <h3 class="panel-title">
                                                                %s
                                                                <small>Добавлен в %s</small>
                                                            </h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="col-1">
                                                                <img class="img-circle" src="img/sc1.png" style="width:36px;height: 36px"></div>
                                                                <div class="col-3">
                                                                    <span>Время: %s:%s</span>
                                                                    <br>
                                                                    <span>500 Очков</span>
                                                                    <br>
                                                                    <span>%s вопросов</span>
                                                                </div>
                                                                <div class="col-5 pull-right" style="padding-right: 0">
                                                                    <div class="btn-group" role="group" aria-label="...">
                                                                        <a href="tournaments_result.php?id=%s"  type="button" class="btn btn-danger btn-sm">
                                                                            <span class="glyphicon glyphicon-plus"></span>
                                                                            See Result
                                                                        </a>
                                                                        <a href="question.php?id=%s" type="button" class="btn btn-danger btn-sm">
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                            Edit
                                                                        </a>
                                                                        <a href="tournaments_delete.php?id=%s" type="button" class="btn btn-danger btn-sm">
                                                                            <span class="glyphicon glyphicon-trash"></span>
                                                                            Delete
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        ', $row['title'],$row['datetime_added'], ($mins > 9) ? $mins : '0' . $mins, ($secs > 9) ? $secs : '0' . $secs, $row['tQuestion'], $row['id'],$row['id'],$row['id']);
}
}
?>
</div>
</div>
<!-- Nagrada frame -->
<div class="col-8  col-offset-3" id="nagrada-frame" style="display: none">
    <div class="well">
        <div class="panel">
                    <!-- <div id="staticChart"></div>
                -->
            </div>
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #fff">
                        <h4>Общая статистика</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <?php
                            $id_student = $_COOKIE['id'];
                            echo $id_student;
                            $query = mysqli_query($con, "SELECT A.id_student,
                                SUM(A.score) as SUM_SCORE,
                                SUM(A.time_end) as SUM_TIME,
                                SUM(A.correct_answers) as SUM_CORRECT
                                FROM tb_student_result A 
                                where A.id_student='$id_student' ") or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            $query2 = mysqli_query($con, "SELECT COUNT(B.id) as COUNT
                                FROM tb_student_result A,tb_questions B 
                                WHERE A.id_tournament=B.id_tournament and A.id_student='$id_student';");
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
                            </tr>
                            ", $row['SUM_SCORE'], $row['SUM_CORRECT'], $NEPRAVILNIE, $AVG, $COUNT);
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
                        <div class="col-3">
                            <img id="note_img" src="img/icon_award (1).png" height="64"
                            width="64"></div>
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
                                        <img name="5" src="img/cup.png" alt="..."></div>
                                    </div>
                                    <div class="item">
                                        <div class="nagrada"></div>
                                    </div>
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-generic" data-slide-to="0"
                                        class="active"></li>
                                    <!--     <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                -->
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
                                            <div class="col-5">
                                                <h4>
                                                    <a href="profile.php?id=%s">%s</a>
                                                </h4>
                                                <h4>%s</h4>
                                            </div>
                                            <div class="col-1 pull-right" style="margin-right: 56px">
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
<!-- Group -->
<div class="col-8 col-offset-3" id="group-frame">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-1 ">
                    <img src="img/group_icon.png" width="54px" height="54px"></div>
                    <div class="col-4 ">
                        <h3> <b>Мой группы</b>
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Надо укоротить код -->
            <div class="panel-body" style="min-height:560px">
                <div class="modal fade bs-example-modal-sm"  id="myModal" >
                    <div class="modal-dialog modal-sm" style="width:400px" >
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Создать новою группу</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                               <div class="form-group">
                                   <div class="row">
                                       <div class="col-12">
                                        <label for="new_group_name" class="col-sm-2 control-label">Имя группы</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="new_group_name" placeholder='Имя группы'>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:8px">
                                    <div class="col-12">
                                        <div class="btn-group" role="group" aria-label="...">
                                            <button type="button" onclick='selCategory("eng")' class="btn btn-default">English</button>
                                            <button type="button" onclick='selCategory("math")'class="btn btn-default">Mathematics</button>
                                            <button type="button" onclick='selCategory("IT")' class="btn btn-default">IT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыт</button>
                        <button type="button" class="btn btn-primary" id='groud_add_btn'>Создать группу</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <div class="row">
           <div class="col-3">
               <ul class="nav nav-pills nav-stacked">
                   <?php

                   $query=mysqli_query($con,"SELECT * FROM tb_groups") or die(mysqli_error($con));
                   if(mysqli_num_rows($query)>0){
                    $first=true;
                    while($row=mysqli_fetch_array($query)){
                        printf("<li role='presentation' %s name='%s'><a href='#' onclick=\"get_groups('%s')\">%s</a></li>",($first)?'class=\'active\'':'',$row['id'],$row['id'],$row['title']);
                        $first=false;
                    }
                }else{

                }
                ?>
                <li role="presentation" name='addGroups' data-toggle="modal" data-target="#myModal"><a href="#"><span class="glyphicon glyphicon-plus-sign"></span>Создать группу</a></li>
            </ul>
        </div>
        <div class="col-9">
          <table class="table">
            <thead>
                <tr>
                    <th width="100%"></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tb_groups_table">
                <tr><td><div class="row">
                    <div class="col-2"><img src="img/person.png" height="32px" width="32px" alt="" class="img img-cirlce"></div>
                    <div class="col-10">UserName Surname</div>
                </div></td><td>
                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#"><img src="img/chat_message.png" width="18" height="18" alt="no_photo"> Отправить сообщение</a></li>
                    <li><a href="#"><img src="img/user_remove.png"  width="18" height="18" alt="no_photo"> Удалить из группы</a></li>
                    <li><a href="#"><img src="img/user.png" width="18" height="18" alt="no_photo"> Просмотреть профиль</a></li>
                </ul>
            </div></td>
        </tr>
    </tbody>
</table>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
<div class="footer">
    <span class="text-info left">© 2015 Gamers Team.</span>
    <span class="text-info right" style="float:right">
        Students of
        <a href="http://sdu.edu.kz">
            Suleyman
            Demirel University
        </a>
    </span>
</div>
</body>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/teacher_js.js"></script>
</html>
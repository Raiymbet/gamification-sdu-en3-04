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
<style>
    body {
        padding-top: 70px;
    }
</style>
<body>
<?php
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
            <div class="well">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-2">
                            <img class="img-circle" src="img/sc1.png" style="width:50px;height: 50px">
                        </div>
                        <div class="col-8">
                            <p>Время: 10:00</p>

                            <p>500 Очко</p>
                        </div>
                        <div class="col-1">
                            <a href="question.php" class="btn btn-danger">Play</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-2">
                            <img class="img-circle" src="img/sc1.png" style="width:50px;height: 50px">
                        </div>
                        <div class="col-8">
                            <p>Время: 10:00</p>

                            <p>500 Очко</p>
                        </div>
                        <div class="col-1">
                            <a href="question.php" class="btn btn-danger">Play</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-2">
                            <img class="img-circle" src="img/sc1.png" style="width:50px;height: 50px">
                        </div>
                        <div class="col-8">
                            <p>Время: 10:00</p>

                            <p>500 Очко</p>
                        </div>
                        <div class="col-1">
                            <a href="question.php" class="btn btn-danger">Play</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-2">
                            <img class="img-circle" src="img/sc1.png" style="width:50px;height: 50px">
                        </div>
                        <div class="col-8">
                            <p>Время: 10:00</p>

                            <p>500 Очко</p>
                        </div>
                        <div class="col-1">
                            <a href="question.php" class="btn btn-danger">Play</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-2">
                            <img class="img-circle" src="img/sc1.png" style="width:50px;height: 50px">
                        </div>
                        <div class="col-8">
                            <p>Время: 10:00</p>

                            <p>500 Очко</p>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-primary">
                                Result
                            </button>
                        </div>
                    </div>
                </div>
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
                                                <img src="img/sc1.png" alt="...">
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="nagrada">
                                                <img src="img/sc1.png" alt="...">
                                                <img src="img/sc1.png" alt="...">
                                                <img src="img/sc1.png" alt="...">
                                                <img src="img/sc1.png" alt="...">
                                                <img src="img/sc1.png" alt="...">
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="nagrada">
                                                <img src="img/sc1.png" alt="...">
                                                <img src="img/sc1.png" alt="...">
                                                <img src="img/sc1.png" alt="...">
                                                <img src="img/sc1.png" alt="...">
                                                <img src="img/sc1.png" alt="...">
                                            </div>
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
                            <h3><b>ТОП ЛУЧШИХ</b></h3>
                        </div>
                    </div>

                </div>
                <!-- Надо укоротить код -->
                <div class="panel-body">
                    <div class="raiting_item">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-1">
                                    <h2>1</h2>
                                </div>
                                <div class="col-1">
                                    <img src="img/person.png">
                                </div>
                                <div class="col-6">
                                    <h4>Username</h4>
                                    <h4>Group</h4>
                                </div>
                                <div class="col-2">
                                    <h4 class="gold_text">1234567</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-1">
                                    <h2>2</h2>
                                </div>
                                <div class="col-1">
                                    <img src="img/person.png">
                                </div>
                                <div class="col-6">
                                    <h4>Username</h4>
                                    <h4>Group</h4>
                                </div>
                                <div class="col-2">
                                    <h4 class="gold_text">1234567</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-1">
                                    <h2>3</h2>
                                </div>
                                <div class="col-1">
                                    <img src="img/person.png">
                                </div>
                                <div class="col-6">
                                    <h4>Username</h4>
                                    <h4>Group</h4>
                                </div>
                                <div class="col-2">
                                    <h4 class="gold_text">1234567</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-1">
                                    <h2>4</h2>
                                </div>
                                <div class="col-1">
                                    <img src="img/person.png">
                                </div>
                                <div class="col-6">
                                    <h4>Username</h4>
                                    <h4>Group</h4>
                                </div>
                                <div class="col-2">
                                    <h4 class="gold_text">1234567</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script src="../../project/js/jquery-1.10.2.js"></script>
        <script src="../../project/js/bootstrap.js"></script>
        <script type="text/javascript" src="../../project/js/flotr2.min.js"></script>
        <script type="text/javascript" src="js/student_js.js"></script>
</body>
</html>
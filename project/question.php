<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student page</title>
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
<div class="container">
    <div class="row">
        <div style="margin-top:50px"></div>
        <div class="col-7 col-offset-2">
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
    <!-- Каждый тип вопроса буду звать как type_1
        type_1 - > Обычный вопрос
        type_2 - > Вопрос с разбросанным ответом

     -->
    <div class="row" id="type_1">
        <div class="col-7 col-offset-2">
            <div class="panel panel-default">
                <div class="question" id="que" style="margin-bottom: 50px">
                    <!-- Здесь задается вопрос -->
                </div>
                <div class="row">
                    <p class="col-11 answers_item" id="ANS1" name="1" onclick="clickAnswer(this)">
                        Вариант А
                    </p>
                </div>
                <div class="row">
                    <p class="col-11 col-offset-1 answers_item" name="2" id="ANS2" onclick="clickAnswer(this)">
                        Вариант Б
                    </p>
                </div>
                <div class="row">
                    <p class="col-11 answers_item" name="3" id="ANS3" onclick="clickAnswer(this)">
                        Вариант В
                    </p>
                </div>
                <div class="row">
                    <p class="col-11 col-offset-1 answers_item" name="4" id="ANS4" onclick="clickAnswer(this)">
                        Вариант Г
                    </p>
                </div>
                <div style="margin-top:50px"></div>
            </div>
        </div>
    </div>
    <div class="row" id="type_2">
        <div class="col-7 col-offset-2">
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
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
    time = $("#time");
    time_limit = 900;
    correct_answer = 0;
    score = 0;
    current_question = 0;
    total_question = 10;
    question_id = 0;
    total_info = null;
    array_json = null;
    $("#ul_for_answer").sortable({
        placeholder: "ui-state-highlight"
    }).disableSelection();
    var Timer = setInterval(function () {
        var minuts, seconds;
        if (time_limit < 1) {
            //Stopping game;
            time.text("00:00");
            setTimeout(function () {
                window.open("finish.php?score=" + score, "_self");
            }, 1200);
            clearInterval(Timer);
        } else if (time_limit % 2 == 0) {
            minuts = Math.round(--time_limit / 60);
            seconds = time_limit % 60;
            time.text((minuts < 10 ? "0" + minuts : minuts) + ":" + (seconds < 10 ? "0" + seconds : seconds));
        } else if (time_limit % 2 == 1) {
            minuts = Math.round(--time_limit / 60);
            seconds = time_limit % 60;
            time.text((minuts < 10 ? "0" + minuts : minuts) + " " + (seconds < 10 ? "0" + seconds : seconds));
        }
        //Если время игры осталось меньше 10 секунд
        if (time_limit <= 10) {
            time.css({"color": "red"});
        }
    }, 1000);
    function clickAnswer(item) {
        var selected = item.getAttribute("name");
        var ans = $("#ANS" + selected + "").removeClass("answers_item");
        if (ans.text() == correct_answer) {
            ans.addClass("correct");
            score += array_json.level * 50;
            $(".gold_text[name=score]").text(score);
        } else {
            ans.addClass("incorrect");
        }
        setTimeout(function () {
            if (current_question < total_question) {
                cmp = total_info.question[current_question++];
                $(".gold_text[name=ques]").text(current_question + "/" + total_question);
                nextQuestion(cmp);
            } else {
                window.open("finish.php?score=" + score, "_self");
            }
        }, 1000);
        console.log(ans.text() + " : " + correct_answer);
    }
    function init() {
        $.ajax({
            type: "POST",
            url: "getQuestion.php",
            data: {id: 1, q: 'init'},
            cache: false,
            success: function (response) {
                time_limit = response.time_limit;
                total_question = response.count;
                total_info = response;
                console.log(total_info);
                if (total_question > 0) {
                    nextQuestion(response.question[current_question++]);
                    $(".gold_text[name=ques]").text(current_question + "/" + total_question);
                }
                response = null;
            }
        });
    }
    function nextQuestion(ID) {
        $.ajax({
            type: "POST",
            url: "getQuestion.php",
            data: {id: ID, q: 'question'},
            cache: false,
            success: function (response) {
                console.log(response.question);
                array_json = response;
                console.log(response.type);
                if (response.type == 1) {
                    for (var i = 0; i < response.variants.length; i++) {
                        $("#ANS" + (i + 1)).text(response.variants[i].answer)
                            .removeClass("correct")
                            .removeClass("incorrect")
                            .addClass("answers_item");
                        if (response.variants[i].correct == 1) {
                            correct_answer = response.variants[i].answer;
                        }
                    }
                    $("#type_1").fadeIn("fast");
                    $("#type_2").fadeOut("fast");
                    $("#que").text(response.question);
                } else {
                    type2_question(response.question, response.variants[0].answer);
                    $("#type_1").fadeOut("fast");
                    $("#type_2").fadeIn("fast");
                }
            }
        });
    }
    init();
    questions = "hello World";
    answers = "Kenguru";
    shuffle = "";
    var index_question_answer = 0;
    var random_array = [];
    function type2_question(question, answer) {
        questions = question;
        answers = answer;
        convert_question();
        set_random_int(answers.length, random_array);
        convert_answer();
    }
    function convert_question() {
        $("#p_for_question").text(questions);
    }
    function convert_answer() {
        for (var i = 0; i < answers.length; i++) {
            $("#ul_for_answer").append("<li class='btn btn-info'>" + answers[random_array[i]] + "</li>");
            shuffle += answers[random_array[i]];
        }
    }
    function set_random_int(length_of_answer, array) {
        array[0] = get_random();
        console.log(length_of_answer);
        for (var i = 1; i < length_of_answer; i++) {
            a = get_random();
            if (!dont_have(a, array)) {
                array.push(a);
            } else
                i--;
        }
        function get_random() {
            return Math.floor(Math.random() * length_of_answer);
        }
        function dont_have(a, array) {
            var have = false;
            for (var i = 0; i < array.length; i++) {
                if (a == array[i]) {
                    have = true;
                }
            }
            return have;
        }
    }

    $("#finish").click(function () {
        cmp = total_info.question[current_question++];
        $(".gold_text[name=ques]").text(current_question + "/" + total_question);
        if (shuffle == answers) {
            score += array_json.level * 50;
        }
        nextQuestion(cmp);
    });
</script>
</body>
</html>
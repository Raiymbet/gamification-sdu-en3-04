<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap-->
    <link href="../../project/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/font-awesome.css" rel="stylesheet">
    <style>
        .solid-border {
            border: solid 1px #0099CC;
        }

        .margin-top-5 {
            margin-top: 5px;
        }

        /* Button correct or incorrect style */
        .btn-correct-incorrect {
            width: 80%;
        }

        /* Question numbers list style */
        .question_number_btn_list {
            list-style: none;
        }

        .question_number_btn_list li {
            margin-top: 5px;
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: small;
            line-height: 1.428571429;
            border-radius: 500px;
            margin-left: -3em;
            background-color: #33B5E5;
            border: 1px solid #0099CC;
        }

        .question_number_btn_list .btn_list_active {
            background-color: #449d44;
            border: solid 1px #7fbbda;
        }

        .question_number_btn_list li span {
            color: #ffffff;
            cursor: default;
        }

        .question_number_btn_list .btn_have_question {
            background-color: orange;
            border: solid 1px #ffff00;
        }

        .question_number_btn_list .btn_have_question_list_active {
            background-color: #449d44;
            border: solid 1px #7fbbda;
        }

        /* switch on or off style */
        .switch {
            list-style: none;
            position: absolute;
        }

        .switch li {
            float: left;
            line-height: 23px;
            font-size: 11px;
            padding: 2px 10px 0;
            background: #E5E5E5;
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#F3F3F3), to(#E5E5E5));
            text-shadow: 0 1px 0 #FFF;
            border-left: 1px solid #D5D5D5;
            border-top: 1px solid #D5D5D5;
            border-bottom: 1px solid #D5D5D5;
            -webkit-box-shadow: 0 1px 0 #FFF inset, 0 0 5px rgba(0, 0, 0, .1) inset, 0 1px 1px rgba(0, 0, 0, .3);

        }

        .switch li:first-child {
            -webkit-border-radius: 5px 0 0 5px;
        }

        .switch li:last-child {
            -webkit-border-radius: 0 5px 5px 0;
        }

        .switch li span {
            text-decoration: none;
            text-transform: uppercase;
            color: #a1a1a1;
            cursor: default;
        }

        .switch .on {
            background: #505050;
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#777), to(#505050));
            text-shadow: 0 -1px 0 #444, 0 0 7px #9AE658;
            border-right: 1px solid #444;
            border-top: 1px solid #444;
            border-bottom: 1px solid #444;
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .7) inset, 0 1px 0 #FFF;
        }

        .switch li:not(.on):active {
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ddd), to(#f1f1f1));
        }

        .switch li.on span {
            color: #7BBA47;
            cursor: default;
        }
    </style>
</head>
<body>
<?php
include_once 'connect.php';
?>
<div class="container solid-border" style="margin-top: 50px;">
    <div class="container-fluid solid-border">
        <!-- Content tournament header-->
        <div class="solid-border col-12" style="">
            <!-- Name of tournament -->
            <div class="col-8" style="padding-right: 10px; padding-left: 10px">
                <div class="col-12">
                    <label class="col-2 control-label" for="name_tournament">Название: </label>
                    <div class="col-10">
                        <input class="form-control" id="name_tournament" type="text" style="width: 100%;"
                               placeholder="Enter tournament name">
                    </div>
                </div>
                <!-- Description of tournament -->
                <div class=" margin-top-5 col-12">
                    <label class="col-2 control-label" for="description_tournament">Описание: </label>
                    <div class="col-10" style="">
                    <textarea class="form-control margin-top-5" id="description_tournament"
                              style="width: 100%; height: 100px;"
                              placeholder="Enter tournament description"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-4" style="padding-right: 10px; padding-left: 10px">
                <div class="margin-top-5" style="width: 100%; height: 34px">
                    <div class="col-4">
                        <span class="control-label">Open date:</span>
                    </div>
                    <div class="col-8">
                        <input type="datetime-local" name="open_datetime" class="form-control">
                    </div>
                </div>

                <div class="margin-top-5" style="width: 100%; height: 34px;">
                    <div class="col-4">
                        <span class="control-label">Close date:</span>
                    </div>
                    <div class="col-8">
                        <input type="datetime-local" name="close_datetime" class="form-control">
                    </div>
                </div>

                <div class="margin-top-5" style="width: 100%; height: 34px;">
                    <div class="col-4">
                        <span class="control-label">Public:</span>
                    </div>
                    <div class="col-8">
                        <ul class="switch">
                            <li class="on"><span>OFF</span></li>
                            <li><span>ON</span></li>
                        </ul>
                    </div>
                </div>
                <div class="margin-top-5" id="teacher_groups">
                    <div class="col-4">
                        <span class="control-label">Groups:</span>
                    </div>
                    <div class="col-8">
                        <select class="form-control" id="select_groups">
                            <?php
                            $id_teacher = $_COOKIE['id_teacher'];
                            $teacher_groups = mysqli_query($con, "SELECT title as groups, id as id_groups FROM tb_groups WHERE teacher_id=1");
                            while($row_groups = mysqli_fetch_array($teacher_groups)){
                                echo '<option value="'.$row_groups['id_groups'].'">'. $row_groups['groups']. '</option>';
                            };
                            ?>
                        </select>
                    </div>

                </div>
            </div>

        </div>

        <!-- Content of question numbers -->
        <div class="left solid-border" style="float: left; width: 20%">
            <div style="padding: 5px;">
                <div style="float: left; margin-left: 15%">
                    <span style="text-align: left; font-size: 20px;">Question</span>
                </div>

                <div style="float: right;">
                    <button class="btn btn-primary fa fa-angle-left fa-1x" id="btn-question-back"></button>
                    <button class="btn btn-primary fa fa-angle-right fa-1x" id="btn-question-next"></button>
                </div>
            </div>

            <div style="float: inherit; width: 100%">
                <div class="center-block" style="width: 15%;" id="question_number_tab">
                    <ul class="question_number_btn_list" style="overflow: auto;height: 345px;width:70px;">
                        <li class="btn_list_active">
                            <span>1</span>
                        </li>
                        <li class="">
                            <span>2</span>
                        </li>
                        <li class="">
                            <span>3</span>
                        </li>
                        <li class="">
                            <span>4</span>
                        </li>
                        <li class="">
                            <span>5</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="bottom" style="float: left; width: 100%; background-color: #33B5E5;">
                <div class="center-block" style="width: 36%">
                    <button class="btn btn-primary fa fa-plus fa-1x" id="btn-question-plus" style=""></button>
                    <button class="btn btn-primary fa fa-minus fa-1x disabled" id="btn-question-minus"></button>
                </div>
            </div>
        </div>

        <!-- Content of question -->
        <div class="left solid-border" style="width: 55%; float: left; padding: 5px;">
            <div class="form-group col-12" style="padding: 0px;">
                <div class="col-6">
                    <select class="form-control" name="game_type" id="select_game_types">
                        <option value="Simple" selected>Simple</option>
                        <option value="True-false">True-false</option>
                        <option value="Input">Input</option>
                        <option value="Polechudes">Pole chudes</option>
                        <option value="Match">Match</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-12 margin-top-5" style="width: 100%; height: 10%">
                <button class="btn btn-default" style="width: 20%; float: right;">Video</button>
                <button class="btn btn-default" style="width: 20%; float: right; margin-right: 1%">Image</button>
            </div>

            <div id="content_game_type" style="height: 406px;">

            </div>
        </div>
        <!-- Content right-->
        <div class="solid-border" style="width: 25%;float: right;">
            <div style="width: 100%;">
                <div class="form-group">
                    <div class="col-12 margin-top-5">
                        <div class="col-3">
                            <span>Point:</span>
                        </div>
                        <div class="col-9">
                            <select class="form-control" name="time_limit">
                                <option selected>60</option>
                                <option>120</option>
                                <option>300</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 margin-top-5">
                        <div class="col-3">
                            <span>Time:</span>
                        </div>
                        <div class="col-9">
                            <select class="form-control margin-top-5" name="question_point">
                                <option selected>60</option>
                                <option>100</option>
                                <option>200</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 margin-top-5">
                        <div class="btn-group btn-group-justified margin-top-5" id="btn_level_group" role="group"
                             aria-label="...">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" name="btn_level">Easy</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default active" name="btn_level">Norm</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" name="btn_level">Hard</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="panel solid-border" style="width: 100%; float: left;">
            <button class="btn btn-success" style="float: right; width: 6%; margin-right: 25%" onclick="check_question_for_save()">
                Ok
            </button>
        </div>
        <div class="panel-footer" style="float: left; width: 100%">
            <button class="btn btn-primary " style="margin-right: 0%; float: right; width: 10%" onclick="cancel()">Cancel</button>
            <button class="btn btn-primary " style="margin-right: 1%; float: right; width: 10%"
                    onclick="save_tournament()">Save
            </button>
        </div>
    </div>
</div>
<!-- Modal messages -->
<div class="modal fade" id="message_modal" role="alert">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 400px; margin-left: 100px;">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                <h4>Уведомление.</h4>
            </div>
            <div class="modal-body">
                <p class="modal-body-text"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Назад</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../../project/js/jquery-1.10.2.js"></script>
<script src="../../project/js/bootstrap.js"></script>
<script>
    var content_simple_game =
        '<div class="col-12">' +
        '<textarea class="form-control" name="question_area" style="width: 100%; height: 100px; margin-top: 1%"placeholder="Please enter your question..."></textarea> ' +
        '</div>' +
        '<div class="form-group" id="content_answer_input" style="float: left;height: 180px; overflow-y: scroll">' +
        '<div class="col-9 margin-top-5">' +
        '<div class="col-12" style="padding: 0px"> ' +
        '<input class="form-control margin-top-5" name="answer" style="width: 100%;" type="text" placeholder="Answer 1">' +
        '</div>' +
        '<div class="col-12" style="padding: 0px">' +
        '<input class="form-control margin-top-5" name="answer" style="width: 100%" type="text" placeholder="Answer 2">' +
        '</div>' +
        '<div class="col-12" style="padding: 0px">' +
        '<input class="form-control margin-top-5" name="answer" style="width: 100%" type="text" placeholder="Answer 3">' +
        '</div>' +
        '<div class="col-12" style="padding: 0px">' +
        '<input class="form-control margin-top-5" name="answer" style="width: 100%" type="text" placeholder="Answer 4">' +
        '</div>' +
        '</div>' +
        '<div class="col-3 margin-top-5">' +
        '<ul class="col-12" style="padding: 0px" id="list-btn-correct-incorrect">' +
        '<li class="btn btn-danger pull-right btn-correct-incorrect margin-top-5" name="correct_incorrect">Incorrect</li>' +
        '<li class="btn btn-danger pull-right btn-correct-incorrect margin-top-5" name="correct_incorrect">Incorrect</li>' +
        '<li class="btn btn-danger pull-right btn-correct-incorrect margin-top-5" name="correct_incorrect">Incorrect</li>' +
        '<li class="btn btn-danger pull-right btn-correct-incorrect margin-top-5" name="correct_incorrect">Incorrect</li>' +
        '</ul>' +
        '</div>' +
        '</div>';
    var content_true_false_game =
        '<div class="col-12">' +
        '<textarea class="form-control" name="question_area" placeholder="Please enter your question..." style="width: 100%; height: 100px;"></textarea>' +
        '</div>' +
        '<div class="form-group col-12" id="content_answer_input" style="float: left; height: 180px; overflow-y: scroll">' +
        '<div class="col-5 margin-top-5" style="padding: 0px;">' +
        '<div class="col-12 margin-top-5" style="padding: 0px">' +
        '<input class="form-control" readonly style="width: 100%;" name="answer" type="text" value="True">' +
        '</div>' +
        '<div class="col-12 margin-top-5" style="padding: 0px">' +
        '<input class="form-control" style="width: 100%;" name="answer" readonly type="text" value="False">' +
        '</div>' +
        '</div>' +
        '<div class="col-3 col-offset-4 margin-top-5">' +
        '<ul class="col-12" style="padding: 0px" id="list-btn-correct-incorrect">' +
        '<li class="btn btn-danger pull-right btn-correct-incorrect margin-top-5" name="correct_incorrect">Incorrect</li>' +
        '<li class="btn btn-danger pull-right btn-correct-incorrect margin-top-5" name="correct_incorrect">Incorrect</li>' +
        '</ul>' +
        '</div>' +
        '</div>';
    var content_input_game =
        '<div class="col-12">' +
        '<textarea class="form-control" name="question_area" placeholder="Please enter your question..." style="width: 100%; height: 100px;"></textarea>' +
        '</div>' +
        '<div  class="col-12" style=" float: left; height: 180px; overflow-y: scroll">' +
        '<div class="" id="content_answer_input" style="">' +
        '<div class="col-12 margin-top-5" style="padding: 0px;" >' +
        '<input class="form-control" style="width: 100%;" name="answer" type="text" placeholder="Input 1">' +
        '</div>' +
        '</div>' +
        '<div class="col-12 margin-top-5" style="padding: 0px">' +
        '<button class="btn btn-primary fa fa-minus-circle" style="float: right;" name="input_answer_minus"></button>' +
        '<button class="btn btn-primary fa fa-plus-circle" style="float: right; margin-right: 5px" name="input_answer_plus"></button>' +
        '</div>'
    '</div>';
    var content_polechudes_game =
        '<div class="col-12">' +
        '<textarea class="form-control" name="question_area" placeholder="Please enter your question..." style="width: 100%; height: 100px;"></textarea>' +
        '</div>' +
        '<div class="form-group col-12" id="content_answer_input" style="float: left; height: 180px; overflow-y: scroll">' +
        '<div class="col-12 margin-top-5" style="padding: 0px;" >' +
        '<input class="form-control" style="width: 100%;" name="answer" type="text" placeholder="Input 1">' +
        '</div>';
    var content_match_game =
        '<div class="col-12">' +
        '<textarea class="form-control" name="question_area" placeholder="Please enter your question..." style="width: 100%; height: 100px;"></textarea>' +
        '</div>' +
        '<div class="col-12" style="float: left; height: 200px; overflow-y: scroll">' +
        '<div class="form-group" id="content_answer_input">' +
        '<div class="col-5 margin-top-5" style="padding: 0px;" >' +
        '<textarea class="form-control" style="width: 100%; height: 150px" name="answer"  placeholder="Match 1"></textarea>' +
        '</div>' +
        '<div class="col-5 col-offset-2 margin-top-5" style="padding: 0px;" >' +
        '<textarea class="form-control" style="width: 100%; height: 150px" name="answer" placeholder="Match answer 1"></textarea>' +
        '</div>' +
        '<div class="col-5 margin-top-5" style="padding: 0px;" >' +
        '<textarea class="form-control" style="width: 100%; height: 150px" name="answer"  placeholder="Match 2"></textarea>' +
        '</div>' +
        '<div class="col-5 col-offset-2 margin-top-5" style="padding: 0px;" >' +
        '<textarea class="form-control" style="width: 100%; height: 150px" name="answer" placeholder="Match answer 2"></textarea>' +
        '</div>' +
        '</div>' +
        '<div class="col-12 margin-top-5" style="padding: 0px">' +
        '<button class="btn btn-primary fa fa-minus-circle" style="float: right;" name="input_answer_minus"></button>' +
        '<button class="btn btn-primary fa fa-plus-circle" style="float: right; margin-right: 5px" name="input_answer_plus"></button>' +
        '</div>' +
        '</div>';
    var tournament_info = {
        "about_tournament": {
            "name": '',
            "description": '',
            "opened": '',
            "closed": '',
            "public": '',
            "status": '',
            "id_groups": '',
            "id_teacher": '',
            "current_date": ''
        },
        "questions": []
    }; //munda tournament informaciasy jane suraktarymen birge saktaidy
    /* tournament_info = {about_tournament{name, description, opened, closed, public},
     questions{game_type, limit_time, point, level, question, answers, corect_answer_id}}*/
    var question_li_size = 5; //bastapky mani bes bolatyn, jane artady birak 5 kem bolmaidy bul surak sanyn korsetedi
    var correct_answer_index = null; // bul kai jauap durys sol jauaptyn indexin korsetedi
    var active_li_index = 1;
    var all_questions_is_giving = false;

    $(document).ready(function () {
        //when change select game type change content
        $("#select_game_types").change(function () {
            //console.log($(this).val());
            var selected_item = $(this).val();
            if ($(this).val() == 'Simple') {
                $("#content_game_type").html(content_simple_game).load(answer_correct_incorrect());
            } else if ($(this).val() == 'True-false') {
                $("#content_game_type").html(content_true_false_game).load(answer_correct_incorrect());
            } else if ($(this).val() == 'Input') {
                $("#content_game_type").html(content_input_game).load(input_answer_plus(), input_answer_minus());
            } else if ($(this).val() == 'Polechudes') {
                $("#content_game_type").html(content_polechudes_game);
            } else if ($(this).val() == 'Match') {
                $("#content_game_type").html(content_match_game).load(input_answer_minus(), input_answer_plus());
            }
        }).change();

        //Change state of switch on or off
        $("ul.switch li").click(function () {
            $("ul.switch li").removeClass("on");
            $(this).addClass("on");
        });
        //change question level
        $(".btn[name='btn_level']").click(function () {
            $(".btn[name='btn_level']").removeClass("active");
            $(this).addClass("active");
        });
        //Change active question number list
        //btn_list_active_change();
        $("#btn-question-next").click(function () {
            question_next();
        });
        $("#btn-question-back").click(function () {
            question_previous();
        });
        //add new question
        $("#btn-question-plus").click(function () {
            question_plus();
        });
        //delete end question
        $("#btn-question-minus").click(function () {
            question_minus();
        });
    });

    function question_next() {
        if (tournament_info.questions.length < active_li_index) {
            $("#message_modal").modal('show');
            $("#message_modal .modal-body-text").html("").append("<p class='text-warning'>Сперва заполните этот вопрос!</p>");
        } else {
            $(".question_number_btn_list li").each(function () {
                if ($(this).hasClass("btn_list_active")) {
                    active_li_index = $(this).index();
                    $(this).removeClass("btn_list_active");
                } else if ($(this).hasClass("btn_have_question_list_active")) {
                    active_li_index = $(this).index();
                    $(this).removeClass("btn_have_question_list_active").addClass("btn_have_question");
                }
            });

            if (question_li_size > active_li_index) {
                if (active_li_index != question_li_size - 1) {
                    active_li_index += 2;
                } else {
                    active_li_index += 1;
                }
            }

            if ($(".question_number_btn_list > li:nth-child(" + active_li_index + ")").hasClass("btn_have_question")) {
                $(".question_number_btn_list > li:nth-child(" + active_li_index + ")").removeClass("btn_have_question").addClass("btn_have_question_list_active");

                $("#select_game_types option").removeAttr("selected");
                $("#select_game_types option[value='"+tournament_info.questions[active_li_index - 1].game_type+"']").attr("selected",'selected').change();

                if (tournament_info.questions[active_li_index - 1].game_type == 'Simple' ||
                    tournament_info.questions[active_li_index - 1].game_type == 'True-false') {
                    $("#content_game_type textarea[name='question_area']").text("" + tournament_info.questions[active_li_index - 1].question);
                    $("#content_answer_input input[name='answer']").each(function (index) {
                        $(this).val("" + tournament_info.questions[active_li_index - 1].answers[index]);
                    });
                    $("#list-btn-correct-incorrect li[name='correct_incorrect']").each(function (index) {
                        if (index == tournament_info.questions[active_li_index - 1].correct_answer_id) {
                            $(this).removeClass("btn-danger").addClass("btn-success").text("Correct");
                            correct_answer_index = tournament_info.questions[active_li_index - 1].correct_answer_id;
                        }
                    });
                }else if(tournament_info.questions[active_li_index - 1].game_type == 'Input' ||
                         tournament_info.questions[active_li_index - 1].game_type == 'Polechudes'){
                    $("#content_game_type textarea[name='question_area']").text("" + tournament_info.questions[active_li_index - 1].question);
                    if(tournament_info.questions[active_li_index - 1].game_type == 'Input' && tournament_info.questions[active_li_index-1].answers.length>1){
                        for(var i=1; i<tournament_info.questions[active_li_index-1].answers.length; i++){
                            answer_plus();
                        }
                    }
                    $("#content_answer_input input[name='answer']").each(function (index) {
                        $(this).val("" + tournament_info.questions[active_li_index - 1].answers[index]);
                    });
                }else if(tournament_info.questions[active_li_index - 1].game_type == 'Match'){

                }
            }else {
                $("#select_game_types option").removeAttr("selected");
                $("#select_game_types option[value='Simple']").attr("selected",'selected').change();
                $(".question_number_btn_list > li:nth-child(" + active_li_index + ")").addClass("btn_list_active");
                correct_answer_index = null;
            }
            //console.log("Next question: "+active_index);
        }
    }

    function question_previous() {
        $(".question_number_btn_list li").each(function () {
            if ($(this).hasClass("btn_list_active")) {
                active_li_index = $(this).index();
                $(this).removeClass("btn_list_active");
            } else if ($(this).hasClass("btn_have_question_list_active")) {
                active_li_index = $(this).index();
                $(this).removeClass("btn_have_question_list_active").addClass("btn_have_question");
            }
        });
        if (active_li_index <= 0) {
            active_li_index = 1;
        }
        if ($(".question_number_btn_list > li:nth-child(" + active_li_index + ")").hasClass("btn_have_question")) {
            $(".question_number_btn_list > li:nth-child(" + active_li_index + ")").removeClass("btn_have_question").addClass("btn_have_question_list_active");

            $("#select_game_types option").removeAttr("selected");
            $("#select_game_types option[value='"+tournament_info.questions[active_li_index - 1].game_type+"']").attr("selected",'selected').change();

            if (tournament_info.questions[active_li_index - 1].game_type == 'Simple' ||
                tournament_info.questions[active_li_index - 1].game_type == 'True-false') {
                $("#content_game_type textarea[name='question_area']").text("" + tournament_info.questions[active_li_index - 1].question);
                $("#content_answer_input input[name='answer']").each(function (index) {
                    $(this).val("" + tournament_info.questions[active_li_index - 1].answers[index]);
                });
                $("#list-btn-correct-incorrect li[name='correct_incorrect']").each(function (index) {
                    if (index == tournament_info.questions[active_li_index - 1].correct_answer_id) {
                        $(this).removeClass("btn-danger").addClass("btn-success").text("Correct");
                        correct_answer_index = tournament_info.questions[active_li_index - 1].correct_answer_id;
                    }
                });
            }else if(tournament_info.questions[active_li_index - 1].game_type == 'Input' ||
                     tournament_info.questions[active_li_index - 1].game_type == 'Polechudes'){
                $("#content_game_type textarea[name='question_area']").text("" + tournament_info.questions[active_li_index - 1].question);
                if(tournament_info.questions[active_li_index - 1].game_type == 'Input' && tournament_info.questions[active_li_index-1].answers.length>1){
                    for(var i=1; i<tournament_info.questions[active_li_index-1].answers.length; i++){
                        answer_plus();
                    }
                }
                $("#content_answer_input input[name='answer']").each(function (index) {
                    $(this).val("" + tournament_info.questions[active_li_index - 1].answers[index]);
                });
            }
        }
        //console.log("Previous question: "+active_index);
    }

    function cancel() {
        location.href = 'teacher.php';
    }

    function question_plus() {
        question_li_size++;
        if (question_li_size > 5) {
            $("#btn-question-minus").removeClass("disabled");
        }
        $(".question_number_btn_list").append('<li class=""><span>' + question_li_size + '</span></li>');
    }

    function question_minus() {
        question_li_size--;
        if ($(".question_number_btn_list").children().last().hasClass("btn_list_active")) {
            $(".question_number_btn_list").children().last().remove();
            if ($(".question_number_btn_list li:last-child").hasClass("btn_have_question")) {
                $(".question_number_btn_list li:last-child").removeClass("btn_have_question").addClass("btn_have_question_list_active");
            }
        } else {
            $(".question_number_btn_list").children().last().remove();
        }
        if (question_li_size == 5) {
            $("#btn-question-minus").addClass("disabled");
        }
    }

    /*function btn_list_active_change() {
     $("ul.question_number_btn_list li").click(function () {
     //console.log($(this).index() + " " + tournament_info.questions.length);
     if (tournament_info.questions.length >= $(this).index()) {
     $("ul.question_number_btn_list li").removeClass("btn_list_active");
     $(this).addClass("btn_list_active");
     } else {
     //console.log("Zapolnite predydushie voprosy");
     $("#message_modal").modal('show');
     $("#message_modal .modal-body-text").html("").append("<p class='text-warning'>Сперва заполните этот вопрос!</p>");
     }
     //console.log($(this).children().text());
     });
     }*/
    function input_answer_plus() {
        $(".btn[name='input_answer_plus']").click(function () {
            answer_plus();
        });
    }
    function answer_plus(){
        if ($("#select_game_types").val() == 'Input') {
            $("#content_answer_input").append('<div class="col-12 margin-top-5" style="padding: 0px;" ><input class="form-control" style="width: 100%;" name="answer" type="text" placeholder="Input 1"></div>');
        } else if ($("#select_game_types").val() == 'Match') {
            var matches = '<div class="col-5 margin-top-5" style="padding: 0px;" >' +
                '<textarea class="form-control" style="width: 100%; height: 150px" name="answer"  placeholder="Match"></textarea>' +
                '</div>' +
                '<div class="col-5 col-offset-2 margin-top-5" style="padding: 0px;" >' +
                '<textarea class="form-control" style="width: 100%; height: 150px" name="answer" placeholder="Match answer"></textarea>' +
                '</div>';
            $("#content_answer_input").append(matches);
        }
    }
    function input_answer_minus() {
        $(".btn[name='input_answer_minus']").click(function () {
            if ($("#select_game_types").val() == 'Input') {
                $("#content_answer_input").children().last().remove();
            } else if ($("#select_game_types").val() == 'Match') {
                $("#content_answer_input").children().last().remove();
                $("#content_answer_input").children().last().remove();
            }
        });
    }

    function answer_correct_incorrect() {
        $(".btn[name='correct_incorrect']").click(function () {
            if ($(this).text()=='Correct') {
                $(this).removeClass("btn-success").addClass("btn-danger").text("Incorrect");
                correct_answer_index = null;
            } else if ($(this).text()=='Incorrect') {
                $("#content_game_type .btn-success").removeClass("btn-success").addClass("btn-danger").text("Incorrect");
                $(this).removeClass("btn-danger").addClass("btn-success").text("Correct");
                correct_answer_index = $(this).index();
            }
        });
    }
    //Проверка и заполнение json object содержащий всю инфу о туре
    function check_about_tournament() {
        var name_tournament = $("#name_tournament").val(),
            description_tournament = $("#description_tournament").val(),
            open_datetime = $("input[name='open_datetime']").val(),
            close_datetime = $("input[name='close_datetime']").val(),
            public_status = '0',
            status = 'yes',
            id_group = $("#select_groups").val(),
            id_teacher = <?php echo $id_teacher?>;
        var valid = false;
        var errors = [];

        var fullDate = new Date();
        var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
        var currentDate = fullDate.getFullYear()+"-"+twoDigitMonth + "-"+fullDate.getDate()+" "+fullDate.getHours()+":"+fullDate.getMinutes()+":"+fullDate.getSeconds();
        //console.log(currentDate);
        if($(".switch .on").text()=='ON'){
            public_status = '1';
        }else{
            public_status = '0';
        }
        if(currentDate < open_datetime){
            status = 'no';
        }
        if (name_tournament == "") {
            errors[errors.length] = "Пожлуйста, заполните поле имя тура.";
        }
        if (description_tournament == "") {
            errors[errors.length] = "Пожлуйста, заполните поле описания тура.";
        }
        if (open_datetime == "") {
            errors[errors.length] = "Пожлуйста, выберите день открытия тура.";
        }
        if (close_datetime == "") {
            errors[errors.length] = "Пожлуйста, выберите день закрытия тура."
        }
        if(open_datetime>=close_datetime){
            errors[errors.length]="Неправильно дата";
        }
        if (errors.length == 0) {
            valid = true;
        }

        if (valid) {
            tournament_info.about_tournament.name = name_tournament;
            tournament_info.about_tournament.description = description_tournament;
            tournament_info.about_tournament.opened = open_datetime;
            tournament_info.about_tournament.closed = close_datetime;
            tournament_info.about_tournament.public = public_status;
            tournament_info.about_tournament.status = status;
            tournament_info.about_tournament.id_groups = id_group;
            tournament_info.about_tournament.id_teacher = id_teacher;
            tournament_info.about_tournament.current_date = currentDate;
            return valid;
        } else {
            //console.log(errors);
            return errors;
        }
    }

    //Проверяет все данные касающиеся вопросы.
    function check_question_for_save() {
        var game_type = $("select[name='game_type']").val(),
            time_limit = $("select[name='time_limit']").val(),
            question_point = $("select[name='question_point']").val(),
            question_level = $("#btn_level_group button.active").text(),

            question = "",
            answers = [],
            errors = [], valid = false;

        question = $("textarea[name='question_area']").val();
        $("#content_answer_input input[name='answer']").each(function (index) {
            answers[index] = $(this).val();
        });
        if (question == "") {
            errors[errors.length] = "Пожалуйста, заполните поле вопрос.";
        }
        for (var i = 0; i < answers.length; i++) {
            if (answers[i] == "") {
                errors[errors.length] = "Пожалуйста, заполните поле ответы и не оставляте пустым";
                break;
            }
        }
        if(game_type=='Simple' || game_type=='True-false'){
            if (correct_answer_index == null) {
                errors[errors.length] = "Выберите один правильный ответ";
            }
        }
        if (errors.length == 0) {
            valid = true;
        }
        if (valid) {
            tournament_info.questions[active_li_index - 1] = '';
            if (game_type == 'Simple') {
                tournament_info.questions[active_li_index - 1] = {
                    "game_type": 1,
                    "time_limit": time_limit,
                    "point": question_point,
                    "level": question_level,
                    "question": question,
                    "answers": answers,
                    "correct_answer_id": correct_answer_index
                };
            }else if (game_type == 'True-false') {
                tournament_info.questions[active_li_index - 1] = {
                    "game_type": 2,
                    "time_limit": time_limit,
                    "point": question_point,
                    "level": question_level,
                    "question": question,
                    "answers": answers,
                    "correct_answer_id": correct_answer_index
                };
            }else if (game_type == 'Input') {
                tournament_info.questions[active_li_index - 1] = {
                    "game_type": 3,
                    "time_limit": time_limit,
                    "point": question_point,
                    "level": question_level,
                    "question": question,
                    "answers": answers,
                    "correct": 1
                };

            } else if (game_type == 'Polechudes') {
                tournament_info.questions[active_li_index - 1] = {
                    "game_type": 4,
                    "time_limit": time_limit,
                    "point": question_point,
                    "level": question_level,
                    "question": question,
                    "answers": answers,
                    "correct": 1
                };
            } else if (game_type == 'Match') {
                tournament_info.questions[active_li_index - 1] = {
                    "game_type": 5,
                    "time_limit": time_limit,
                    "point": question_point,
                    "level": question_level,
                    "question": question,
                    "answers": answers,
                    "correct": 1
                };
            }
            console.log(tournament_info);
        } else {
            $("#message_modal").modal('show');
            $("#message_modal .modal-body-text").html("");
            $.each(errors, function (index, value) {
                $("#message_modal .modal-body-text").append("<p class='text-danger'>" + value + "</p>");
            });
        }
        if (question_li_size == active_li_index) {
            $("#message_modal").modal('show');
            $("#message_modal .modal-body-text").html("").append("<p class='text-success'>Все вопросы были заданы</p>");
            all_questions_is_giving = true;
            $(".question_number_btn_list > li:nth-child(" + active_li_index + ")").removeClass("btn_list_active").addClass("btn_have_question_list_active");
        } else if(valid){
            $(".question_number_btn_list > li:nth-child(" + active_li_index + ")").addClass("btn_have_question");
            question_next();
            correct_answer_index = null;
        }
    }

    function save_tournament() {
        //Проверяет все данные касающиеся туру и его вопросы. Вопросы должны быть минимум пять. Если все правильно сохроняет на базу данных и напрвляет на страницу учителя
        var valid = check_about_tournament();
        if (valid == true && all_questions_is_giving) {
            console.log(tournament_info);
            var json = JSON.stringify(tournament_info);
            console.log(json);
            $.ajax({
                type: "POST",
                url: "save_tournament.php",
                data: {dannie: json},
                beforeSend: function () {
                    $("#message_modal").modal('show');
                    $(".modal-body-text").html("").append("<img src='img/loading.gif' name='load'>")
                },
                success: function (response) {
                    $(".modal-body-text").html("").append(response);
                    setTimeout(function(){
                        location.href = 'teacher.php';
                    }, 2000);
                }
            });
        } else {
            $("#message_modal").modal('show');
            $("#message_modal .modal-body-text").html("");
            $.each(valid, function (index, value) {
                $("#message_modal .modal-body-text").append("<p class='text-danger'>" + value + "</p>");
            });
        }
    }

    function edit_tournament(){

    }
</script>
</html>
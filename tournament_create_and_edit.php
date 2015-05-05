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
            background-color: #33B5E5;
            margin-top: 5px;
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: small;
            line-height: 1.428571429;
            border-radius: 500px;
            margin-left: -3em;
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
<div class="container solid-border" style="margin-top: 50px;">
    <div class="container-fluid solid-border">
        <!-- Content tournament header-->
        <div class="solid-border col-12" style="">
            <!-- Name of tournament -->
            <div class="col-8" style="padding-right: 10px; padding-left: 10px">
                <div class="form-group col-12">
                    <label class="col-2 control-label" for="name_tournament">Название: </label>

                    <div class="col-10">
                        <input class="form-control" id="name_tournament" type="text" style="width: 100%;"
                               placeholder="Enter tournament name">
                    </div>
                </div>
                <!-- Description of tournament -->
                <div class="form-group col-12">
                    <label class="col-2 control-label" for="description_tournament">Описание: </label>

                    <div class="col-10" style="">
                    <textarea class="form-control margin-top-5" id="description_tournament"
                              style="width: 100%; height: 100px;"
                              placeholder="Enter tournament description"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-4" style="padding-right: 10px; padding-left: 10px">
                <div class="form-group" style="width: 100%; height: 34px">
                    <div class="col-4">
                        <span class="control-label">Open date:</span>
                    </div>
                    <div class="col-8">
                        <input type="datetime-local" name="open_datetime" class="form-control">
                    </div>
                </div>

                <div class="form-group" style="width: 100%; height: 34px;">
                    <div class="col-4">
                        <span class="control-label">Close date:</span>
                    </div>
                    <div class="col-8">
                        <input type="datetime-local" name="close_datetime" class="form-control">
                    </div>
                </div>

                <div class="form-group" style="width: 100%; height: 34px;">
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
                <div class="center-block" style="width: 15%" id="question_number_tab">
                    <ul class="question_number_btn_list">
                        <li class="btn_list_active">
                            <span>1</span>
                        </li>
                        <li>
                            <span>2</span>
                        </li>
                        <li>
                            <span>3</span>
                        </li>
                        <li>
                            <span>4</span>
                        </li>
                        <li>
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
                        <option selected>Simple</option>
                        <option>True-false</option>
                        <option>Input</option>
                        <option>Pole chudes</option>
                        <option>Match</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-12 margin-top-5" style="width: 100%; height: 10%">
                <button class="btn btn-default" style="width: 20%; float: right;">Video</button>
                <button class="btn btn-default" style="width: 20%; float: right; margin-right: 1%">Image</button>
            </div>

            <div id="content_game_type">

            </div>
        </div>
        <!-- Content right-->
        <div class="solid-border" style="width: 25%;float: right; padding: 5px">
            <div style="width: 100%; height: 10%;">
                <div class="form-group">
                    <select class="form-control" name="time_limit">
                        <option selected disabled>Limit time in second</option>
                        <option>60</option>
                        <option>120</option>
                        <option>300</option>
                    </select>
                    <select class="form-control margin-top-5" name="question_point">
                        <option selected disabled>Point question</option>
                        <option>60</option>
                        <option>100</option>
                        <option>200</option>
                    </select>

                    <div class="btn-group btn-group-justified margin-top-5" role="group" aria-label="...">
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
        <div class="panel-footer" style="float: left; width: 100%">
            <button class="btn btn-primary " style="margin-right: 0%; float: right; width: 10%">Cancel</button>
            <button class="btn btn-primary " style="margin-right: 1%; float: right; width: 10%" onclick="save()">Save
            </button>
        </div>
    </div>
</div>
</body>
<script src="../../project/js/jquery-1.10.2.js"></script>
<script src="../../project/js/bootstrap.js"></script>
<script>
    var content_simple_game =
        '<div class="col-12">' +
        '<textarea class="form-control"style="width: 100%; height: 100px; margin-top: 1%"placeholder="Please enter your question..."></textarea> ' +
        '</div>' +
        '<div class="form-group" id="content_answer_input" style="float: left" id="simple_game">' +
        '<div class="col-12 margin-top-5"> ' +
        '<div class="col-9" style="padding: 0px"> ' +
        '<input class="form-control" style="width: 100%" type="text" placeholder="Answer 1">' +
        '</div>' +
        '<div class="col-3" style="padding: 0px">' +
        '<button class="btn btn-danger pull-right btn-correct-incorrect" name="correct_incorrect">Incorrect</button>' +
        '</div>' +
        '</div>' +
        '<div class="col-12 margin-top-5">' +
        '<div class="col-9" style="padding: 0px">' +
        '<input class="form-control" style="width: 100%" type="text" placeholder="Answer 2">' +
        '</div>' +
        '<div class="col-3" style="padding: 0px">' +
        '<button class="btn btn-danger pull-right btn-correct-incorrect" name="correct_incorrect">Incorrect</button>' +
        '</div>' +
        '</div>' +
        '<div class="col-12 margin-top-5">' +
        '<div class="col-9" style="padding: 0px">' +
        '<input class="form-control" style="width: 100%" type="text" placeholder="Answer 3">' +
        '</div>' +
        '<div class="col-3" style="padding: 0px">' +
        '<button class="btn btn-danger pull-right btn-correct-incorrect" name="correct_incorrect">Incorrect</button>' +
        '</div>' +
        '</div>' +
        '<div class="col-12 margin-top-5">' +
        '<div class="col-9" style="padding: 0px">' +
        '<input class="form-control" style="width: 100%" type="text" placeholder="Answer 4">' +
        '</div>' +
        '<div class="col-3" style="padding: 0px">' +
        '<button class="btn btn-danger pull-right btn-correct-incorrect" name="correct_incorrect">Incorrect</button>' +
        '</div>' +
        '</div>' +
        '</div>';
    var content_true_false_game = '<div class="col-12" ><textarea class="form-control" placeholder="Please enter your question..."' +
        'style="width: 100%; height: 100px;"></textarea></div>' +
        '<div class="form-group col-12" id="content_answer_input" style="float: left" id="simple_game">' +
        '<div class="col-12 margin-top-5" style="padding: 0px;"><div class="col-3" style="padding: 0px">' +
        '<input class="form-control" readonly style="width: 100%;" type="text" value="True"></div><div class="col-2" style="padding: 0px">' +
        '<button class="btn btn-danger pull-right btn-correct-incorrect" name="correct_incorrect">Incorrect</button></div><div class="col-3 col-offset-2" style="padding: 0px">' +
        '<input class="form-control" style="width: 100%;" readonly type="text" value="False"></div><div class="col-2" style="padding: 0px">' +
        '<button class="btn btn-danger pull-right btn-correct-incorrect" name="correct_incorrect">Incorrect</button></div></div></div>';
    var content_input_game = '';
    var content_polechudes_game = '';
    var content_match_game = '';
    $(document).ready(function () {
        //when change select game type change content
        $("#select_game_types").change(function () {
            //console.log($(this).val());
            if ($(this).val() == 'Simple') {
                $("#content_game_type").html(content_simple_game);
                answer_correct_incorrect();
            } else if ($(this).val() == 'True-false') {
                $("#content_game_type").html(content_true_false_game).load(answer_correct_incorrect());
            } else if ($(this).val() == 'Input') {
                $("#content_game_type").html(content_input_game).load(answer_correct_incorrect());
            } else if ($(this).val() == 'Pole chudes') {
                $("#content_game_type").html(content_polechudes_game).load(answer_correct_incorrect());
            } else if ($(this).val() == 'Match') {
                $("#content_game_type").html(content_match_game).load(answer_correct_incorrect());
            }
        }).change();

        //Change state of switch on or off
        $("ul.switch li").click(function () {
            $("ul.switch li").removeClass("on");
            $(this).addClass("on");
        });
        $(".btn[name='btn_level']").click(function () {
            $(".btn[name='btn_level']").removeClass("active");
            $(this).addClass("active");
        });
        //Change active question number list
        btn_list_active_change();
        question_next();
        question_previous();
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
        $("#btn-question-next").click(function () {
            var active_li_index = $("ul.question_number_btn_list li").index('.btn_list_active');
            $("ul.question_number_btn_list li").removeClass("btn_list_active");
            active_li_index = active_li_index + 1;
            $("ul.question_number_btn_list li:nth-child(" + active_li_index + ")").addClass("btn_list_active");
            console.log(active_li_index);
        });
    }
    function question_previous() {
        $("#btn-question-back").click(function () {

        });
    }
    function cancel() {

    }
    function save() {
        check_about_tournament();
        check_question_for_save();
    }

    var new_li_index = 5;
    function question_plus() {
        new_li_index++;
        if (new_li_index > 5) {
            $("#btn-question-minus").removeClass("disabled");
        }
        $(".question_number_btn_list").append('<li class=""><span>' + new_li_index + '</span></li>').load(btn_list_active_change());
    }
    function question_minus() {
        new_li_index--;
        $(".question_number_btn_list").children().last().remove();
        if (new_li_index == 5) {
            $("#btn-question-minus").addClass("disabled");
        }
    }
    function btn_list_active_change() {
        $("ul.question_number_btn_list li").click(function () {
            $("ul.question_number_btn_list li").removeClass("btn_list_active");
            $(this).addClass("btn_list_active");
            console.log($(this).children().text());
        });
    }
    function answer_correct_incorrect() {
        $(".btn[name='correct_incorrect']").click(function () {
            if ($(this).hasClass("btn-success")) {
                $(this).removeClass("btn-success").addClass("btn-danger").text("Incorrect");
            } else if ($(this).hasClass("btn-danger")) {
                $("#content_game_type .btn-success").removeClass("btn-success").addClass("btn-danger").text("Incorrect");
                $(this).removeClass("btn-danger").addClass("btn-success").text("Correct");
            }
            console.log("Btn click");
        });
    }
    //Создание json object содержащий всю инфу о туре и его вопросы
    var tournament_info = {};
    function check_about_tournament() {
        var name_tournament = $("#name_tournament").val(),
            description_tournament = $("#description_tournament").val(),
            open_datetime = $("input[name='open_datetime']").val(),
            close_datetime = $("input[name='close_datetime']").val(),
            public_status = $(".switch .on").text();
        var valid = false;
        var errors = [];
        if (name_tournament == "") {
            errors[errors.length] = "Invalid name";
        }
        if (description_tournament == "") {
            errors[errors.length] = "Invalid description";
        }
        if (open_datetime == "") {
            errors[errors.length] = "Invalid open date time";
        }
        if (close_datetime == "") {
            errors[errors.length] = "Invalid close date time"
        }
        if (errors.length == 0) {
            tournament_info = {
                "about_tournament": {
                    "name": name_tournament,
                    "description": description_tournament,
                    "opened": open_datetime,
                    "closed": close_datetime,
                    "public": public_status
                }
            };
            valid = true;
        }

        if (valid) {
            console.log(tournament_info);
        } else {
            console.log(errors);
        }
    }

    function check_question_for_save() {
        var game_type = $("select[name='game_type']").val(),
            time_limit = $("select[name='time_limit']").val(),
            question_point = $("select[name='question_point']").val(),
            question_level = $(".btn[name='btn_level'] .active").val();

        if (game_type == 'Simple') {

        } else if (game_type == 'True-false') {

        } else if (game_type == 'Input') {

        } else if (game_type == 'Pole chudes') {

        } else if (game_type == 'Match') {

        }
    }
</script>
</html>
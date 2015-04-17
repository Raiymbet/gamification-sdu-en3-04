time = $("#time");
/*Проблемы:
 1. Надо научить не принимать нажатие после принятие ответа
 1.1.Поставить заслонку
 1.2.Заблокировать кнопки
 1.3. Не принимать нажатие <-- Этот путь быль верным
 Done!
 Time:17:31
 Запись:17:32
 Student Question page. Исправный.
 Проблема:
 1.Game Match
 1.1.Надо начать интеграцию с простым переходом в div
 1.2.Проверить на нажатие кнопок
 1.3.Интегрировать с js кодом
 2.Game Input
 */

lock_button = false;
time_limit = 900;
currentTimeLimit = 0;
correct_answer = 0;
score = 0;
current_question = 0;
ctCorrAnswers = 0;
total_question = 10;
question_id = 0;
total_info = null;
array_json = null;
questions = "hello World";
answers = "Kenguru";
shuffle = "";
var index_question_answer = 0;
var random_array = [];
var percent = 0.0, a3 = [];
var previous_time = percent;
$('#circle').circleProgress({value: 0, size: 50, lineCap: 'round', fill: {gradient: ['blue']}});
function finishResult() {
    if (current_question >= total_question) {
        $.ajax({
            type: "POST",
            url: 'calculateResult.php',
            data: {
                command: 'cResult',
                id_student: id_student,
                id_tournament: id_tournament,
                time_end: time_limit,
                count_correct_answers: correct_answer,
                correct_answers: ctCorrAnswers,
                score: score
            },
            cache: false,
            success: function (response) {
                if (response == "<span>Record already have</span>") {
                    window.open("error.php?message=" +response, "_self");
                } else {
                    window.open("finish.php?id_result=" + response.OK, "_self");
                }
            }
        });
    }
}
function init() {
    $.ajax({
        type: "POST",
        url: "getQuestion.php",
        data: {id: id_tournament, q: 'init'},
        cache: false,
        success: function (response) {
            currentTimeLimit = time_limit = response.time_limit;
            total_question = response.count;
            total_info = response;
            console.log(total_info);
            if (total_question > 0) {
                nextQuestion(response.question[current_question++]);
            } else {
                window.open("error.php", "_self");
            }
            var Timer = setInterval(function () {
                if (time_limit <= 0) {
                    setTimeout(function () {
                        finishResult();
                    }, 1200);
                    clearInterval(Timer);
                }
                else {
                    percent = (((currentTimeLimit - time_limit--) / currentTimeLimit));
                    $('#circle').circleProgress({
                        animationStartValue: previous_time,
                        value: percent,
                        size: 50, lineCap: 'round',
                        fill: {
                            gradient: [(time_limit < 10) ? 'red' : 'blue']
                        }
                    });
                }
                previous_time = percent;
            }, 1000);
        }
    });
}
function nextQuestion(ID) {
    $(".gold_text[name=ques]").text(current_question + "/" + total_question);
    $.ajax({
        type: "POST",
        url: "getQuestion.php",
        data: {id: ID, q: 'question'},
        cache: false,
        success: function (response) {
            console.log(response.question);
            array_json = response;
            if (response.type == 1) {
                for (var percent = 0; percent < response.variants.length; percent++) {
                    $("#ANS" + (percent + 1)).text(response.variants[percent].answer)
                        .removeClass("correct")
                        .removeClass("incorrect")
                        .addClass("answers_item");
                    lock_button = false;
                    if (response.variants[percent].correct == 1) {
                        correct_answer = response.variants[percent].answer;
                    }
                }
                $("#type_1").fadeIn("fast");
                $(".answers_item").each(function () {
                    console.log($(this));
                    $(this).click(function () {
                        if (lock_button)return;
                        lock_button = true;
                        var ans = $(this).removeClass("answers_item");
                        if (ans.text() == correct_answer) {
                            ans.addClass("correct");
                            score += array_json.level * 50;
                            correct_answer++;

                            ctCorrAnswers++;
                            $(".gold_text[name=score]").text(score);
                        } else {
                            ans.addClass("incorrect");
                        }
                        setTimeout(function () {
                            if (current_question < total_question) {
                                cmp = total_info.question[current_question++];
                                nextQuestion(cmp);
                            } else {
                                finishResult();
                            }
                        }, 1000);

                        console.log(ans.text() + " : " + correct_answer);
                    });
                });
                $("#type_2").fadeOut("fast");
                $("#que").text(response.question);
            } else if (response.type == 2) {
                type2_question(response.question, response.variants[0].answer);
                $("#type_1").fadeOut("fast");
                $("#type_2").fadeIn("fast");
            } else if (response.type == 3) {
                $("#type_1").fadeOut("fast");
                $("#type_2").fadeOut("fast");
                $("#type_3").fadeIn("fast");
                var a3 = [], q3 = response.question;
                for (var i = 0; i < response.variants.length; i++) {
                    a3[i] = response.variants[i].answer;
                    console.log("Type_3///Ответ:" + a3[i]);
                }
                type_3_method_question(a3, q3);
            }
        }
    });
}
function type2_question(question, answer) {
    questions = question;
    answers = answer;
    $("#ul_for_answer").sortable({placeholder: "ui-state-highlight"}).disableSelection();
    $("#p_for_question").text(questions);
    set_random_int(answers.length, random_array);
    //CONVERT_ANSWER
    for (var percent = 0; percent < answers.length; percent++) {
        $("#ul_for_answer").append("<li class='btn btn-info'>" + answers[random_array[percent]] + "</li>");
        shuffle += answers[random_array[percent]];
    }
}
function set_random_int(length_of_answer, array) {
    array[0] = get_random();
    console.log(length_of_answer);
    for (var percent = 1; percent < length_of_answer; percent++) {
        a = get_random();
        if (!dont_have(a, array)) {
            array.push(a);
        } else
            percent--;
    }
    function get_random() {
        return Math.floor(Math.random() * length_of_answer);
    }

    function dont_have(a, array) {
        var have = false;
        for (var percent = 0; percent < array.length; percent++) {
            if (a == array[percent]) {
                have = true;
            }
        }
        return have;
    }
}
$("#finish").click(function () {
    if (shuffle == answers) {
        score += array_json.level * 50;
        ctCorrAnswers++;
    }
    if (current_question < total_question) {
        cmp = total_info.question[current_question++];
        nextQuestion(cmp);
    } else {
        alert("FIRST REQUEST");
        finishResult();
    }
});
//Заменяет answer слова в input
function type_3_method_question(answer_array, q3) {
    console.log(answer_array);
    var quest = q3.split(' ');
    a3 = answer_array;
    //для каждого ответа найдем индекс и заменяем
    for (var i = 0; i < answer_array.length; i++) {
        $.each(quest, function (index, character) {
            if (answer_array[i] === character) {
                quest[index] = create_input(character.length); //заменяем ответы на input field
            }
        });
    }
    $("#p_for_question_type_3").empty().append(quest.join(' '));
}
//создаем input с длиной ответа
function create_input(size) {
    var input = "<input class='input-sm' type='text' name='inputs' size='" + size + "'>";
    return input;
}
//Проверка ответа студента
function type_3_method_check_answer() {
    var i = 0;
    $("input[name='inputs']").each(function () {
        if ($(this).val().toLowerCase().trim() == a3[i].toLowerCase().trim()) {
            console.log($(this).val() + " : correct");
            score += array_json.level * 25;
            correct_answer++;
            $(this).addClass('correct');
        } else {
            console.log($(this).val() + " : incorrect");
            $(this).addClass('incorrect');
        }
        i++;
        if(i==a3.length){
        setTimeout(function () {
            if (current_question < total_question) {
                cmp = total_info.question[current_question++];
                nextQuestion(cmp);
            } else {
                alert("GAME FINISH");
                finishResult();
            }
        }, 2000);}
    });
}
init();
// $("#progress1").attr("aria-valuenow", "50").css('width', percent+'%').html(""+percent/10+" из 10");

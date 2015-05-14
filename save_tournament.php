<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 02.05.2015
 * Time: 22:36
 */
//
include_once 'connect.php';
/*Table tournaments: id, title, id_groups, id_teacher, datetime_added, status, when_opened, when_closed, public, description
Table questions: id, id_tournament, question, type_question, question_point, time_limit, level_question
Table variants: id, id_question, correct, text
*/
$tournament_info = '';
$title = $description = $when_opened = $when_closed = $public = $id_groups = $id_teacher = $status = $datetime_added = '';

$id_tournament = $question = $type_question = $question_point = $time_limit = $level_question = '';

if(isset($_POST['dannie'])){
    $php_json=$_POST['dannie'];
    $json_array=json_decode($php_json,JSON_UNESCAPED_UNICODE);

    $title = $json_array['about_tournament']['name'];
    $description = $json_array['about_tournament']['description'];
    $datetime_added = date("Y-m-d h:i:s");
    $when_opened = $json_array['about_tournament']['opened'];
    $when_closed = $json_array['about_tournament']['closed'];
    $public = $json_array['about_tournament']['public'];

    for($i=0;$i<count($json_array['questions']);$i++){
        //$id_tournament =
        $question = $json_array['questions'][$i]['question'];
        $type_question = $json_array['questions'][$i]['game_type'];
        $question_point = $json_array['questions'][$i]['point'];
        $time_limit = $json_array['questions'][$i]['time_limit'];
        $level_question = $json_array['questions'][$i]['level'];

        mysqli_query($con, "INSERT INTO tb_questions(id_tournament, question, type_question, question_point, time_limit, level_question)
                        VALUES ((SELECT MAX(id) FROM tb_tournaments))")
        or die(mysqli_error($con));
    }
    mysqli_query($con, "INSERT INTO tb_tournaments(title, id_groups, id_teacher, datetime_added, time_limit, status, when_opened, when_closed, public, description)
                        VALUES ($title,)")
    or die(mysqli_error($con));

    mysqli_query($con, "INSERT INTO tb_variants(id_question, correct, text)
                        VALUES ()")
    or die(mysqli_error($con));
}
?>
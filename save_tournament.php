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
$title = $description = $when_opened = $when_closed = $public = $id_group = $id_teacher = $status = $datetime_added = '';

$id_tournament = $question = $type_question = $question_point = $time_limit = $level_question = '';

$id_question = $correct = $text = '';

if (isset($_POST['dannie'])) {
    $php_json = $_POST['dannie'];
    $json_array = json_decode($php_json, JSON_UNESCAPED_UNICODE);

    //Данные для tb_tournaments
    $title = $json_array['about_tournament']['name'];
    $description = $json_array['about_tournament']['description'];
    $status = $json_array['about_tournament']['status'];
    $datetime_added = $json_array['about_tournament']['current_date'];
    $when_opened = $json_array['about_tournament']['opened'];
    $when_closed = $json_array['about_tournament']['closed'];
    $public = $json_array['about_tournament']['public'];
    $id_group = $json_array['about_tournament']['id_groups'];
    $id_teacher = $json_array['about_tournament']['id_teacher'];

    mysqli_query($con, "INSERT INTO tb_tournaments(title, id_groups, id_teacher, datetime_added, status, when_opened, when_closed, public, description)
                        VALUES ('$title', '$id_group', '$id_teacher', '$datetime_added', '$status', '$when_opened', '$when_closed', '$public', '$description')")
                        or die(mysqli_error($con));
    for ($i = 0; $i < count($json_array['questions']); $i++) {
        //Данные для tb_questions нет id_tournament
        $question = $json_array['questions'][$i]['question'];
        $type_question = $json_array['questions'][$i]['game_type'];
        $question_point = $json_array['questions'][$i]['point'];
        $time_limit = $json_array['questions'][$i]['time_limit'];
        $level_question = $json_array['questions'][$i]['level'];

        $rt_id = mysqli_query($con, "SELECT id as id FROM tb_tournaments WHERE title='$title'");
        $row = mysqli_fetch_array($rt_id);
        $id_sa=$row['id'];
        mysqli_query($con, "INSERT INTO tb_questions(id_tournament, question, type_question, question_point, time_limit, level_question)
                    VALUES ('$id_sa', '$question', '$type_question', '$question_point', '$time_limit', '$level_question')")
                    or die(mysqli_error($con));
        //Данные для tb_variants
        $correct = 0;
        if($type_question=='Simple' || $type_question=='True-false'){
            $correct_answer_index = $json_array['questions'][$i]['correct_answer_id'];
            for ($j = 0; $j < count($json_array['questions'][$i]['answers']); $j++) {
                if($j==$correct_answer_index){
                    $correct = 1;
                }else{
                    $correct = 0;
                }
                $text = $json_array['questions'][$i]['answers'][$j];
                $rq_id = mysqli_query($con, "SELECT id FROM tb_questions WHERE id_tournament='$id_sa' and question='$question'");
                $row_q = mysqli_fetch_array($rq_id);
                $id_sa_q=$row_q['id'];
                //echo $id_sa_q;
                mysqli_query($con, "INSERT INTO tb_variants(id_question, correct, text)
                        VALUES ('$id_sa_q','$correct', '$text')")
                or die(mysqli_error($con));
                //echo 'ASDASDASD2222';
            }
        }else{
            $correct = $json_array['questions'][$i]['correct'];
            for ($j = 0; $j < count($json_array['questions'][$i]['answers']); $j++) {
                $text = $json_array['questions'][$i]['answers'][$j];

                $rq_id = mysqli_query($con, "SELECT id FROM tb_questions WHERE question='$question'");
                $row_q = mysqli_fetch_array($rq_id);
                $id_sa_q=$row_q['id'];

                mysqli_query($con, "INSERT INTO tb_variants(id_question, correct, text)
                        VALUES ('$id_sa_q','$correct', '$text')")
                or die(mysqli_error($con));
            }
        }
    }
    if($con){
        echo "<p>Tournament is successfully saved</p>";
        mysqli_close($con);
    }
}
?>
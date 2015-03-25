<?php
if (isset($_POST['q'])) {
    $q = $_POST['q'];
    include_once 'connect.php';
    header("Content-Type: application/json; charset=utf-8");
    if ($q == 'init') {
        $id_tournaments = $_POST['id'];
        $query = mysqli_query($con, "
        SELECT
          a.title                   AS title,
          a.time_limit              AS time_limit,
          a.status                  AS status,
          b.id                      AS id_question,
        (SELECT COUNT(*)
          FROM tb_questions
          WHERE id_tournament = '$id_tournaments') AS count
        FROM tb_tournaments a, tb_questions b
        WHERE a.id = b.id_tournament and a.id='$id_tournaments'") or die(mysqli_error($con));
        if ($query) {
            $have_questions_id = array();
            while ($row = mysqli_fetch_array($query)) {
                $json = array('title' => $row['title'],
                    'time_limit' => $row['time_limit'],
                    'status' => $row['status'],
                    'count' => $row['count']);
                array_push($have_questions_id, $row['id_question']);
            }
            $json['question'] = $have_questions_id;
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            exit("Запись не найдена");
        }
    } else if ($q == 'question') {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $query = mysqli_query($con, "SELECT
      a.id             AS id_question,
      a.question       AS question,
      a.level_question AS level,
      a.type_question as type,
      c.id             AS id,
      c.text           AS text,
      c.correct        AS correct
    FROM tb_questions a,  tb_variants c
    WHERE c.id_question = a.id and a.id='$id' ORDER BY c.id ASC ") or die(mysqli_error($con));
            $i = 0;
            if ($query) {
                $variants = array();
                while ($row = mysqli_fetch_array($query)) {
                    $array = array(
                        'id_question' => $row['id_question'],
                        'level' => $row['level'],
                        'question' => $row['question'],
                        'type' => $row['type']);
                    array_push($variants, array('answer' => $row['text'], 'correct' => $row['correct'], 'id' => $row['id']));
                }
                $array['variants'] = $variants;
                echo json_encode($array, JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                exit("<span>Question not found in Database</span>");
            }
        }
    } else {
        exit("Комманда не найдена");
    }
}
?>
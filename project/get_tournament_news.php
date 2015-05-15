<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 15.05.2015
 * Time: 11:46
 */
include_once 'connect.php';
$current_date = $news = '';
$col_news = "<div class='my-col-md-3'><div class='col-head col-head-text'><span>";
    $col_news2 = "</span></div><div class='col-content'><p class='text-center text-info' style='font-size: large'>";
        $col_news4 = "</p><p class='text-center' style='font-size: larger; padding: 10px'>";
        $col_news3 = "</p></div></div>";
//if(isset($_POST['data'])){
    $news_r = mysqli_query($con,
        "SELECT title, when_opened, description FROM tb_tournaments WHERE DATEDIFF(NOW(),when_opened)<20 and DATEDIFF(NOW(),when_opened)>-20 ORDER BY when_opened DESC LIMIT 3");
    $row = mysqli_fetch_array($news_r);
    //var_dump($row);
    for($i=0; $i<3; $i++){
        echo $col_news. $row['when_opened']. $col_news2. $row['title']. $col_news4. $row['description']. $col_news3;
    }
//}
?>
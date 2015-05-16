<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 15.05.2015
 * Time: 11:46
 */
        include_once 'connect.php';
	    $news_r = mysqli_query($con,
                "SELECT A.title as title, A.when_opened as when_opened, A.description as description,CONCAT(B.surname,' ', B.name) as fullname,B.id as id_teacher,B.photo_url as photo_url FROM tb_tournaments A,tb_teacher B WHERE DATEDIFF(NOW(),A.when_opened)<20 and DATEDIFF(NOW(),A.when_opened)>-20 and A.id_teacher=B.id ORDER BY A.when_opened DESC LIMIT 3");
           
        $count = mysqli_num_rows($news_r);
       while($row = mysqli_fetch_array($news_r)){
            $datetime = strtotime($row['when_opened']);
            $date_format = Date("H:i:s d.m.Y", $datetime);
            printf("<div class='my-col-md-3'>
            <div class='col-head col-head-text'>
                <span>%s</span>
                    </div>
                    <div class='col-content'>
                    <p class='text-center text-info' style='background-color: rgba(206, 132, 131, 0.57);
    color: white;'>%s</p>
                    <p class='text-center' style='font-size: larger; padding: 10px'>%s</p>
                    <div class='class-footer'>
                <div class='col-3'><img class='img img-circle' src='img/%s'></div><div class='col-9'><h4>%s</h4></div>
                    </div>
                </div></div>",$date_format,$row['title'],$row['description'],$row['photo_url'],$row['fullname']);
            // old version - > echo $col_news . $date_format . $col_news2 . $row['title'] . $col_news4 . $row['description'] . $col_news3;
        }
//}
?>

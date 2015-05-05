<?php
/**
 Oiyn turine bailanysty oiynnyn contentin kaitarady
 */
$simple_game = "<div class='col-12'>
                    <textarea class='form-control'
                              style='width: 100%; height: 100px; margin-top: 1%'
                              placeholder='Please enter your question...'></textarea>
                </div>
                <div class='form-group' id='content_answer_input' style='float: left' id='simple_game'>
                    <div class='col-12 margin-top-5'>
                        <div class='col-9' style='padding: 0px'>
                            <input class='form-control' style='width: 100%' type='text' placeholder='Answer 1'>
                        </div>
                        <div class='col-3' style='padding: 0px'>
                            <button class='btn btn-danger pull-right'>Incorrect</button>
                        </div>
                    </div>
                    <div class='col-12 margin-top-5'>
                        <div class='col-9' style='padding: 0px'>
                            <input class='form-control' style='width: 100%' type='text' placeholder='Answer 2'>
                        </div>
                        <div class='col-3' style='padding: 0px'>
                            <button class='btn btn-danger pull-right'>Incorrect</button>
                        </div>
                    </div>
                    <div class='col-12 margin-top-5'>
                        <div class='col-9' style='padding: 0px'>
                            <input class='form-control' style='width: 100%' type='text' placeholder='Answer 3'>
                        </div>
                        <div class='col-3' style='padding: 0px'>
                            <button class='btn btn-danger pull-right'>Incorrect</button>
                        </div>
                    </div>
                    <div class='col-12 margin-top-5'>
                       <div class='col-9' style='padding: 0px'>
                            <input class='form-control' style='width: 100%' type='text' placeholder='Answer 4'>
                        </div>
                        <div class='col-3' style='padding: 0px'>
                            <button class='btn btn-danger pull-right'>Incorrect</button>
                        </div>
                    </div>
                </div>";

$true_and_false =   "<div class='col-12' >
                        <textarea class='form-control' placeholder='Please enter your question...'
                              style='width: 100%; height: 100px;'></textarea>
                    </div>
                    <div class='form-group col-12' id='content_answer_input' style='float: left' id='simple_game'>
                        <div class='col-12 margin-top-5' style='padding: 0px;'>
                            <div class='col-3' style='padding: 0px'>
                                <input class='form-control' readonly style='width: 100%;' type='text' value='True'>
                            </div>
                            <div class='col-2' style='padding: 0px'>
                                <button class='btn btn-danger pull-right'>Incorrect</button>
                            </div>
                            <div class='col-3 col-offset-2' style='padding: 0px'>
                                <input class='form-control' style='width: 100%;' readonly type='text' value='False'>
                            </div>
                            <div class='col-2' style='padding: 0px'>
                                <button class='btn btn-danger pull-right'>Incorrect</button>
                            </div>
                        </div>
                    </div>";
$input_game = $match_game = $poleshudes_game = "";

if(isset($_POST['game_type']) && !is_null($_POST['game_type'])){
    $game_type = htmlspecialchars($_POST['game_type']);
    if($game_type=="Simple"){
        echo $simple_game;
    }else if($game_type=="True-false"){
        echo $true_and_false;
    }else if($game_type=="Input"){
        echo $input_game;
    }else if($game_type=="Pole chudes"){
        echo $poleshudes_game;
    }else if($game_type=="Match"){
        echo $match_game;
    }
}
?>
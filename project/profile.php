<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap-->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/user_profile.css" rel="stylesheet">
    <title></title>
</head>
<body style="background-color: #EEF3FA">
<?php
include_once 'utils.php';
include_once 'connect.php';
//Для пробный проверки достаточные эти данные
if (check_user($con) == True) {
    printf("<script>console.log('Пользователь найден ... OK')</script>
        ");
} else {
    header("Location: main_page.html");
}
require_once 'nav.php';
?>
<div class="container" style="margin-top: 30px;">
    <div class="row ">
        <div class="col-10" style="background-color: #ffffff">
            <div class="well-sm">
                <fieldset>
                    <legend class="text-primary page-header text-center" style="font-size: xx-large">User profile
                    </legend>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10" style="background-color:#ffffff;">
            <div class="col-6">
                <div class="row">
                    <div class="col-1 col-offset-8">
                        <img class="delete_icon" name="delete" onclick="myFunction()" width="20" height="20">
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 col-offset-2">
                        <img id="alim" src="img/no_photo_available.jpg" class="img-circle img-thumbnail">
                    </div>
                </div>

                <div class="row">
                    <div class="col-9 col-offset-2">
                        <input id="imgInp" type="file" class="form-control" style="margin-top: 20px;width: 80%"
                               size="20">
                    </div>
                </div>
            </div>
            <div class="col-6" style="background-color:#ffffff">
                <div class="row">
                    <div class="col-4">
                        <p class="text-primary" style="font-size: large; margin-top: 20px"><b>Personal info</b></p>

                    </div>
                    <div class="col-4 col-offset-3">
                        <p role="button" class="text-muted ch " id="edit" style="font-size: small"><i
                                class="fa fa-pencil"></i> Edit
                        </p>
                    </div>
                    <div class="col-5 col-offset-3">
                        <!-- Button trigger modal -->
                        <p type="button" class="text-muted ch " data-toggle="modal" data-target="#myModal"><i
                                class="fa fa-key"></i>Change password</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="left">First name:
                            <input class="form-control" id="name" placeholder="Alimkhan" size="30" disabled>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="left">
                            Last name:<input id="surname" class="form-control" disabled placeholder="Dossymbetov"
                                             size="30">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="left">
                            Group name:<input id="groupname" class="form-control" placeholder="EN3_04(kz)" size="30"
                                              disabled>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="left">
                            Email:<input class="form-control" id="email" placeholder="alimkhan.dossymbetov@mail.ru"
                                         disabled>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="left">
                            Phone number: <input id="phone" class="form-control" placeholder="+77788866826" size="30"
                                                 disabled>
                        </label>
                    </div>
                </div>
                <div class="row" style="margin:10px">
                    <div class=" col-10 col-offset-1">
                        <button id="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
<script>
    lastResponse = "";
    $.ajax({
        type: "POST",
        url: "utils.php",
        data: {q: 'getUserData()'},
        cache: false,
        success: function (response) {
            $("#phone").val(response.telephone);
            $("#email").val(response.email);
            $("#name").val(response.name);
            $("#surname").val(response.surname);
            $("#groupname").val(response.group);
            $("#alim").attr("src", "img/" + response.photo_url);
            lastResponse = response;
        }
    });
    editTurn = true;
    $("#edit").click(function () {
        $("input").each(function () {
            var id = $(this).attr("id");
            if (id != 'imgInp') {
                editTurn = !$(this).attr("disabled");
                $(this).attr({"disabled": !$(this).attr("disabled")});
            }
            if (editTurn) {
                $("#submit").css({"visibility": "hidden"});
                $("#phone").val(lastResponse.telephone);
                $("#email").val(lastResponse.email);
                $("#name").val(lastResponse.name);
                $("#surname").val(lastResponse.surname);
                $("#groupname").val(lastResponse.group);
            }
        });
        $("#submit").css({"visibility": "visible"});
    });
    $("#submit");
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#alim').attr('src', e.target.result);
                //css({"width": "230px", "height": "230px"});
            };
            reader.readAsDataURL(input.files[0]);
            $(".delete_icon").css({"visibility": "visible"});
            $("#submit").css({"visibility": "visible"});

        }
    }

    function myFunction() {
        $(".delete_icon").css({"visibility": "hidden"});
        $("#submit").css({"visibility": "hidden"});
        $('#alim').attr('src', "img/"+lastResponse.photo_url);

    }
    $("#imgInp").change(function () {
        readURL(this);
    });
    function Changesave() {
        alert("Save change")
    }
</script>
<!-- Modal -->
<div class="modal fade  bs-example-modal-sm " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></p>
                <h4 class="modal-title text-primary" id="myModalLabel ">Change password</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-offset-1">Current password:</label>

                            <div class="input-group col-4 col-offset-1">
                                <span class="input-group-addon">
                                <i class="fa fa-unlock"></i>
                                </span>
                                <input class="form-control" placeholder=" Give old password" size="30">
                            </div>
                            <label class="col-offset-1">New password:</label>

                            <div class="input-group col-4 col-offset-1">
                                <span class="input-group-addon">
                                    <i class="fa fa-unlock"></i>
                                </span>
                                <input class="form-control" placeholder="Give new password" size="30">
                            </div>
                            <label class="col-offset-1">Comfirm password</label>

                            <div class="input-group col-4 col-offset-1">
                                <span class="input-group-addon">
                                    <i class="fa fa-unlock"></i>
                                </span>
                                <input class="form-control" placeholder="Repeat password">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="Changesave()" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
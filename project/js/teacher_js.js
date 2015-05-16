/*Teacher page JS*/

selectedCategory = '';
selectedGroupID = "";
old_name_group = "";
function selCategory(input) {
    this.selectedCategory = input;
    console.log(input);
}
function removeGroups(input) {
    $.ajax({
        method: 'POST',
        url: 'calculateResult.php',
        data: {'command': 'cGroupDestroy', 'id_groups': input, 'id_teacher': '1', message: 'Sorry, my friends'},
        success: function (msg) {

            alert(msg);
            window.open("teacher.php", "_self");
        }
    });
}
function editNameGroups(name_group,ID) {
    $("#myModalEditGroupName").modal("show");
    old_name_group = name_group; //new group name;
    selectedGroupID = ID; //group ID
    console.log(selectedGroupID);
}
$("#group_change_name").click(function () {
    if (selectedGroupID != '' || old_name_group != '') {
        var new_name = $("#new_name_group").val();
        if (old_name_group != new_name) {
            $.ajax({
                method: 'POST',
                url: 'calculateResult.php',
                data: {'command': 'cGroupEditName', id_groups: selectedGroupID, id_teacher: id_teacher, title: new_name},
                success: function (msg) {
                    alert(msg);
                    window.open("teacher.php", "_self");
                }
            });
        } else {
            alert("Старое и новое имя группы одинаковый");
        }
    } else {
        alert("Error!Один из полей остался пустым");
    }
});
function deleteFromGroups(id_student, id_groups) {
    $.ajax({
        method: 'POST',
        url: 'calculateResult.php',
        data: {command: 'cDeleteStudentFromGroups', id_groups: id_groups, id_student: id_student},
        success: function (msg) {
            window.open("teacher.php", "_self");
        }
    });
}
function addStudentToGroup(id_student,id_groups){
    $.ajax({
        method: 'POST',
        url: 'calculateResult.php',
        data: {command: 'cGroupAdd', id_groups: id_groups, id_student: id_student,approved:'1'},
        success: function (msg) {
           say(msg);
            //window.open("teacher.php", "_self");
        }
    });
}
$("li[role='presentation']").click(function () {
    if ($(this).attr("name") != 'addGroups') {
        $("li[role='presentation']").each(function () {
            $(this).removeClass("active");
        });
        $(this).addClass("active");
    }
    $("#groud_add_btn").click(function () {
        name = $("#new_group_name").val();
        if (selectedCategory == '') {
            alert(("Должны выбрать категорию"));
            return false;
        } else {
            $.ajax({
                method: 'POST',
                url: 'calculateResult.php',
                cache: false,
                data: {command: 'cCreateGroup', title: name, id_teacher: id_teacher, category: selectedCategory},
                success: function (msg) {
                    //2 - Группа с таким именем существует
                    //1 - Авторизация провалена
                    //0 - kruto
                    if (msg == '2') {
                        alert("Группа с таким именем существует!Выберете другой...");
                    } else if (msg == '1') {
                        alert("Авторизация провалена");
                    } else if (msg == '4') {
                        alert("Не выбрано категория");
                    } else {
                        alert("Успешно создано.Обновление страницы");
                        window.open("teacher.php", "_self");
                    }
                }

            });
        }
    });
    //Else: Откроется modal окно. Кнопка открытые в 'Создать группу'
});
function getBadgeInfo(){
    $.ajax({
        method:'POST',
        url:'calculateResult.php',
        data:{command:'cGroupGetListStudent',innerCommand:'getBadgeInfo',id_teacher:id_teacher},
        success:function(msg){
         console.log(msg);
         if(msg.COUNT>0){
            $("a[role='link'][name='group']").append(' <span class="badge">'+msg.COUNT+'</span>');
        }
    }
});
}

function get_groups(input) {
    $.ajax({
        method: 'POST',
        url: 'calculateResult.php',
        data: {'command': 'cGroupGetListStudent', 'id_groups': input},
        success: function (msg) {
            $("#tb_groups_table").html("");
            if (msg != '-1') {
                for (i = 0; i < msg.length; i++) {
                    console.log(msg[i]);
                    s = '<tr'+((msg[i].approved==1)?'':' class="warning" ')+'><td><div class="row">' +
                    '<div class="col-2"><img src="img/' + msg[i].photo_url + '" height="32px" width="32px" alt="" class="img img-cirlce"></div><div class="col-10">' + msg[i].fullname + '</div>' +
                    '  </div></td><td>' +
                    ' <div class="btn-group">' +
                    '  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">' +
                    '   Action <span class="caret"></span></button>' +
                    '<ul class="dropdown-menu" role="menu">' +
                    '  <li><a href="#"><img src="img/chat_message.png" width="18" height="18" alt="no_photo"> Отправить сообщение</a></li>' +
                    ((msg[i].approved==1)?' <li><a href="#" onclick=\'deleteFromGroups(\"' + msg[i].id_student + '\",\"' + msg[i].id_groups + '\")\'><img src="img/user_remove.png"  width="18" height="18" alt="no_photo"> Удалить из группы</a></li>' :
                        ' <li><a href="#" onclick=\'addStudentToGroup(\"' + msg[i].id_student + '\",\"' + msg[i].id_groups + '\")\'><img src="img/user_add_to_group.png"  width="18" height="18" alt="no_photo"> Добавить в группу</a></li>' )+
                    ' <li><a href="../../project/profile.php?id=' + msg[i].id_student + '"><img src="img/user.png" width="18" height="18" alt="no_photo"> Просмотреть профиль</a></li>' +
                    '</ul></div></td> </tr>';
                    $("#tb_groups_table").append(s);
                }

            }
        }
    });
}
/*-----*/
function say(input) {
    console.log(input);
}
$(document).ready(function () {
    $(".qr-code").click(function(){
        val=$(this).attr("name");
        $("#sh1").html(val);
        $("#qrCodeIMG").attr("src","http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl="+val);
        $("#myModalQrCode").modal('show');
    });
    $("a[role=link]").click(function () {
        var name = $(this).attr("name");
        $("a[role=link]").each(function () {
            $(this).removeClass().removeClass().addClass("list-group-item");
            console.log("CON");
        });
        $(this).addClass("active");
        if (name == 'Home') {
            $("#main-frame").fadeIn("fast");
            $("#nagrada-frame").fadeOut("fast");
            $("#raiting-frame").fadeOut("fast");

            $("#group-frame").fadeOut("fast");
            activate = 0;
        } else if (name == 'Profile') {
            $("#main-frame").fadeOut("fast");
            $("#nagrada-frame").fadeIn("fast");
            $("#raiting-frame").fadeOut("fast");

            $("#group-frame").fadeOut("fast");
            activate = 1;
        } else if (name == 'Messages') {
            $("#nagrada-frame").fadeOut("fast");
            $("#main-frame").fadeOut("fast");
            $("#raiting-frame").fadeIn("fast");

            $("#group-frame").fadeOut("fast");
            activate = 2;
        } else if (name == 'group') {
            $("#group-frame").fadeIn("fast");
            $("#nagrada-frame").fadeOut("fast");
            $("#main-frame").fadeOut("fast");
            $("#raiting-frame").fadeOut("fast");
        }
    });
activate = 0;
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$(".nagrada").children('img').each(function () {
    $(this).mouseenter(function () {
        var pos = $(this).position();
        var posDiv = $(".nagrada").position();
        var selecting = parseInt($(this).attr(("name")));
        console.log(selecting);
        console.log(nagrada_items_db[selecting].img);
        console.log(nagrada_items_db[selecting].description);
        $("#note_img").attr("src", nagrada_items_db[selecting].img);
        $("#note_description").text(nagrada_items_db[selecting].description);
        $("#note_awards").fadeIn("show").fadeIn("fast").
        css({"left": pos.left + "px", "top": (posDiv.top - 50) + "px", "display": "block"});
    });
});
$(".nagrada").children('img').each(function () {
    $(this).mouseleave(function () {
        $("#note_awards").fadeOut("fast");
    });
});
getBadgeInfo();
});


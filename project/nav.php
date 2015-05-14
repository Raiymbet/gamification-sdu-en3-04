<?php
printf('<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img alt="Brand" src="img/icon.png" style="width: 32px;height: 32px"> BattleBrains
                </a>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="profile.php?id=%s"><img src="img/%s"
                                                style="width: 32px;height: 32px;margin-right: 8px;margin-top: -8px">%s</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">More
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span>Help</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-book"></span>Contacts</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse   -->
    </div>
    <!-- /.container-fluid -->
</nav>', $_COOKIE['id'],$_COOKIE['photo_url'], $_COOKIE['name']);
?>
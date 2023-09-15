<?php
//session_start();
//session_regenerate_id(true);
// load database configurations
require_once './config/dbc.php';
?>
<!DOCTYPE html>
<html>
    <!--author:  -->
    <head> 
        <!--load CSS styles-->
        <?php require_once './include/systemHeader.php'; ?>  
        <style>

        </style>
    </head>
    <!--<body class="green-back" src="img/starterSlides/IMG20191017114628.jpg" alt="" style="width: auto" >-->        
    <body background="img/starterSlides/123.jpg" alt="" style="background-repeat: no-repeat; background-size: cover; background-repeat: no-repeat;" >        
        <div class="container signForm">
            <h5 class="text-center" style="color:#262626">School Management System</h5>
            <h2 class="form-signin-heading text-center" style="color:#262626;">School Management System</h2>
            <div class="card card-signin">
                <img class="profile-img" src="img/starterSlides/mangmanet.png" alt="" style="">
                <!--<img class="profile-img" src="img/starterSlides/Part 3.png" alt="" style="width: auto">-->
                <div class="form-signin">
                    <input type="text" class="form-control" id="userName" placeholder="Username" required autofocus autocapitalize="off" autocomplete="off" autocorrect="off">
                    <input type="password" class="form-control" id="password" placeholder="Password" required onkeyup="inputKeyUp(event)">
                    <button class="btn btn-lg btn-custom-save btn-block" style="padding: 10px;" id="logSystem">Sign in</button>

                </div>
            </div>

        </div> <!-- /container -->   
        <!-- load JavaScript-->
        <?php require_once './include/systemFooter.php'; ?>       
        <script type="text/javascript">

//
            $(function () {

//                starterBgSlideTransition();

                $(document).ready(function ()
                {
                    $(document).bind("contextmenu", function (e) {
//                        return false;
                    });
                });

                document.onkeypress = function (event) {
                    event = (event || window.event);
                    if (event.keyCode == 123) {
                        //alert('No F-12');
//                        return false;
                    }
                }
                document.onmousedown = function (event) {
                    event = (event || window.event);
                    if (event.keyCode == 123) {
                        //alert('No F-keys');
//                        return false;
                    }
                }
                document.onkeydown = function (event) {
                    event = (event || window.event);
                    if (event.keyCode == 123) {
                        //alert('No F-keys');
//                        return false;
                    }
                }

            });

        </script>
    </body>
</html>


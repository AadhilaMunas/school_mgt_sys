<?php
include './config/dbc.php';
$conn = new MainConfig();
session_start();
?>
<!DOCTYPE html>
<html>
    <head>  
        <!--load CSS styles-->
        <?php require_once './include/systemHeader.php'; ?>  
        <style>
            body {
                padding: 40px 0px;   
            }

            #search {
                position: fixed;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 100%;
               

                -webkit-transition: all 0.5s ease-in-out;
                -moz-transition: all 0.5s ease-in-out;
                -o-transition: all 0.5s ease-in-out;
                -ms-transition: all 0.5s ease-in-out;
                transition: all 0.5s ease-in-out;

                -webkit-transform: translate(0px, -100%) scale(0, 0);
                -moz-transform: translate(0px, -100%) scale(0, 0);
                -o-transform: translate(0px, -100%) scale(0, 0);
                -ms-transform: translate(0px, -100%) scale(0, 0);
                transform: translate(0px, -100%) scale(0, 0);
                opacity: 0;
                z-index: 9999;
            }

            #search.open {
                -webkit-transform: translate(0px, 0px) scale(1, 1);
                -moz-transform: translate(0px, 0px) scale(1, 1);
                -o-transform: translate(0px, 0px) scale(1, 1);
                -ms-transform: translate(0px, 0px) scale(1, 1);
                transform: translate(0px, 0px) scale(1, 1); 
                opacity: 1;
            }

            #search input[type="search"] {
                position: absolute;
                top: 50%;
                width: 100%;
                color: rgb(255, 255, 255);
                background: rgba(0, 0, 0, 0);
                font-size: 60px;
                font-weight: 300;
                text-align: center;
                border: 0px;
                margin: 0px auto;
                margin-top: -51px;
                padding-left: 30px;
                padding-right: 30px;
                outline: none;
            }
            #search .btn {
                position: absolute;
                top: 50%;
                left: 50%;
                margin-top: 61px;
                margin-left: -45px;
            }
            #search .close {
                position: fixed;
                top: 15px;
                right: 15px;
                color: #fff;
                background-color: #428bca;
                border-color: #357ebd;
                opacity: 1;
                padding: 10px 17px;
                font-size: 27px;
            }

            .btn3d {
                position:relative;
                top: -6px;
                border:0;
                transition: all 40ms linear;
                margin-top:10px;
                margin-bottom:10px;
                margin-left:2px;
                margin-right:2px;
            }
            .btn3d:active:focus,
            .btn3d:focus:hover,
            .btn3d:focus {
                -moz-outline-style:none;
                outline:medium none;
            }
            .btn3d:active, .btn3d.active {
                top:2px;
            }
            .btn3d.btn-white {
                color: #666666;
                box-shadow:0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255,255,255,0.10) inset, 0 8px 0 0 #f5f5f5, 0 8px 8px 1px rgba(0,0,0,.2);
                background-color:#fff;
            }
            .btn3d.btn-white:active, .btn3d.btn-white.active {
                color: #666666;
                box-shadow:0 0 0 1px #ebebeb inset, 0 0 0 1px rgba(255,255,255,0.15) inset, 0 1px 3px 1px rgba(0,0,0,.1);
                background-color:#fff;
            }
            .btn3d.btn-default {
                color: #666666;
                box-shadow:0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255,255,255,0.10) inset, 0 8px 0 0 #BEBEBE, 0 8px 8px 1px rgba(0,0,0,.2);
                background-color:#f9f9f9;
            }
            .btn3d.btn-default:active, .btn3d.btn-default.active {
                color: #666666;
                box-shadow:0 0 0 1px #ebebeb inset, 0 0 0 1px rgba(255,255,255,0.15) inset, 0 1px 3px 1px rgba(0,0,0,.1);
                background-color:#f9f9f9;
            }
            .btn3d.btn-primary {
                box-shadow:0 0 0 1px #417fbd inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #4D5BBE, 0 8px 8px 1px rgba(0,0,0,0.5);
                background-color:#4274D7;
            }
            .btn3d.btn-primary:active, .btn3d.btn-primary.active {
                box-shadow:0 0 0 1px #417fbd inset, 0 0 0 1px rgba(255,255,255,0.15) inset, 0 1px 3px 1px rgba(0,0,0,0.3);
                background-color:#4274D7;
            }
            .btn3d.btn-success {
                box-shadow:0 0 0 1px #31c300 inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #5eb924, 0 8px 8px 1px rgba(0,0,0,0.5);
                background-color:#78d739;
            }
            .btn3d.btn-success:active, .btn3d.btn-success.active {
                box-shadow:0 0 0 1px #30cd00 inset, 0 0 0 1px rgba(255,255,255,0.15) inset, 0 1px 3px 1px rgba(0,0,0,0.3);
                background-color: #78d739;
            }
            .btn3d.btn-info {
                box-shadow:0 0 0 1px #00a5c3 inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #348FD2, 0 8px 8px 1px rgba(0,0,0,0.5);
                background-color:#39B3D7;
            }
            .btn3d.btn-info:active, .btn3d.btn-info.active {
                box-shadow:0 0 0 1px #00a5c3 inset, 0 0 0 1px rgba(255,255,255,0.15) inset, 0 1px 3px 1px rgba(0,0,0,0.3);
                background-color: #39B3D7;
            }
            .btn3d.btn-warning {
                box-shadow:0 0 0 1px #d79a47 inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #D79A34, 0 8px 8px 1px rgba(0,0,0,0.5);
                background-color:#FEAF20;
            }
            .btn3d.btn-warning:active, .btn3d.btn-warning.active {
                box-shadow:0 0 0 1px #d79a47 inset, 0 0 0 1px rgba(255,255,255,0.15) inset, 0 1px 3px 1px rgba(0,0,0,0.3);
                background-color: #FEAF20;
            }
            .btn3d.btn-danger {
                box-shadow:0 0 0 1px #b93802 inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #AA0000, 0 8px 8px 1px rgba(0,0,0,0.5);
                background-color:#D73814;
            }
            .btn3d.btn-danger:active, .btn3d.btn-danger.active {
                box-shadow:0 0 0 1px #b93802 inset, 0 0 0 1px rgba(255,255,255,0.15) inset, 0 1px 3px 1px rgba(0,0,0,0.3);
                background-color: #D73814;
            }
            .btn3d.btn-magick {
                color: #fff;
                box-shadow:0 0 0 1px #9a00cd inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #9823d5, 0 8px 8px 1px rgba(0,0,0,0.5);
                background-color:#bb39d7;
            }
            .btn3d.btn-magick:active, .btn3d.btn-magick.active {
                box-shadow:0 0 0 1px #9a00cd inset, 0 0 0 1px rgba(255,255,255,0.15) inset, 0 1px 3px 1px rgba(0,0,0,0.3);
                background-color: #bb39d7;
            }
            .prettyline {
                height: 5px;
                border-top: 0;
                background: #c4e17f;
                border-radius: 5px;
                background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
                background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            }
        </style>
    </head>
    <body class="green-back">
        <div id="wrap">
            
            <div class="container-fluid">               
                <div class="row">                                 
                    <div class="col-md-11">
                        <input type="hidden" id="guest_hidden" >
                        <div class="page-header cutom-header" style="float: right;">
                            <h1 id="reservation_no"></h1>
                        </div>
                        <div class="page-header cutom-header">
                            <h3><b>WELCOME HOTEL MANAGEMENT SYSTEM</b></h3>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <!-- FORM START -->
                                <div class="col-md-6">
                                    <div class="form-horizontal">
                                        <input type="hidden" id="agent_hid">
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Reservation No :</label>
                                            <div class="col-lg-6">
                                                <select class="res_no" disabled=""></select>
                                            </div>
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Origin: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="guest_origin" id="guest_origin">
                                                    <option value="Local">Local</option> 
                                                    <option value="Foreign">Foreign</option> 
                                                </select>
                                            </div>
                                          
                                                   
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Guest Title: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="guest_title" id="guest_title">
                                                    <option value="Dr.">Dr.</option>
                                                <option value="Miss.">Miss.</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
						<option value="Prof.">Prof.</option>
						<option value="Rev.">Rev.</option>
						<option value="Rev.Fr">Rev.Fr .</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest First Name: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_fname" class="form-control guest_fname" placeholder="Guest First Name">
                                                    <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Last Name: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_lname" class="form-control guest_lname" placeholder="Guest Last Name">
                                                    <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Address: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_address" class="form-control guest_address" placeholder="Address">
                                                    <div class="input-group-addon"><i class="fa fa-tag"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Identity: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_identity" class="form-control guest_identity" placeholder="Guest ID or Passport No">
                                                    <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Tel1: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_tel1" class="form-control guest_tel1" placeholder="Guest Tel1" onkeypress="return isNumberKey(event)" onkeyup ="set_focus_next(event, '#guest_tel2')">
                                                    <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Tel2:</label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">
                                                    <input type="text" id="guest_tel2" class="form-control guest_tel2" placeholder="Guest Tel2" onkeypress="return isNumberKey(event)" onkeyup ="set_focus_next(event, '#guest_country')">
                                                           <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Country: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_country" class="form-control guest_country" placeholder="Guest Country">
                                                    <div class="input-group-addon"><i class="fa fa-check"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Email: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">
                                                    <input type="email" id="guest_email" class="form-control guest_email" placeholder="Guest Email">
                                                    <div class="input-group-addon"><i class="fa fa-check"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">arrival date: </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="date" id="arrival_date" class="form-control arrival_date" placeholder="arrival date" data-date-format="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>">
                                                    <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Departure date: </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">
                                                    <input type="date" id="depature_date" class="form-control depature_date" placeholder="Depature date" data-date-format="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>">
                                                    <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">No of Guest: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="no_guest" id="no_guest">
                                                    <option value="1">1</option> 
                                                    <option value="2">2</option> 
                                                    <option value="3">3</option> 
                                                    <option value="4">4</option> 
                                                    <option value="5">5</option> 
                                                    <option value="6">6</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Select Room Category <font color="red">*</font> :</label>
                                            <div class="col-lg-6">
                                                <select class="Type_ComboBox"></select>
                                            </div>
                                        </div>

                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Select Living Category <font color="red">*</font> :</label>
                                            <div class="col-lg-6">
                                                <select class="living_ComboBox"></select>
                                            </div>
                                        </div>


                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Select Room Basic <font color="red">*</font> :</label>
                                            <div class="col-lg-6">
                                                <select class="basic_ComboBox"></select>
                                            </div>
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">No of Rooms: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="no_rooms" id="no_rooms">
                                                    <option value="1">1</option> 
                                                    <option value="2">2</option> 
                                                    <option value="3">3</option> 
                                                    <option value="4">4</option> 
                                                    <option value="5">5</option> 
                                                    <option value="6">6</option> 
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <!-- ****************************************************************************************************************************************** -->
                                        <div class="form-group">
                                            <div class="col-lg-offset-4 col-lg-10">
                                                <span  id="rm_save_div" class="">
                                                    <button class="btn btn-custom-save" id="online_guest_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                                </span>
                                                
                                                <span  id="agent_reset_div" class="">
                                                    <button class="btn btn-custom-light" id="online_guest_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                </div><!-- end of col-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1" style="margin-top: 121px; margin-left: -450px;">
                        <div>
                            <button style="height: 100px; width: 230px;"  id="resturant_id" type="button" data-toggle="modal" data-target=".resturant" class="btn btn-magick btn-lg btn3d hidden"><span class="glyphicon glyphicon-bell"></span> Booking</button>
                            <div id="search">
                            </div>
                        </div>
                        <div>
                            <button style="height: 100px; width: 230px;" id="resturant_id" type="button" data-toggle="modal" data-target=".resturant" class="btn btn-primary btn-lg btn3d hidden"><span class="glyphicon glyphicon-briefcase"></span> Restaurant</button>
                            <div id="search">
                            </div>
                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;" id="bar_id"  data-toggle="modal" data-target=".bar" class="btn btn-success btn-lg btn3d hidden"><span class="glyphicon glyphicon-glass"></span> Bar</button>

                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;" id="laundry"  data-toggle="modal" data-target=".laundry" class="btn btn-warning btn-lg btn3d hidden"><span class="glyphicon glyphicon-compressed"></span> Laundry</button>
                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;"  data-toggle="modal" data-target=".sundry" id="sundry" class="btn btn-danger btn-lg btn3d hidden"><span class="glyphicon glyphicon-music"></span> Sundry</button>
                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;"  data-toggle="modal" data-target=".rooms" id="rooms" class="btn btn-magick btn-lg btn3d hidden"><span class="glyphicon glyphicon-bookmark"></span> Rooms</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- load JavaScript-->
        <?php require_once './include/systemFooter.php'; ?>
    </body>
    <script type="text/javascript">
        $(function () {
            pageProtect();
            checkurl();
            nextresavation_no();
            
            $('#logout').click(function () {
                logout();
            });

//*******************************combo boxes******************************* 
            roomtype_comboBox();
            livincat_comboBox();
            basic_comboBox();

            $('#search').addClass('open');
            $('body').css('overflow', 'hidden');
            $('#search > form > input[type="search"]').focus();



        });
        $('.date_picker').datepicker();
        function set_focus_next(e, next_comp) {
            e.which = e.which || e.keyCode;
            if (e.which === 13) {
                $(next_comp).focus();
            }
        }

        $('#online_guest_save_btn').click(function () {
            online_guest_save();
        });
        $('#online_guest_reset').click(function () {
            online_clear_guest();
        });

       
        $('#agent_tel_1').on('keyup', function () {
            var phonecusregval = $(this).val().length;
            if (phonecusregval == '0' || phonecusregval == '10') {
                $('#agent_save_btn').removeClass('hidden');
                if (phonecusregval == '10') {
                    $('#phonecusreg').html('');
                    $('#pphone').html('<i class="glyphicon glyphicon-ok-sign"> Valid phone number</i> ');
                } else {
                    $('#phonecusreg').html('');
                    $('#agent_save_btn').removeClass('hidden');
                    $('#pphone').html('<i class="glyphicon glyphicon-ok-sign"> No phone number entered. But you can save.! </i> ');
                }
            } else {
                $('#agent_save_btn').addClass('hidden');
                $('#phonecusreg').html('<i class="glyphicon glyphicon-warning-sign"></i> Sorry... Invalid Phone Number');
                $('#pphone').html('');
            }
        });



        $(function () {
            $('a[href="#search"]').on('click', function (event) {
                event.preventDefault();
                $('#search').addClass('open');
                $('body').css('overflow', 'hidden');
                $('#search > form > input[type="search"]').focus();
            });

            $('#search, #search button.close').on('click keyup', function (event) {
                if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                    $(this).removeClass('open');
                    $('body').css('overflow', 'auto');
                }
            });

            $('#res_search').click(function () {
                $('#search').removeClass('open');
                $('body').css('overflow', 'auto');
                var reg_id = $('#search_reg_id').val();
                search_for_reservation_number(reg_id);
            });

            var wage = document.getElementById("search_reg_id");
            wage.addEventListener("keydown", function (e) {
                var reg_id = $('#search_reg_id').val();
                if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                    if (reg_id == '') {
                        alertify.error('enter reservation no', 2000);
                    } else {
                        search_for_reservation_number(reg_id);
                        $('#search').removeClass('open');
                        $('body').css('overflow', 'auto');
                        $('#search_reg_id').val('');

                    }

                }
            });


        });

//        $('#sundry').click(function () {
//            var sundry = $(this).val();
//            sundry_details(sundry);
//        });
//        $('#bar_id').click(function () {
//            var bar = $(this).val();
//            load_bar_used_table(bar);
//        });
//        $('#laundry').click(function () {
//            var guest_regr = $(this).val();
//            load_laundry_used_table(guest_regr);
//        });
//        $('#rooms').click(function () {
//            var guest_regr = $(this).val();
//            load_room_used_table(guest_regr);
//        });
//
//        $('#resturant_id').click(function () {
//            var restid = $(this).val();
//            load_resturant_table(restid);
//        });


        $('select').chosen({width: "100%"});
    </script>
</html>


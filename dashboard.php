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
            <!--load navigation bar-->
            <?php require_once './include/navBar.php'; ?>
            <div class="container-fluid">               
                <div class="row">                                 
                    <div class="col-md-11">
                        <input type="hidden" id="guest_hidden" >
                        <div class="page-header cutom-header" style="float: right;">
                            <h1 id="reservation_no"></h1>
                        </div>
                        <div class="page-header cutom-header">
                            <h3><b>WELCOME SCHOOL MANAGEMENT SYSTEM</b></h3>
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
                                                    <option value="Mr.">Mr.</option> 
                                                    <option value="Mrs.">Mrs.</option> 
                                                    <option value="Miss.">Miss.</option> 
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

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Total one Day Room Price:</label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="tot_price" class="form-control guest_country" placeholder="Rs.0.00" disabled="">
                                                    <div class="input-group-addon"><i class="fa fa-check"></i></div>
                                                </div>
                                                <!--                                                 <div class="input-group col-lg-6">
                                                                                                 </div>-->
                                            </div>
                                            <button class="btn btn-custom-save" id="price_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Price</button>

                                        </div>

                                        <!-- ****************************************************************************************************************************************** -->

                                        <!--Booking Modal Load  -->
                                        <div class="modal fade booking" id="booking_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <hr class="prettyline">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="col-lg-6" style="margin-top: 0px; padding-right: 0px;">
                                                        <div class="container">
                                                            <div class="col-lg-9" style="margin-top: 30px;">
                                                                <div class="panel panel-primary">
                                                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#booking" placeholder="S    e    a    r    c    h          h   e   r   e   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color: #001940; text-align: center;" />
                                                                    <div class="scrollable" style="height: 300px;">
                                                                        <table class="table tab-content room_book" id="booking" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Reservation No</th>
                                                                                    <th>Guest Name</th>
                                                                                    <th>Guest Country</th>
                                                                                    <th>Guest Tel No.</th>
                                                                                    <th>Guest Email</th>
                                                                                    <th>Arrival Date</th>
                                                                                    <th>Departure Date</th>
                                                                                    <th>Action</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody></tbody>
                                                                        </table>

                                                                    </div>
                                                                </div>


                                                                <div class="tab-content">
                                                                    <input type="hidden"  id="gest_nos"  >
                                                                    <input type="hidden"  id="r_dffs"  >
                                                                    <input type="hidden"  id="rc_ids"  >
                                                                    <div class="form-group ">                                        
                                                                        <label class="col-lg-2 control-label custom-label">Reservation No :</label>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="res_nos" class="form-control res_no" placeholder="Reservation No" disabled>
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <label class="col-lg-2 control-label custom-label">Room Type: </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="r_types" class="form-control r_type" placeholder="Room Type" disabled>
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">                                        
                                                                        <label class="col-lg-2 control-label custom-label">Booking No of Rooms:</label>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="b_rooms" class="form-control b_room" placeholder="Rooms" disabled>
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <label class="col-lg-2 control-label custom-label">Available No of Rooms : </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="a_rooms" class="form-control a_room" placeholder="Guest Origin" disabled>
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">                                        

                                                                        <label class="col-lg-2 control-label custom-label">Payed Advance : </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="adv_amts" class="form-control a_room" placeholder="Rs.00.00" >
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="input-group col-lg-12">
                                                                                <button class="btn btn-custom-delete" id="conferm_save_btns" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Conform</button>
                                                                            </div>
                                                                        </div>  
                                                                        <div class="col-lg-2">
                                                                            <div class="input-group col-lg-12">
                                                                                <button class="btn btn-custom-light" id="cancel_btns" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Cancel</button>
                                                                            </div>
                                                                        </div>  

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="prettyline">
                                        </div>  


                                        <!--Bar Modal -->
                                        <div class="modal fade bar" id="resturant_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <hr class="prettyline">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="col-lg-6" style="margin-top: 0px; padding-right: 0px;">
                                                        <div class="container">
                                                            <div class="col-lg-9" style="margin-top: 30px;">
                                                                <div class="panel panel-primary">
                                                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#bar_table" placeholder="S    e    a    r    c    h          h   e   r   e   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color: #001940; text-align: center;" />
                                                                    <div class="scrollable" style="height: 450px;">
                                                                        <table class="table tab-content bar_table" id="bar_table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Room No</th>
                                                                                    <th>sundry date</th>
                                                                                    <th>sundry time</th>
                                                                                    <th>Price</th>
                                                                                    <th>Discount</th>
                                                                                    <th>Description</th>
                                                                                    <th>Telephone</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody></tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="prettyline">
                                        </div>   


                                        <!--Laundry Modal -->
                                        <div class="modal fade laundry" id="resturant_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <hr class="prettyline">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="col-lg-6" style="margin-top: 0px; padding-right: 0px;">
                                                        <div class="container">
                                                            <div class="col-lg-9" style="margin-top: 30px;">
                                                                <div class="panel panel-primary">
                                                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#laundry_table" placeholder="S    e    a    r    c    h          h   e   r   e   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color: #001940; text-align: center;" />
                                                                    <div class="scrollable" style="height: 450px;">
                                                                        <table class="table tab-content laundry_table" id="laundry_table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Room no</th>
                                                                                    <th>Given date</th>
                                                                                    <th>Given time</th>
                                                                                    <th>Item name</th>
                                                                                    <th>Delivery date</th>
                                                                                    <th>Delivery time</th>
                                                                                    <th>Item Price</th>
                                                                                    <th>Qty</th>
                                                                                    <th>Telephone</th>
                                                                                    <th>Laundry Price</th>
                                                                                    <th>Pressing Price</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody></tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="prettyline">
                                        </div>  


                                        <!--Bill Modal -->
                                        <div class="modal fade sundry" id="resturant_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <hr class="prettyline">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="col-lg-6" style="margin-top: 0px; padding-right: 0px;">
                                                        <div class="container">
                                                            <div class="col-lg-9" style="margin-top: 30px;">
                                                                <div class="panel panel-primary">
                                                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#bill_table" placeholder="S    e    a    r    c    h          h   e   r   e   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color: #001940; text-align: center;" />
                                                                    <div class="scrollable" style="height: 300px;">
                                                                        <table class="table tab-content bill_table" id="bill_table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Reservation No</th>
                                                                                    <th>Guest Name</th>
                                                                                    <th>Arrival Date</th>
                                                                                    <th>Departure Date</th>
                                                                                    <th>No of Rooms</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody></tbody>
                                                                        </table>

                                                                    </div>
                                                                </div>


                                                                <div class="tab-content">
                                                                    <input type="hidden"  id="gest_t"  >
                                                                    <input type="hidden"  id="rt_t"  >
                                                                    <input type="hidden"  id="lc_t"  >
                                                                    <input type="hidden"  id="basic_t"  >
                                                                    <input type="hidden"  id="ro_tot"  >

                                                                    <div class="form-group ">                                        
                                                                        <label class="col-lg-2 control-label custom-label">Reservation No :</label>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="res_not" class="form-control res_no" placeholder="Reservation No" disabled="">
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                        <label class="col-lg-2 control-label custom-label">Booking No of Rooms:</label>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="b_roomt" class="form-control b_room" placeholder="Rooms" disabled="" >
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">                                        
                                                                        <label class="col-lg-2 control-label custom-label">Bill Total:</label>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="Bill_tot" class="form-control b_room" placeholder="Rooms" disabled="">
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <label class="col-lg-2 control-label custom-label">Advanced Payed : </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="add_vt" class="form-control a_room" placeholder="Rs.0.00" disabled>
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">                                        
                                                                        <label class="col-lg-2 control-label custom-label">Arriass Amount </label>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="arr_t" class="form-control a_room" placeholder="Rs.0.00" disabled>
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>                                                                                
                                                                        <label class="col-lg-2 control-label custom-label">Balance Amount : </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="bal_t" class="form-control a_room" placeholder="Rs.0.00" disabled>
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group ">                                        

                                                                        <label class="col-lg-2 control-label custom-label">Payed Amount : </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="pay_amt" class="form-control a_room" placeholder="Rs.00.00" >
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <div class="input-group col-lg-12">
                                                                                <button class="btn btn-custom-save" id="payed_btnt" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Pay Amount</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <button class="btn btn-custom-delete" id="completed_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Bill Conform</button>
                                                                            </div>
                                                                        </div>  

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="prettyline">
                                        </div>   


                                        <!--Rooms Modal -->
                                        <div class="modal fade rooms" id="resturant_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <hr class="prettyline">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="col-lg-6" style="margin-top: 0px; padding-right: 0px;">
                                                        <div class="container">
                                                            <div class="col-lg-9" style="margin-top: 30px;">
                                                                <div class="panel panel-primary">
                                                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#room_table" placeholder="S    e    a    r    c    h          h   e   r   e   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color: #001940; text-align: center;" />
                                                                    <div class="scrollable" style="height: 300px;">
                                                                        <table class="table tab-content room_table" id="room_table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Reservation No</th>
                                                                                    <th>Guest Name</th>
                                                                                    <th>Arrival Date</th>
                                                                                    <th>Departure Date</th>
                                                                                    <th>No of Rooms</th>
                                                                                    <th>Room Type</th>
                                                                                    <th>Action</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody></tbody>
                                                                        </table>

                                                                    </div>
                                                                </div>


                                                                <div class="tab-content">
                                                                    <input type="hidden"  id="gest_no"  >
                                                                    <input type="hidden"  id="r_dff"  >
                                                                    <input type="hidden"  id="rc_id"  >
                                                                    <div class="form-group ">                                        
                                                                        <label class="col-lg-2 control-label custom-label">Reservation No :</label>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="res_no" class="form-control res_no" placeholder="Reservation No" disabled="">
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <label class="col-lg-2 control-label custom-label">Room Type: </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="r_type" class="form-control r_type" placeholder="Room Type" disabled="">
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">                                        
                                                                        <label class="col-lg-2 control-label custom-label">Booking No of Rooms:</label>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="b_room" class="form-control b_room" placeholder="Rooms" disabled="">
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <label class="col-lg-2 control-label custom-label">Available No of Rooms : </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="a_room" class="form-control a_room" placeholder="Guest Origin" disabled>
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">                                        
                                                                        <label class="col-lg-2 control-label custom-label">Select Rooms:</label>
                                                                        <div class="col-lg-4">
                                                                            <!--<div class="input-group col-lg-12">-->
                                                                            <div class="col-lg-12">
                                                                                <select class="sroom_ComboBox"></select>
                                                                            </div>
                                                                            <!--</div>-->
                                                                        </div>                                                                                
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <button class="btn btn-custom-save" id="add_room_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add room</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group ">                                        

                                                                        <label class="col-lg-2 control-label custom-label">Advance : </label>           
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <input type="text"  id="adv_amt" class="form-control a_room" placeholder="Rs.00.00" >
                                                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-2">
                                                                            <div class="input-group col-lg-12">
                                                                                <button class="btn btn-custom-save" id="adp_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Pay Advance</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="input-group col-lg-12">
                                                                                <button class="btn btn-custom-delete" id="conferm_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Reservation Conform</button>
                                                                            </div>
                                                                        </div>  

                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <center>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="prettyline">
                                        </div>                    

                                        <!-- ****************************************************************************************************************************************** -->
                                        <div class="form-group">
                                            <div class="col-lg-offset-4 col-lg-10">
                                                <span  id="rm_save_div" class="">
                                                    <button class="btn btn-custom-save" id="guest_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                                </span>
                                                <span  id="agent_updateDiv" class="hidden">
                                                    <button class="btn btn-custom-save" id="guest_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                                </span>
                                                <span  id="agent_reset_div" class="">
                                                    <button class="btn btn-custom-light" id="guest_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
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
                            <button style="height: 100px; width: 230px;" id="booking_id" type="button" data-toggle="modal" data-target=".booking" class="btn btn-magick btn-lg btn3d"><span class="glyphicon glyphicon-bell"></span> Booking</button>
                            <div id="search">
                            </div>
                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;"  data-toggle="modal" data-target=".sundry" id="sundry" class="btn btn-danger btn-lg btn3d"><span class="glyphicon glyphicon-music"></span> Bill</button>
                        </div>
                        <div>
                            <button style="height: 100px; width: 230px;" id="resturant_id" type="button" data-toggle="modal" data-target=".resturant" class="btn btn-primary btn-lg btn3d"><span class="glyphicon glyphicon-briefcase"></span> Restaurant</button>
                            <div id="search">
                            </div>
                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;" id="bar_id"  data-toggle="modal" data-target=".bar" class="btn btn-success btn-lg btn3d"><span class="glyphicon glyphicon-glass"></span> Bar</button>

                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;" id="laundry"  data-toggle="modal" data-target=".laundry" class="btn btn-warning btn-lg btn3d"><span class="glyphicon glyphicon-compressed"></span> Laundry</button>
                        </div>

                        <div>
                            <button type="button" style="height: 100px; width: 230px;"  data-toggle="modal" data-target=".rooms" id="rooms" class="btn btn-magick btn-lg btn3d"><span class="glyphicon glyphicon-bookmark"></span> Rooms</button>
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
            load_agent_table();
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
        $('#guest_save_btn').click(function () {
            guest_save();
        });
        $('#price_btn').click(function () {
            room_price();
        });
        $('#guest_reset').click(function () {
            clear_guest();
        });
        //        $(document).on('click', '#guet_update_btn', function () {
        //            update_guest();
//        });



        //////////////////////////////////////////////////////////////////////
        $('#rooms').click(function () {
            //  var guest_regr = $(this).val();
            load_room_book_table();
        });
        $(document).on('click', '.select_reserv', function () {
            var gs_id = $(this).val();
            get_gestdetails(gs_id);
        });
        $(document).on('click', '#add_room_btn', function () {
            room_book();
        });
        $(document).on('click', '#adp_btn', function () {
            adv_pay();
        });
        $(document).on('click', '#conferm_save_btn', function () {
            var gid = $('#gest_no').val();
            if (gid == 0 || gid == '') {
                alert("select valid customer...!");
            } else {
                check_res();
            }
        });
        $(document).on('click', '.del_reserv', function () {
            var gid = $(this).val();
            cancle_book(gid);
        });
        /////////////////////////////////////////////////////////////////////
        $('#booking_id').click(function () {
            load_booking();
        });
        $(document).on('click', '.select_book', function () {
            var gs_id = $(this).val();
            get_gestdetail(gs_id);
        });
        $(document).on('click', '#conferm_save_btns', function () {
            var gid = $('#gest_nos').val();
            bonferm_book(gid);
        });
        $(document).on('click', '#cancel_btns', function () {
            var gid = $('#gest_nos').val();
            cancle_book(gid);
        });
        //////////////////////////////////////////////////////////////////////////////////

        $('#sundry').click(function () {
            load_bill();
        });
        $(document).on('click', '.select_bill', function () {
            var gs_id = $(this).val();
            loadg_bill(gs_id);
        });
        $(document).on('click', '#payed_btnt', function () {
            var arre = $('#arr_t').val();
            var pay = $('#pay_amt').val();
            var diff = pay - arre;
            if (diff == 0.00 || diff > 0) {
                $('#bal_t').val(diff);
            } else {
                alert("Payed Valid Ammount...!");
            }
        });
        $(document).on('click', '#completed_save_btn', function () {
            var arre = $('#arr_t').val();
            var pay = $('#pay_amt').val();
            var bill_t = $('#Bill_tot').val();
            var id = $('#gest_t').val();
            var diff = pay - arre;
            if (diff == 0.00 || diff > 0) {
                $('#bal_t').val(diff);
                bill_payed(diff, bill_t, id);
                room_reles(id);
                reservation_c(id);
                load_bill();
                //bill_print(id);
                alert("Bill Completed Success...!")
                $('#arr_t').val('0.00');
                $('#pay_amt').val('0.00');
                $('#Bill_tot').val('0.00');
                $('#gest_t').val('');
                $('#add_vt').val('0.00');
                $('#b_roomt').val('0');
                $('#res_not').val('');
            } else {
                alert("Payed Valid Ammount...!");
            }
        });
        ///////////////////////////////////////////////////////////////////////////////////////

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
        $('#bar_id').click(function () {
            var bar = $(this).val();
            load_bar_used_table(bar);
        });
        $('#laundry').click(function () {
            var guest_regr = $(this).val();
            load_laundry_used_table(guest_regr);
        });
        $('#resturant_id').click(function () {
            var restid = $(this).val();
            load_resturant_table(restid);
        });
        $('#booking_id').click(function () {
            load_room_book_table();
        });
        $('select').chosen({width: "100%"});
    </script>
</html>


<?php
require_once './include/MainConfig.php';
include './config/dbc.php';
?>
<!DOCTYPE html>
<!-- @SAMPATH WIJESINGHE -->
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
                background-color: rgba(0, 0, 0, 0.7);

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
                            <h3><b>BOOKING DETAILS</b></h3>

                        </div>

                        <div class="row">

                            <div class="form-group">

                                <div class="container">

                                    <nav class="navbar navbar-default" role="navigation">


                                        <div class="container-fluid">

                                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                                <ul class="nav navbar-nav navbar-right">
                                                    <li><a href="#search">Search</a></li>
                                                </ul>
                                            </div><!-- /.navbar-collapse -->
                                        </div><!-- /.container-fluid -->
                                    </nav>
                                </div>




                                <!-- FORM START -->
                                <div class="col-md-6">

                                    <div class="form-horizontal">
                                        <input type="hidden" id="agent_hid">

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
                                            <label class="col-lg-4 control-label custom-label">Currency: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="currency_comboBox" id="currency_comboBox">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Guest type: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="guest_type" id="guest_type">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Booking Method: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="booking_method" id="booking_method">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Customer type: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="customer_type" id="customer_type">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">                                        
                                            <label class="col-lg-4 control-label custom-label">Payment term: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <select class="payment_term" id="payment_term">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Name: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_name" class="form-control guest_name" placeholder="Guest Name">
                                                    <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Identity: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_identity" class="form-control guest_identity" placeholder="Guest Identity">
                                                    <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Guest Tel1: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_tel1" class="form-control guest_tel1" placeholder="Guest Tel1">
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
                                            <label class="col-lg-4 control-label custom-label">Address: <font color="red">*</font> </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="guest_address" class="form-control guest_address" placeholder="Address">
                                                    <div class="input-group-addon"><i class="fa fa-tag"></i></div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">arrival date: </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="arrival_date" class="form-control arrival_date" placeholder="arrival date" data-date-format="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>">
                                                    <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">arrival time: </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="arrival_time" class="form-control arrival_time" placeholder="arrival time">
                                                    <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Depature date: </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="depature_date" class="form-control depature_date" placeholder="Depature date" data-date-format="yyyy-mm-dd" value="<?php echo date("Y-m-d"); ?>">
                                                    <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-4 control-label custom-label">Depature time: </label>
                                            <div class="col-lg-6">
                                                <div class="input-group col-lg-12">

                                                    <input type="text" id="depature_time" class="form-control depature_time" placeholder="Depature time">
                                                    <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ****************************************************************************************************************************************** -->






                                        <!--Resturant Modal -->
                                        <div class="modal fade resturant" id="resturant_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <hr class="prettyline">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="col-lg-6" style="margin-top: 0px; padding-right: 0px;">
                                                        <div class="container">
                                                            <div class="col-lg-9" style="margin-top: 30px;">
                                                                <div class="panel panel-primary">
                                                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#resturant_table" placeholder="S    e    a    r    c    h          h   e   r   e   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color: #001940; text-align: center;" />
                                                                    <div class="scrollable" style="height: 450px;">
                                                                        <table class="table tab-content resturant_table" id="resturant_table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Main category name</th>
                                                                                    <th>Item name</th>
                                                                                    <th>group name</th>
                                                                                    <th>Qty</th>
                                                                                    <th>Amount</th>
                                                                                    <th>Price</th>
                                                                                    <th>Room No</th>
                                                                                    <th>Table No</th>
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


                                        <!--Sundry Modal -->
                                        <div class="modal fade sundry" id="resturant_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <hr class="prettyline">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="col-lg-6" style="margin-top: 0px; padding-right: 0px;">
                                                        <div class="container">
                                                            <div class="col-lg-9" style="margin-top: 30px;">
                                                                <div class="panel panel-primary">
                                                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#sundry_table" placeholder="S    e    a    r    c    h          h   e   r   e   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color: #001940; text-align: center;" />
                                                                    <div class="scrollable" style="height: 450px;">
                                                                        <table class="table tab-content sundry_table" id="sundry_table" >
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
                                                                    <div class="scrollable" style="height: 450px;">
                                                                        <table class="table tab-content room_table" id="room_table" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Room No</th>
                                                                                    <th>Arrival date</th>
                                                                                    <th>Arrival time</th>
                                                                                    <th>Departure date</th>
                                                                                    <th>Departure time</th>
                                                                                    <th>Adult</th>
                                                                                    <th>5 > Child</th>
                                                                                    <th>5 < child</th>
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

                                        <!-- ****************************************************************************************************************************************** -->





                                        <div class="form-group">
                                            <div class="col-lg-offset-4 col-lg-10">

                                                <span  id="agent_updateDiv" class="">
                                                    <button class="btn btn-custom-save" id="guet_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
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
                            <button style="height: 100px; width: 230px;" id="resturant_id" type="button" data-toggle="modal" data-target=".resturant" class="btn btn-primary btn-lg btn3d"><span class="glyphicon glyphicon-briefcase"></span> Restaurant</button>
                            <div id="search">
                                <button type="button" style="margin-top: 77px; margin-top: 77px;" class="close">×</button>
                                <form onsubmit="return false;">
                                    <input type="search" value="" id="search_reg_id" placeholder="type reservation number here" autocomplete="off" />
                                    <button type="button"  id="res_search"class="btn btn-primary">Search</button>
                                    <img src="http://placehold.it/300x420/FC2DE3/FFFFFF?text=Ad+space+available.+Call+0712912826" />
                                </form>
                            </div>
                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;" id="bar_id"  data-toggle="modal" data-target=".bar" class="btn btn-success btn-lg btn3d"><span class="glyphicon glyphicon-glass"></span> Bar</button>

                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;" id="laundry"  data-toggle="modal" data-target=".laundry" class="btn btn-warning btn-lg btn3d"><span class="glyphicon glyphicon-compressed"></span> Laundry</button>
                        </div>
                        <div>
                            <button type="button" style="height: 100px; width: 230px;"  data-toggle="modal" data-target=".sundry" id="sundry" class="btn btn-danger btn-lg btn3d"><span class="glyphicon glyphicon-music"></span> Sundry</button>
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
            load_agent_table();
            $('#logout').click(function () {
                logout();
            });

//*******************************combo boxes******************************* 
            guest_type_deatails();
            booking_method();
            customer_type();
            payment_terms();
            currency_combo();

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

        $('#agent_save_btn').click(function () {
            agent_save();
        });

        $(document).on('click', '#guet_update_btn', function () {
            update_guest();
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

        $('#sundry').click(function () {
            var sundry = $(this).val();
            sundry_details(sundry);
        });
        $('#bar_id').click(function () {
            var bar = $(this).val();
            load_bar_used_table(bar);
        });
        $('#laundry').click(function () {
            var guest_regr = $(this).val();
            load_laundry_used_table(guest_regr);
        });
        $('#rooms').click(function () {
            var guest_regr = $(this).val();
            load_room_used_table(guest_regr);
        });

        $('#resturant_id').click(function () {
            var restid = $(this).val();
            load_resturant_table(restid);
        });


        $('select').chosen({width: "100%"});
    </script>
</html>


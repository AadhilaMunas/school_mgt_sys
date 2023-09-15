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
    </head>
    <body class="green-back">
        <div id="wrap">
            <!--load navigation bar-->
            <?php require_once './include/navBar.php'; ?>
            <div class="container-fluid">               
                <div class="row">                                 
                    <div class="col-md-12">
                        <div class="page-header cutom-header">
                            <h3><b>Agent's Registration</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="agent_hid">

                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Agent Type: <font color="red">*</font> </label>
                                        <div class="col-lg-6">
                                            <select class="agent_type_comboBox" id="agent_type_comboBox">
                                                <option value="Online Booking Agent">Online Booking Agent</option> 
                                                <option value="Travel Agent">Travel Agent</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Agent Name: <font color="red">*</font> </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_name" class="form-control agent_name" placeholder="Agent Name">
                                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Registration No: <font color="red">*</font> </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_reg_no" class="form-control agent_reg_no" placeholder="Registration No">
                                                <div class="input-group-addon"><i class="fa fa-check"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Address: <font color="red">*</font> </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_address" class="form-control agent_address" placeholder="Address">
                                                <div class="input-group-addon"><i class="fa fa-tag"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Telephone No1: <font color="red">*</font> </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_tel_1" class="form-control agent_tel_1" placeholder="Telephone 1" onkeypress="return isNumberKey(event)" maxlength="10">
                                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>

                                            </div>
                                            <h6 id="phonecusreg" style="color: red;"></h6>
                                            <h6 id="pphone" style="color: green;"></h6>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Telephone No2: <font color="red">*</font> </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_tel_2" class="form-control agent_tel_2" placeholder="Telephone 2" onkeypress="return isNumberKey(event)" maxlength="10">
                                                <div class="input-group-addon"><i class="fa fa-mobile-phone"></i></div>
                                            </div>
                                            <h6 id="phonecusreg2" style="color: red;"></h6>
                                            <h6 id="pphone2" style="color: green;"></h6>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Fax :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_fax" class="form-control agent_fax" placeholder="Fax" maxlength="10" onkeypress="return isNumberKey(event)">
                                                <div class="input-group-addon"><i class="fa fa-keyboard-o"></i></div>
                                            </div>
                                            <h6 id="phonecusreg3" style="color: red;"></h6>
                                            <h6 id="pphone3" style="color: green;"></h6>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Website: </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_web" class="form-control agent_web" placeholder="Website">
                                                <div class="input-group-addon"><i class="fa fa-link"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group email_val">
                                        <label class="col-lg-4 control-label custom-label">Email: <font color="red">*</font> </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_email" class="form-control agent_email" placeholder="Email">
                                                <div class="input-group-addon"><i class="fa fa-google-plus"></i></div>
                                            </div>
                                            <h6 style="color: red; font-weight: bold; margin-left: 5px;" id="e_val"></h6>
                                            <h6 style="color: green; font-weight: bold; margin-left: 5px;" id="e_valok"></h6>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Contact person:  </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_con_person" class="form-control agent_con_person" placeholder="Contact person Name">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group agent_con_person_tel">
                                        <label class="col-lg-4 control-label custom-label">Contact person telephone: </label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <input type="text" id="agent_con_person_tel" class="form-control agent_con_person_tel" placeholder="telephone" onkeypress="return isNumberKey(event)" maxlength="10">
                                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            </div>
                                            <h6 id="phonecusreg4" style="color: red;"></h6>
                                            <h6 id="pphone4" style="color: green;"></h6>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="agent_save_div" class="">
                                                <button class="btn btn-custom-save" id="agent_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="agent_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="agent_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="agent_reset_div" class="">
                                                <button class="btn btn-custom-light" id="agent_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Agent Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".agent_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable agent_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Agent</th>
                                                    <th>Registration No</th>
                                                    <th>Agent Name</th>
                                                    <th>Agent Tel</th>
                                                    <th>Email</th>
<!--                                                    <th>Contact Person</th>
                                                    <th>Contact Person tel</th>-->
                                                    <th>Address</th>
                                                    <th>Action Key's:</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                                             
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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

        });
        function set_focus_next(e, next_comp) {
            e.which = e.which || e.keyCode;
            if (e.which === 13) {
                $(next_comp).focus();
            }
        }

        $('#agent_save_btn').click(function () {
            agent_save();
        });

        $('#agent_reset').click(function () {
            $('#agent_save_btn').removeClass('hidden');
            $('#pphone').html('<i class="glyphicon glyphicon-ok-sign"> No phone number entered. But you can save.! </i> ');
            $('#phonecusreg').html('');
            clear_agent();
        });

        $(document).on('click', '.edit_agent', function () {
            var edt_agent = $(this).val();
            edit_agent_details(edt_agent);
            $('#agent_updateDiv').removeClass('hidden');
            $('#agent_save_div').addClass('hidden');
        });


        $(document).on('click', '#agent_update_btn', function () {
            update_agent();
            $('#agent_updateDiv').addClass('hidden');
            $('#agent_save_div').removeClass('hidden');
        });


        $(document).on('click', '.del_agent', function () {
            var dlt_agent = $(this).val();
            delete_agent(dlt_agent);
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

        $('#agent_tel_2').on('keyup', function () {
            var phonecusregval = $(this).val().length;
            if (phonecusregval == '0' || phonecusregval == '10') {
                $('#agent_save_btn').removeClass('hidden');
                if (phonecusregval == '10') {
                    $('#phonecusreg2').html('');
                    $('#pphone2').html('<i class="glyphicon glyphicon-ok-sign"> Valid phone number</i> ');
                } else {
                    $('#phonecusreg2').html('');
                    $('#agent_save_btn').removeClass('hidden');
                    $('#pphone2').html('<i class="glyphicon glyphicon-ok-sign"> No phone number entered. But you can save.! </i> ');
                }
            } else {
                $('#agent_save_btn').addClass('hidden');
                $('#phonecusreg2').html('<i class="glyphicon glyphicon-warning-sign"></i> Sorry... Invalid Phone Number');
                $('#pphone2').html('');
            }
        });

        $('#agent_fax').on('keyup', function () {
            var phonecusregval = $(this).val().length;
            if (phonecusregval == '0' || phonecusregval == '10') {
                $('#agent_save_btn').removeClass('hidden');
                if (phonecusregval == '10') {
                    $('#phonecusreg3').html('');
                    $('#pphone3').html('<i class="glyphicon glyphicon-ok-sign"> Valid Fax number</i> ');
                } else {
                    $('#phonecusreg3').html('');
                    $('#agent_save_btn').removeClass('hidden');
                    $('#pphone3').html('<i class="glyphicon glyphicon-ok-sign"> No Fax number entered. But you can save.! </i> ');
                }
            } else {
                $('#agent_save_btn').addClass('hidden');
                $('#phonecusreg3').html('<i class="glyphicon glyphicon-warning-sign"></i> Sorry... Invalid Fax Number');
                $('#pphone3').html('');
            }
        });

        $('#agent_con_person_tel').on('keyup', function () {
            var phonecusregval = $(this).val().length;
            if (phonecusregval == '0' || phonecusregval == '10') {
                $('#agent_save_btn').removeClass('hidden');
                if (phonecusregval == '10') {
                    $('#phonecusreg4').html('');
                    $('.agent_con_person_tel').removeClass('has-error');
                    $('#pphone4').html('<i class="glyphicon glyphicon-ok-sign"> Valid phone number</i> ');
                } else {
                    $('#phonecusreg4').html('');
                    $('#agent_save_btn').removeClass('hidden');
                    $('.agent_con_person_tel').removeClass('has-error');
                    $('#pphone4').html('<i class="glyphicon glyphicon-ok-sign"> No phone number entered. But you can save.! </i> ');
                }
            } else {
                $('#agent_save_btn').addClass('hidden');
                $('#phonecusreg4').html('<i class="glyphicon glyphicon-warning-sign"></i> Sorry... Invalid Phone Number');
                $('.agent_con_person_tel').addClass('has-error');
                $('#pphone4').html('');
            }
        });


//////////E-mail Validation
        $('#agent_email').on('keyup', function () {
            if ($(this).val() !== "") {
                var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
                if (valid) {

                    $('.email_val').removeClass('has-error');
                    $('#e_val').html('');
                    $('#e_valok').html('<i class="glyphicon glyphicon-ok-sign"></i> E-Mail address is valid.');
                    $('#Branch_save_btn').removeClass('hidden');
                } else {
                    $('.email_val').addClass('has-error');
                    $('#e_valok').html('');
                    $('#e_val').html('<i class="glyphicon glyphicon-warning-sign"></i> E-Mail address is not valid.');
                    $('#Branch_save_btn').addClass('hidden');
                }

            } else {
                $('.email_val').removeClass('has-error');
                $('#e_val').html('');
                $('#e_valok').html('<i class="glyphicon glyphicon-ok-sign"></i> without E-mail you can save this. ');
                $('#Branch_save_btn').removeClass('hidden');
            }
        });


        $('select').chosen({width: "100%"});
    </script>
</html>


<?php
require_once './include/MainConfig.php';
include './config/dbc.php';
?>
<!DOCTYPE html>
<!-- @Wasantha Kumara -->
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
                            <h3>Guest selected Sundries </h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-4">
                                <div class="form-horizontal">

                                    <input type="hidden" id="sundry_g_id">
                                    <input type="hidden" id="sundry_combo">
                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Guest Type :</label>
                                        <div class="col-lg-6">
                                            <select id="select_sundry" class="guest_tp_comboBox" onkeyup="set_focus_next(event, '.sundry_bill_comboBox')" placeholder="Select Guest Type">
                                                <option value="2">------  Select Guest Type  -------</option>
                                                <option value="0">Open Guest</option>
                                                <option value="1">Guest</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Sundry Bill No :</label>
                                        <div class="col-lg-6">
                                            <select class="sundry_bill_comboBox" onkeyup="set_focus_next(event, '#room_no')"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Room No :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="room_no" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Room No:00" onkeyup="set_focus_next(event, '#tel_no')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Telephone No <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="tel_no" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Telephone no" onkeyup="set_focus_next(event, '#sun_item')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Sundry Item <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sun_item" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Sundry item" onkeyup="set_focus_next(event, '#sun_price')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Price <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sun_price" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" onkeyup="set_focus_next(event, '#sun_dis')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Discount :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sun_dis" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" onkeyup="set_focus_next(event, '#sun_total')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Total Amount <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sun_total" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" disabled="true" onkeyup="set_focus_next(event, '#sun_date')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Date <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sun_date" value="<?php echo date("Y-m-d"); ?>" class="form-control date_picker" data-date-format="yyyy-mm-dd" disabled="true" onkeyup="set_focus_next(event, '#sundry_update_btn')">                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
<!--                                            <span  id="mealprice_save_div" class="">
                                                <button class="btn btn-custom-save" id="mealprice_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>-->
                                            <span  id="mealprice_update_div" class="">
                                                <button class="btn btn-custom-save" id="sundry_update_btn" onclick="disableElements()"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="mealprice_reset_div" class="">
                                                <button class="btn btn-custom-light" id="sundry_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-8">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Guest selected Sundries Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".sundry_detail_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable sundry_detail_tbl">
                                            <thead>
                                                <tr><th>#</th>
                                                    <th>Sundry Bill No</th>
                                                    <th>Guest Type</th>
                                                    <th>Room No</th>
                                                    <th>Tel no</th>
                                                    <th>Sundry Item</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                    <th>Total Amount</th>
                                                    <th>Date</th>
                                                    <th>Action key's</th>
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
            sundry_load($('.guest_tp_comboBox').val());
            $('.guest_tp_comboBox').change(function () {
                $('#sundry_combo').val($(this).val());
                sundry_load($(this).val());
                guest_bill_comboBox();
                
            });
            $('.date_picker').datepicker();
            $('#logout').click(function () {
                logout();
            });
            $('#sundry_reset').click(function () {
                sundry_reset();
            });
            $('.sundry_bill_comboBox').change(function () {
                select_sundry($(this).val());
                $('#sun_date').removeAttr("disabled", true);
            });


            $('#sundry_update_btn').click(function () {
                sundry_update();
                $('.guest_tp_comboBox').change(function () {
                    $('#sundry_combo').val($(this).val());
                    sundry_load($(this).val());
                    guest_bill_comboBox();
                    sundry_reset();
                });

            });


        });
        function set_focus_next(e, next_comp) {
            e.which = e.which || e.keyCode;
            if (e.which === 13) {
                $(next_comp).focus();
            }
        }
        function disableElements()
        {
            document.getElementById("sun_date").disabled = true;
        }
        $('select').chosen({width: "100%"});
    </script>
</html>


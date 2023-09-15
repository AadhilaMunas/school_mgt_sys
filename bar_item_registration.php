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
                            <h3><b>Bar Item Registration</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="bar_item_reg_hid">

                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Bar Main Items <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <select class="b_main_comboBox" id="b_main_comboBox"></select>
                                        </div>
                                    </div>
                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Bar sub item <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <select class="b_sub_comboBox" id="b_sub_comboBox">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Item Code <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="bar_item_cde" class="form-control custom-text1" onkeyup="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Item Group <font color="red"></font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="bar_itm_grp" class="form-control custom-text1" onkeyup="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Unit's :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="bar_unts" class="form-control custom-text1" onkeyup="" onkeypress="return isNumberKey(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Expiry Date :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="bar_exp_date" class="form-control date_picker" onkeyup="" value="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Re order :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="barreorder" class="form-control custom-text1" onkeyup="" onkeypress="return isNumberKey(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Amount :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="bar_amount" class="form-control custom-text1" onkeyup="" onkeypress="return isNumberKey(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Capacity :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="bar_capacity" class="form-control custom-text1" onkeyup="" onkeypress="return isNumberKey(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="bar_itemreg_save_btn" class="">
                                                <button class="btn btn-custom-save" id="bar_itemreg_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="bar_itemreg_update_btn" class="hidden">
                                                <button class="btn btn-custom-save" id="bar_itemreg_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="bar_itemreg_reset" class="">
                                                <button class="btn btn-custom-light" id="bar_itemreg_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- FORM END -->
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">System Codes</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".bar_item_reg_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height:auto; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable bar_item_reg_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Main Item</th>
                                                    <th>Sub Item</th>
                                                    <th>Group</th>
                                                    <th>Units</th>
                                                    <th>Exp date</th>
                                                    <th>Reorder</th>
                                                    <th>Amount</th>
                                                    <th>Capacity</th>
                                                    <th>Action</th>
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
            $('.date_picker').datepicker();
            $('select').chosen({width: "100%"});
            $('#logout').click(function () {
                logout();
            });
            load_bar_item_reg_table();
            bar_main_comboBox(false, function () {
                bar_sub_cat_comboBox(false, $('#b_main_comboBox').val(), function () {
                });
            });
            $('#b_main_comboBox').change(function () {
                bar_sub_cat_comboBox(false, $(this).val());
            });

            $('#bar_itemreg_reset').click(function () {
                clear_bar_item_reg();
            });

            $('#bar_itemreg_save_btn').click(function () {
                bar_item_registration_save();
            });


            $('#bar_itemreg_update_btn').click(function () {
                bar_item_registration_update();
            });

            $(document).on('click', '.edit_itm_reg', function () {
                var b_item_id = $(this).val();
                edit_b_item_reg(b_item_id);
                $('#bar_itemreg_update_btn').removeClass('hidden');
                $('#bar_itemreg_save_btn').addClass('hidden');
            });

            $(document).on('click', '.del_itm_reg', function () {
                var b_item_del_id = $(this).val();
                delete_b_item_reg(b_item_del_id);

            });


        });

    </script>
</html>


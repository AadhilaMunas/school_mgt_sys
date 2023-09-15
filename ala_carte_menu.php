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
                            <h3><b>Create Menu</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="rest_item_reg_hid">
                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Restaurant Main Items <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <select class="r_main_comboBox" id="r_main_comboBox"></select>
                                        </div>
                                    </div>
                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Restaurant sub item <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <select class="r_sub_comboBox" id="r_sub_comboBox">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Item Name <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="rest_item_name" class="form-control custom-text1" onkeyup="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Item Code <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="rest_item_cde" class="form-control custom-text1" onkeyup="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Item Category group <font color="red"></font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="rest_itm_grp" class="form-control custom-text1" onkeyup="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Item Price <font color="red"> * </font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="rest_item_price" class="form-control custom-text1" onkeyup="">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="rest_itemreg_save_btn" class="">
                                                <button class="btn btn-custom-save" id="rest_itemreg_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="rest_itemreg_update_btn" class="hidden">
                                                <button class="btn btn-custom-save" id="rest_itemreg_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="rest_itemreg_reset" class="">
                                                <button class="btn btn-custom-light" id="rest_itemreg_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
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
                                        <h3 class="panel-title title-custom">Ala Carte Menu</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".rest_item_reg_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: auto; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable rest_item_reg_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Main Item</th>
                                                    <th>Sub Item</th>
                                                    <th>Item Name</th>
                                                    <th>Item Code</th>
                                                    <th>Price</th>
                                                    <th>Item Group</th>
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
            load_rest_item_reg_table();
            rest_main_comboBox(false, function () {
                rest_sub_cat_comboBox(false, $('#r_main_comboBox').val(), function () {
                });
            });
            $('#r_main_comboBox').change(function () {
                rest_sub_cat_comboBox(false, $(this).val());
            });


            $('#rest_itemreg_reset').click(function () {
                clear_rest_item_reg();
            });

            $('#rest_itemreg_save_btn').click(function () {
                rest_item_registration_save();
            });


            $('#rest_itemreg_update_btn').click(function () {
                rest_item_registration_update();
            });

            $(document).on('click', '.edit_alacart', function () {
                var alacrt_id = $(this).val();
                edit_alacart_item_reg(alacrt_id);
                $('#rest_itemreg_update_btn').removeClass('hidden');
                $('#rest_itemreg_save_btn').addClass('hidden');
            });

            $(document).on('click', '.del_alacart', function () {
                var alacrt_del = $(this).val();
                delete_alacart_item_reg(alacrt_del);
            });


        });

    </script>
</html>


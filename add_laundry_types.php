<?php
require_once './include/MainConfig.php';
include './config/dbc.php';
?>
<!DOCTYPE html>
<!-- @Cholitha -->
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
                            <h3>Laundry Types</h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="laundry_type_id">
                                    <input type="hidden" id="laundry_cloth_id">
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Cloth Category <font color="red">*</font>:</label>
                                        <div class="col-lg-6">
                                            <select id="cloth_main_cat_combo"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Cloth Item <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="laundry_cloth_itm" class="form-control custom-text1" placeholder="" onkeyup="set_focus_next(event, '#cloth_lundry_prize')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Cloth Laundry Price :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">
                                                <input type="text" id="cloth_lundry_prize" onkeypress="return isNumberKey(event)" onkeyup="set_focus_next(event, '#cloth_pres_prize')" class="form-control" value="00.00" placeholder="Rs.00.00">
                                                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Cloth Pressing Price :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">
                                                <input type="text" id="cloth_pres_prize" class="form-control" onkeyup="set_focus_next(event, '#laundry_save_btn')" onkeypress="return isNumberKey(event)" value="00.00" placeholder="Rs.00.00">
                                                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="laundry_save_div" class="">
                                                <button class="btn btn-custom-save" id="laundry_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="laundry_update_div" class="">
                                                <button class="btn btn-custom-save hidden" id="laundry_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="laundry_reset_div" class="">
                                                <button class="btn btn-custom-light" id="laundry_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Laundry Type Table</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".laundry_type_table"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable laundry_type_table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Cloth Category</th>
                                                    <th>Cloth Item</th>
                                                    <th>Laundry Price</th>
                                                    <th>Pressing Price</th>
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
            laundry_category_combo();
            laundry_types_table($('#cloth_main_cat_combo').val());
            $('#laundry_save_btn').click(function () {
                save_laundry_cloths();
            });
            $('#cloth_main_cat_combo').change(function () {
                $('#cloth_main_cat_combo').val($(this).val());
                laundry_types_table($(this).val());
            });
            $('#laundry_reset').click(function () {
                reset_laundry_form();
            });
            $('#laundry_update_btn').click(function () {
                update_laundry($('#laundry_type_id').val());
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
            document.getElementById("meal_date").disabled = true;
        }
        $('select').chosen({width: "100%"});
    </script>
</html>


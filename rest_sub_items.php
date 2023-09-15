<?php
require_once './include/MainConfig.php';
include './config/dbc.php';
?>
<!DOCTYPE html>
<!-- @Mr.Wasantha Kumara -->
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
                            <h3><b>Restaurant Sub Item</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="r_subcat_hid">

                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Restaurant Main Items <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <select class="r_main_comboBox"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Restaurant Sub Item <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="r_subcat" class="form-control custom-text1" placeholder="Restaurant Sub Item">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="restsub_save_div" class="">
                                                <button class="btn btn-custom-save" id="restsub_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="restsub_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="restsub_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="restsub_reset_div" class="">
                                                <button class="btn btn-custom-light" id="restsub_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Rest Sub Item Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".restsubitem_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable restsubitem_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Restaurant Main Item</th>
                                                    <th>Restaurant Sub Item</th>
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
            rest_main_comboBox();
            load_rest_sub_cat_table();

            $('.date_picker').datepicker();
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

        $('#restsub_save_btn').click(function () {
            rest_sub_item_save();
        });
        $('#restsub_reset').click(function () {
            clear_rest_sub_cat();
            $('#restsub_updateDiv').addClass('hidden');
            $('#restsub_save_div').removeClass('hidden');
        });


        $('#restsub_update_btn').click(function () {
            rest_sub_item_update();
        });


        $(document).on('click', '.edit_rest_subcat', function () {
            var r_subitm_id = $(this).val();
            edit_rest_sub_item(r_subitm_id);
            $('#restsub_updateDiv').removeClass('hidden');
            $('#restsub_save_div').addClass('hidden');
        });

        $(document).on('click', '.del_rest_subcat', function () {
            var del_rsubcat_id = $(this).val();
            del_rest_sub_cat(del_rsubcat_id);
            clear_rest_sub_cat();
            $('#restsub_updateDiv').addClass('hidden');
            $('#restsub_save_div').removeClass('hidden');
        });

        $('select').chosen({width: "100%"});
    </script>
</html>


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
                            <h3>Laundry Category</h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="laundry_main_cat_id">
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Laundry Category <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="laundry_main_cat" class="form-control custom-text1" onkeypress="set_focus_next(event, '#laundry_cat_save_btn')" placeholder="" onkeyup="set_focus_next(event, '#di_price')">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="laundry_main_cat_save_div" class="">
                                                <button class="btn btn-custom-save" id="laundry_cat_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="laundry_main_cat_update_div" class="">
                                                <button class="btn btn-custom-save hidden" id="laundry_cat_update_btn" ><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="laundry_main_cat_reset_div" class="">
                                                <button class="btn btn-custom-light" id="laundry_cat_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Laundry Category Table</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".laundry_main_cat_tble"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable laundry_main_cat_tble">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Laundry Category</th>
                                                    <th></th>
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
            load_laundry_main_cat_table();
            $('#laundry_cat_save_btn').click(function () {
                add_laundry_main_category($('#laundry_main_cat').val());
            });
            $('#laundry_cat_reset').click(function () {
                reset_laundry_data();
            });
            $('#laundry_cat_update_btn').click(function () {
                $('#laundry_cat_save_btn').removeClass('hidden');
                $('#laundry_cat_update_btn').addClass('hidden');
                update_laundry_main_category($('#laundry_main_cat_id').val(), $('#laundry_main_cat').val());
            });

        });
        function set_focus_next(e, next_comp) {
            e.which = e.which || e.keyCode;
            if (e.which === 13) {
                $(next_comp).focus();
            }
        }
        $('select').chosen({width: "100%"});
    </script>
</html>


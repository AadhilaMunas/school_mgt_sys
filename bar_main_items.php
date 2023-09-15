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
                            <h3><b>Bar Main Items</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="bmaincat_hid">

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Bar Main Category: <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">
                                                <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                                <input type="text" id="b_maincat" class="form-control b_maincat" placeholder="Bar Main Category">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="b_maincat_save_div" class="">
                                                <button class="btn btn-custom-save" id="b_maincat_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="b_maincat_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="b_maincat_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="b_maincat_reset_div" class="">
                                                <button class="btn btn-custom-light" id="b_maincat_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Bar Main Category Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".b_maincat_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable b_maincat_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Bar main category</th>
                                                    <th>Action Key's</th>
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
        $(function() {
            pageProtect();
            checkurl();
            load_bar_main_cat_table();
            $('#logout').click(function() {
                logout();
            });

        });
        function set_focus_next(e, next_comp) {
            e.which = e.which || e.keyCode;
            if (e.which === 13) {
                $(next_comp).focus();
            }
        }

        $('#b_maincat_save_btn').click(function() {
            bar_main_cat_save();
        });

        $('#b_maincat_reset').click(function() {
            clear_bar_main_cat();
        });

        $(document).on('click', '.edit_bar_maincat', function() {
            var edt_b_main_id = $(this).val();
            edit_bar_main_cat(edt_b_main_id);
            $('#b_maincat_save_div').addClass('hidden');
            $('#b_maincat_updateDiv').removeClass('hidden');
        });


        $('#b_maincat_update_btn').click(function() {
            update_bar_main_cat();
        });

        $(document).on('click', '.del_bar_maincat', function() {
            var dlte_bmain = $(this).val();
            delete_bmaincat(dlte_bmain);
        });

        $('select').chosen({width: "100%"});
    </script>
</html>


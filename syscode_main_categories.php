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
                            <h3><b>System code Main Categories</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="sys_mcat_id">

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">System code Main Category <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">
                                                <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                                <input type="text" id="sys_maincat" class="form-control sys_maincat" placeholder="System code Main Category">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="sys_maincat_save_div" class="">
                                                <button class="btn btn-custom-save" id="sys_mcat_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="sys_maincat_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="sys_maincat_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="sys_maincat_reset_div" class="">
                                                <button class="btn btn-custom-light" id="sys_mcat_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">System code Main Category Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".sys_maincat_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable sys_maincat_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>System code main category</th>
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
        $(function () {
            pageProtect();
            checkurl();
            load_syscode_main_cat_table();
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

        $('#sys_mcat_save_btn').click(function () {
            sys_main_cat_save();
        });

        $('#sys_mcat_reset').click(function () {
            clear_sys_main_cat();
            $('#sys_maincat_save_div').removeClass('hidden');
            $('#sys_maincat_updateDiv').addClass('hidden');
        });

        $(document).on('click', '.edit_sys_maincat', function () {
            var edt_sys_main_id = $(this).val();
            edit_sys_main_cat(edt_sys_main_id);
            $('#sys_maincat_save_div').addClass('hidden');
            $('#sys_maincat_updateDiv').removeClass('hidden');
        });


        $('#sys_maincat_update_btn').click(function () {
            update_sys_main_cat();
        });

        $(document).on('click', '.del_sys_maincat', function () {
            var dlte_sysmain = $(this).val();
            delete_sysmaincat(dlte_sysmain);
            clear_sys_main_cat();
            $('#sys_maincat_save_div').removeClass('hidden');
            $('#sys_maincat_updateDiv').addClass('hidden');
        });

        $('select').chosen({width: "100%"});
    </script>
</html>


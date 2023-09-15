<?php
require_once './include/MainConfig.php';
include './config/dbc.php';
?>
<!DOCTYPE html>
<!-- @ -->
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
                            <h3><b>Manage School Grades</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="sys_hid">
                                    <input type="hidden" id="sys_cat_hid">


                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Add Grade <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sch_grdeid" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="1" onkeyup="set_focus_next(event,)">
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="syscode_save_div" class="">
                                                <button class="btn btn-custom-save" id="schgrade_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="syscode_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="syscode_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="syscode_reset_div" class="">
                                                <button class="btn btn-custom-light" id="syscode_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
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
                                        <h3 class="panel-title title-custom">School Grades</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".syscode_info_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable syscode_info_tbl">
                                            <thead>
                                                <tr>
                                                    <th>Index</th>
                                                    <th>Grades</th>
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
            load_syscode_table($('.Type_ComboBox').val());
            pageProtect();
            checkurl();
            $('select').chosen({width: "100%"});
            $('#logout').click(function () {
                logout();
            });
            syscode_comboBox();
            $('.Type_ComboBox').change(function () {
                var type = $(this).val();
                load_syscode_table(type);
            });

            load_syscode_table($('#Type_ComboBox').val());
           
        $('#schgrade_save_btn').click(function () {
                grade_save();
            });

//            $('#syscode_save_btn').click(function () {
//                syscode_save();
//            });
            $('#syscode_reset').click(function () {
                clear_sys_code();
            });

            $('#syscode_update_btn').click(function () {
                syscode_update();
            });
            $(document).on('click', '.edit_sys', function () {
                var edt_sys = $(this).val();
                edit_sys(edt_sys);
                $('#syscode_save_div').addClass('hidden');
                $('#syscode_updateDiv').removeClass('hidden');

            });
            $(document).on('click', '.del_sys', function () {
                var dlt_sys = $(this).val();
                delete_sys(dlt_sys);
                $('#syscode_save_div').addClass('hidden');
                $('#syscode_updateDiv').removeClass('hidden');

            });

        });
        function set_focus_next(e, next_comp) {
            e.which = e.which || e.keyCode;
            if (e.which === 13) {
                $(next_comp).focus();
            }
        }

    </script>
</html>


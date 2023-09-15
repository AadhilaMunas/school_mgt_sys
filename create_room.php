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
                            <h3><b>Create Rooms</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="croom_hid">
                                      <input type="hidden" id="sys_cat_hid">

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Room No <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">
                                                <div class="input-group-addon"><i class="fa fa-weibo"></i></div>
                                                <input type="text" id="room_no" class="form-control tax_name" placeholder="Room No">
                                            </div>
                                        </div>
                                    </div>
                                    
                                     <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Select Room Category <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <select class="Type_ComboBox"></select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="rm_remrk" class="col-lg-4 control-label">Remarks :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <textarea type="text" id="rm_remrk" class="form-control"  placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="rm_save_div" class="">
                                                <button class="btn btn-custom-save" id="rm_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="rm_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="rm_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="rm_reset_div" class="">
                                                <button class="btn btn-custom-light" id="rm_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Room Number Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".rm_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable rm_tbl">
                                            <thead>
                                                <tr>
                                                    <th>Room No</th>
                                                    <th>Room Type:</th>
                                                    <th>Remarks:</th>
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
            load_create_room_table();
             roomtype_comboBox();
            $('.Type_ComboBox').change(function () {
            var type = $(this).val();
                 load_create_room_tables(type);
            });
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

        $('#rm_save_btn').click(function () {
            room_save();
        });

        $('#rm_reset').click(function () {
            clear_create_room();
        });

        $(document).on('click', '.edit_create_rm', function () {
            var edt_crm_id = $(this).val();
            edit_create_rm(edt_crm_id);
            $('#rm_updateDiv').removeClass('hidden');
            $('#rm_save_div').addClass('hidden');
        });


        $(document).on('click', '#rm_update_btn', function () {
            update_create_room_details();
            $('#rm_updateDiv').addClass('hidden');
            $('#rm_save_div').removeClass('hidden');
        });


        $(document).on('click', '.del_create_rm', function () {
            var dlt_room = $(this).val();
            delete_create_room_details(dlt_room);
        });

        $('select').chosen({width: "100%"});
    </script>
</html>


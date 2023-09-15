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
                            <h3><b>Add Extra Features to room</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="feature_hid">

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Feature: <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">
                                                <div class="input-group-addon"><i class="fa fa-road"></i></div>
                                                <input type="text" id="extra_feature" class="form-control extra_feature" placeholder="Extra Feature">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="feature_remrk" class="col-lg-4 control-label">Remarks :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">

                                                <textarea type="text" id="feature_remrk" class="form-control"  placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="feature_save_div" class="">
                                                <button class="btn btn-custom-save" id="feature_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="feature_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="feature_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="feature_reset_div" class="">
                                                <button class="btn btn-custom-light" id="feature_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Extra Feature Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".feature_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable feature_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Extra Feature:</th>
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
            load_extra_features_table();
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

        $('#feature_save_btn').click(function () {
            feature_save();
        });

        $('#feature_reset').click(function () {
            clear_extra_features();
        });

        $(document).on('click', '.edit_features_rm', function () {
            var edt_rm_fea_id = $(this).val();
            edit_room_feature_rm(edt_rm_fea_id);
            $('#feature_updateDiv').removeClass('hidden');
            $('#feature_save_div').addClass('hidden');
        });


        $(document).on('click', '#feature_update_btn', function () {
            update_room_feature_details();
            $('#feature_updateDiv').addClass('hidden');
            $('#feature_save_div').removeClass('hidden');
        });


        $(document).on('click', '.del_features_rm', function () {
            var dlt_room_features = $(this).val();
            delete_room_features(dlt_room_features);
        });

        $('select').chosen({width: "100%"});
    </script>
</html>


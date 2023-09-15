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
                            <h3><b>Currency Rates</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="crncyrate_hid">

                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Currency <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <select class="currency_comboBox"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Rate <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="currency_rate" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="00.00">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Date <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="currency_date" value="<?php echo date("Y-m-d"); ?>" class="form-control date_picker" data-date-format="yyyy-mm-dd">                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="cur_rate_save_div" class="">
                                                <button class="btn btn-custom-save" id="cur_rate_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="cur_rate_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="cur_rate_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="syscode_reset_div" class="">
                                                <button class="btn btn-custom-light" id="cur_rate_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Current Rate Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".cur_rate_info_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable cur_rate_info_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Currency</th>
                                                    <th>Currency Rate</th>
                                                    <th>Date</th>
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
            currency_combo();
            load_currency_rate_table();

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

        $('#cur_rate_save_btn').click(function () {
            curency_rate_save();
        });

        $('#cur_rate_reset').click(function () {
            clear_currency_rates();
            $('#cur_rate_updateDiv').addClass('hidden');
            $('#cur_rate_save_div').removeClass('hidden');
        });

        $('#cur_rate_update_btn').click(function () {
            curency_rate_update();
        });


        $(document).on('click', '.edit_curncy_rate', function () {
            var cur_rate_id = $(this).val();
            edit_curency_rate(cur_rate_id);
            $('#cur_rate_updateDiv').removeClass('hidden');
            $('#cur_rate_save_div').addClass('hidden');
        });

        $(document).on('click', '.del_curncy_rate', function () {
            var del_cur_rate_id = $(this).val();
            del_curency_rate(del_cur_rate_id);
            clear_currency_rates();
            $('#cur_rate_updateDiv').addClass('hidden');
            $('#cur_rate_save_div').removeClass('hidden');
        });

        $('select').chosen({width: "100%"});
    </script>
</html>


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
                            <h3>Add Medium in Class</h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">

                                    <input type="hidden" id="m_id">
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Medium <font color="red">*</font>:</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="me_type" class="form-control custom-text1" onkeypress="" placeholder="" onkeyup="set_focus_next(event, '#sh_code')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Medium Short Code <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sh_code" class="form-control custom-text1" onkeypress="" placeholder="EN">
                                        </div>
                                    </div>
                                    <!--                                                                        <div class="form-group">
                                                                                                                <label class="col-lg-4 control-label custom-label">Dinner <font color="red">*</font> :</label>
                                                                                                                <div class="col-lg-6">
                                                                                                                    <input type="text" id="di_price" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" onkeyup="set_focus_next(event, '#other_price')">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label class="col-lg-4 control-label custom-label">Other :</label>
                                                                                                                <div class="col-lg-6">
                                                                                                                    <input type="text" id="other_price" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" onkeyup="set_focus_next(event, '#mealprice_save_btn')">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label class="col-lg-4 control-label custom-label">Date <font color="red">*</font> :</label>
                                                                                                                <div class="col-lg-6">
                                                                                                                    <input type="text" id="meal_date" value="<?php echo date("Y-m-d"); ?>" class="form-control date_picker" data-date-format="yyyy-mm-dd" disabled="true">                        
                                    -->
                                    <!--                                </div>
                                                                        </div>-->

                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="mealprice_save_div" class="">
                                                <button class="btn btn-custom-save" id="mealprice_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="mealprice_update_div" class="">
                                                <button class="btn btn-custom-save hidden" id="mealprice_update_btn" onclick="disableElements()"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="mealprice_reset_div" class="">
                                                <button class="btn btn-custom-light" id="mealprice_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Medium Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".mealprice_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable medium_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Medium</th>
                                                    <th>Medium Short</th>
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
            load_medium_table();
            $('.date_picker').datepicker();
            $('#logout').click(function () {
                logout();
            });
            $('#mealprice_save_btn').click(function () {
                medium_save();
            });
            $('#mealprice_update_btn').click(function () {
                m_update();
            });
            $('#mealprice_reset').click(function () {
                medium_reset();
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


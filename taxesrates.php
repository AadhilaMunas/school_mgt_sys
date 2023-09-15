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
                            <h3><b>Taxes</b></h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <input type="hidden" id="taxes_hid">

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Name of the tax <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">
                                                <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                                <input type="text" id="tax_name" class="form-control tax_name" placeholder="Tax Name">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="brnch_phone" class="col-lg-4 control-label">Tax Rate <font color="red">*</font>:</label>
                                        <div class="col-lg-6">
                                            <div class="input-group col-lg-12">
                                                <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                                <input type="text" id="tax_rate" class="form-control" maxlength="2" placeholder="Tax Rate" onkeypress="return isNumberKey(event)">
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
                                            <span  id="tax_rate_save_div" class="">
                                                <button class="btn btn-custom-save" id="taxrate_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>
                                            <span  id="syscode_updateDiv" class="hidden">
                                                <button class="btn btn-custom-save" id="taxrate_update_btn"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="syscode_reset_div" class="">
                                                <button class="btn btn-custom-light" id="taxrate_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->
                            <div class="col-md-6">
                                <div class="panel" style="">
                                    <div class="panel-heading panel-custom">
                                        <h3 class="panel-title title-custom">Taxes Details</h3>

                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body filterTableSearch">
                                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters=".taxrate_tbl"/>
                                    </div>
                                    <div class="scrollable" style="height: 300px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover datable taxrate_tbl">
                                            <thead>
                                                <tr>
                                                    <th>Currency</th>
                                                    <th>Rate</th>
                                                    <th>Date</th>
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
            load_tax_rate_table();
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

        $('#taxrate_save_btn').click(function () {
            tax_rate_save();
        });

        $('#taxrate_reset').click(function () {
            clear_tax_rate();
        });

        $(document).on('click', '.edit_taxrate', function () {
            var edt_tx_id = $(this).val();
            edit_taxes(edt_tx_id);
            $('#syscode_updateDiv').removeClass('hidden');
            $('#tax_rate_save_div').addClass('hidden');
        });


        $(document).on('click', '#taxrate_update_btn', function () {
            update_taxes_details();
            $('#syscode_updateDiv').addClass('hidden');
            $('#tax_rate_save_div').removeClass('hidden');
        });


        $(document).on('click', '.del_taxrate', function () {
            var dlte_tx = $(this).val();
            delete_taxes(dlte_tx);
        });

        $('select').chosen({width: "100%"});
    </script>
</html>


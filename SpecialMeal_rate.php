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
                            <h3>Special Guest Meal Rates</h3>
                        </div>
                        <div class="row">
                            <!-- FORM START -->
                            <div class="col-md-6">
                                <div class="form-horizontal">

                                    <input type="hidden" id="smeal_id">
                                    <div class="form-group ">                                        
                                        <label class="col-lg-4 control-label custom-label">Reservation No :</label>
                                        <div class="col-lg-4">
                                            <select class="guest_id_comboBox"></select>
                                        </div>
                                        <span>
                                            <button class="btn btn-custom-save addcat" data-toggle="modal" data-target="#add_new_category_modal"  onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Change category</button>
                                        </span>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Breakfast <font color="red">*</font>:</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sbr_price" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" onkeyup="set_focus_next(event, '#lu_price')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Lunch <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="slu_price" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" onkeyup="set_focus_next(event, '#di_price')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Dinner <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sdi_price" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" onkeyup="set_focus_next(event, '#other_price')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Other :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="sother_price" class="form-control custom-text1" onkeypress="return isNumberKey(event);" placeholder="Rs.00.00" onkeyup="set_focus_next(event, '#mealprice_save_btn')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label custom-label">Date <font color="red">*</font> :</label>
                                        <div class="col-lg-6">
                                            <input type="text" id="spe_gu_meal_date" value="<?php echo date("Y-m-d"); ?>" class="form-control date_picker" data-date-format="yyyy-mm-dd" disabled="true">                        
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-4 col-lg-10">
<!--                                            <span  id="mealprice_save_div" class="">
                                                <button class="btn btn-custom-save" id="mealprice_save_btn" onkeyup=""><i class="fa fa-plus-square fa-lg"></i>&nbsp;Add</button>
                                            </span>-->
                                            <span  id="mealprice_update_div" class="">
                                                <button class="btn btn-custom-save" id="spemealprice_update_btn" onclick="disableElements()"><i class="fa fa-pencil fa-sm"></i>&nbsp;Update</button>                                                
                                            </span>
                                            <span  id="mealprice_reset_div" class="">
                                                <button class="btn btn-custom-light" id="smealprice_reset" onkeyup=""><i class="fa fa-refresh fa-lg"></i>&nbsp;Reset</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <br/>

                            </div><!-- end of col-->

                            <!-- model prop up-->
                            <div class="modal fade" id="add_new_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="width: 800px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Change Special Guest Meal Rates Category</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-custom" style="border: 1px solid rgba(153, 150, 153, 1);">
                                                            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="S    e    a    r    c    h          h   e   r   e   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color:#373737; text-align: center;" />
                                                            <div class="scrollable" style="height: 150px; overflow-y: auto">
                                                                <table class="table table-bordered table-striped table-hover change_tbl" id="dev-table" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th style="width: 20%;">Guest Id</th>
                                                                            <th style="width: 20%;">Reservation No</th>
                                                                            <th style="width: 40%;">Guest Name</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-custom-light" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end-->
                            <div class="col-md-6">
                                <div class="panel panel-custom" style="border: 1px solid rgba(153, 150, 153, 1);">
                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table1" placeholder=".  .  .  .  S p e c i a l   G u e s t   M e a l   P r i c e D e t a i l s   .   .   ." style="color: white; height: 40px; font-size: 16px; background-color:#373737; text-align: center;" />
                                    <div class="scrollable" style="height: 400px; overflow-y: auto">
                                        <table class="table table-bordered table-striped table-hover special_guest_meal_tbl" id="dev-table1" >
                                            <thead>
                                                <tr><th>#</th>
                                                    <th>Guest Id</th>
                                                    <!--<th>Name:</th>-->
                                                    <th>Reservation No:</th>
                                                    <th>Breakfast</th>
                                                    <th>Lunch</th>
                                                    <th>Dinner</th>
                                                    <th>Other</th>
                                                    <th>Date</th>
                                                    <th>Action key's</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
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
            spe_guest_load_mealprice_table();
            spe_guest_comboBox();
            $('.date_picker').datepicker();
            $('#logout').click(function () {
                logout();
            });
            $('.guest_id_comboBox').change(function () {
                var type = $(this).val();
                select_spe_mealprice(type);
            });

            $('.addcat').click(function () {
                change_guest_table();
            });
            $('#spemealprice_update_btn').click(function () {
                spe_mprice_update();
            });
            $('#smealprice_reset').click(function () {
                spec_mprice_reset();
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
            document.getElementById("spe_gu_meal_date").disabled = true;
        }
        $('select').chosen({width: "100%"});
        //========== select
        $('body').on('click', '.selec_guest_id', function (e) {
            $('#spe_gu_meal_date').removeAttr("disabled", true);
            select_spe_mealprice($(this).val());
        });

        //DELETE
        $('body').on('click', '.del_guest_meal_price', function (e) {
            delete_spe_mprice($(this).val());
            spec_mprice_reset();
            spe_guest_load_mealprice_table();
        });
    </script>
</html>


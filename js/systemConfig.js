function madeCheckBoxString(chkClassName, stringStoreID) {
    var ar = [];
    var es;
    var v;
    if ($(this).is(':checked')) {
        es = $(chkClassName + ':checked');
        es.each(function (index) {
            ar.push($(this).val());
        });
    } else {
        es = $(chkClassName + ':checked');
        es.each(function (index) {
            ar.push($(this).val());
        });
    }
    v = ar.join(',');
    $(stringStoreID).val(v);
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function getBaseURL() {
    var url = location.href; // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));
    if (baseURL.indexOf('http://localhost') != -1) {
// Base Url for localhost
        var url = location.href; // window.location.href;
        var pathname = location.pathname; // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);
        return baseLocalUrl + "/";
    }
    else {
// Root Url for domain name
        return baseURL + "/";
    }

}

function tableSorter(tableName) {
    $(tableName).tablesorter();
}

function delayLoading(callBack, waitingTime) {
    setTimeout(function () {
        callBack();
    }, waitingTime);
}

function submitBulkDataByPost(submitPage, submitData) {
    $('<form action="' + submitPage + '" method="POST"/>')
            .append($(submitData))
            .appendTo($(document.body))
            .submit();
}
function submitSingleDataByPost(submitPage, submitDataName, submitDataValue) {
    $('<form action="' + submitPage + '" method="POST"/>')
            .append($('<input type="hidden" name="' + submitDataName + '" value ="' + submitDataValue + '">'))
            .appendTo($(document.body))
            .submit();
}

function submitSingleDataByPostSpecial(submitPage, submitDataName1, submitDataValue1, submitDataName2, submitDataValue2) {
    $('<form action="' + submitPage + '" method="POST"/>')
            .append($('<input type="hidden" name="' + submitDataName1 + '" value ="' + submitDataValue1 + '">'))
            .append($('<input type="hidden" name="' + submitDataName2 + '" value ="' + submitDataValue2 + '">'))
            .appendTo($(document.body))
            .submit();
}

function submitSingleDataByPostNewTab(submitPage, submitDataName, submitDataValue, submitDataName2, submitDataValue2) {
    $('<form action="' + submitPage + '" method="POST"/>')
            .append($('<input type="hidden" name="' + submitDataName + '" value ="' + submitDataValue + '">'))
            .append($('<input type="hidden" name="' + submitDataName2 + '" value ="' + submitDataValue2 + '">'))
            .appendTo($(document.body))
            .submit();
}

function alertFadeOut() {
    $(".alert").delay(200).fadeOut(2000);
}

function chosenRefresh() {
    $("select").trigger("chosen:updated");
}

function timelyRedirect(url, delay) {
    setTimeout(function () {
        window.location = url;
    }, delay);
}

function refreshBootstrapSwitch() {
    $('.switch')['bootstrapSwitch']();
}

function modalShowEventCallBack(modalData, callback) {
    modalData.modal("show").on('shown.bs.modal', function () {
        callback();
    });
}

function confirmSepecial(heading, question, cancelButtonTxt, okButtonTxt, callback1, callback2) {
    var confirmModal = $('<div class="modal fade">' +
            '<div class="modal-dialog">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
            '<h4 class="modal-title">' + heading + '</h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>' + question + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelbtn">' + cancelButtonTxt + '</button>' +
            '<button type="button" class="btn btn-primary" id="okButton">' + okButtonTxt + '</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
    confirmModal.find('#okButton').click(function (event) {
        callback1();
        confirmModal.modal('hide');
    });
    confirmModal.find('#cancelbtn').click(function (event) {
        callback2();
        confirmModal.modal('hide');
    });
    confirmModal.modal('show');
}

function confirm(heading, question, cancelButtonTxt, okButtonTxt, callback) {
    var confirmModal = $('<div class="modal fade">' +
            '<div class="modal-dialog">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
            '<h4 class="modal-title">' + heading + '</h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '<p>' + question + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">' + cancelButtonTxt + '</button>' +
            '<button type="button" class="btn btn-primary" id="OkButton">' + okButtonTxt + '</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
    confirmModal.find('#OkButton').click(function (event) {
        callback();
        confirmModal.modal('hide');
    });
    confirmModal.modal('show');
}

function logout() {
    alertify.confirm("Are you sure want to log out the system", function (e) {
        if (e) {
            $.post("views/databaseViews.php", {proccess: 'logout'}, function (e) {
                timelyRedirect("dashboard.php", 0);
            });
        }
    });
}


function alertifyMsgDisplay(jsonArray, msgTime, sucess, fail) {
    $.each(jsonArray, function (index, msgData) {
        if (msgData.msgType === 1) {
            alertify.success(msgData.msg, msgTime);
            if (sucess !== undefined) {
                if (typeof sucess === 'function') {
                    sucess();
                }
            }
        } else if (msgData.msgType === 2) {
            alertify.error(msgData.msg, msgTime);
            if (fail !== undefined) {
                if (typeof sucess === 'function') {
                    fail();
                }
            }
        }
    });
}

function starterBgSlideTransition() {
    $('body').backstretch([
        "img/starterSlides/slide_04.jpg"
    ], {
        duration: 3000, fade: 1000
    });
}

// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //
// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //
// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //
// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //
// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //
// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //
// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //
// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //
// ************************** END OF SYSTEM CONFIG FUNCTIONS ************************************************************************************* //

//add currency types
function curncy_type_save(curncy_code, cur_symbol) {
    if ($("#checkboxes").is(':checked')) {
        var checkboxes = '1';
    } else {
        checkboxes = '0';
    }

    $.post("views/commenSettingView.php", {action: 'save_curncy_type', curncy_code: curncy_code, cur_symbol: cur_symbol, checkboxes: checkboxes}, function (e) {
        alertifyMsgDisplay(e, 2000);
        clear_curency_type();
        check_items();
        //samrulz
        load_curency_type_table();
    }, "json");
}

function edit_curncy_type(cur_id) {
    if (parseInt(cur_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_curncy', cur_id: cur_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#curncy_type_save_div').addClass('hidden');
                    $('#curncy_type_updateDiv').removeClass('hidden');
                    $('#curncy_code').val(qData.currency_code);
                    $('#curncy_symbol').val(qData.currency_symbol);
                    $('#curncy_id_for_update').val(qData.currency_id);
                    if (qData.currency_status == 1) {
                        $("#checkboxes").prop('checked', true);
                    } else {
                        $("#checkboxes").prop('checked', false);
                    }
                    $('#checkboxes').attr('disabled', false);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid Sub category selection", 1000);
    }
}

function update_currency_type() {
    var curncy_hid = $('#curncy_id_for_update').val();
    var curncy_code = $('#curncy_code').val();
    var curncy_symbol = $('#curncy_symbol').val();
    if ($("#checkboxes").is(':checked')) {
        var checkboxes = '1';
    } else {
        checkboxes = '0';
    }
    $.post("views/commenSettingView.php", {action: 'update_currency_type', curncy_hid: curncy_hid, curncy_code: curncy_code, curncy_symbol: curncy_symbol, checkboxes: checkboxes}, function (e) {
        alertifyMsgDisplay(e, 2000);
        load_curency_type_table();
        clear_curency_type();
        check_items();
        $('#curncy_type_updateDiv').addClass('hidden');
        $('#curncy_type_save_div').removeClass('hidden');
    }, "json");
}



function clear_curency_type() {
    $('#curncy_code').val("");
    $('#curncy_symbol').val("");
    $("#checkboxes").prop("checked", false);
}

//-----------------------School Medium Config Functions-----------------------------------
//   @Wasantha
function medium_reset() {
    $('#me_type').val('');
    $('#sh_code').val('');

    hide_mealprice_btn();
}
function show_mealprice_btn() {
    if ($('#mealprice_update_btn').hasClass('hidden')) {
        $('#mealprice_update_btn').removeClass('hidden');
    }
    if (!$('#mealprice_save_btn').hasClass('hidden')) {
        $('#mealprice_save_btn').addClass('hidden');
    }
}
function hide_mealprice_btn() {
    if (!$('#mealprice_update_btn').hasClass('hidden')) {
        $('#mealprice_update_btn').addClass('hidden');
    }
    if ($('#mealprice_save_btn').hasClass('hidden')) {
        $('#mealprice_save_btn').removeClass('hidden');
    }
}
function medium_save() {
    var me_type = $('#me_type').val();
    var sh_code = $('#sh_code').val();
    if (me_type.length !== 0) {
        $.post("views/commenSettingView.php", {action: 'add_medium', me_type: me_type, sh_code: sh_code}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_medium_table();
            medium_reset();
        }, "json");
    } else {
        alertify.error("Enter Medium Details..!", 2500)
    }
}

function m_update() {
    var m_id = $('#m_id').val();
    var m_type = $('#me_type').val();
    var m_sh = $('#sh_code').val();

    var form_data = {
        m_id: $('#m_id').val(),
        m_type: $('#me_type').val(),
        m_sh: $('#sh_code').val()
    };
    if (m_id.length !== 0) {
        $.post('views/commenSettingView.php', {action: 'm_update', form_data: form_data}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_medium_table();
            medium_reset();
            // $('#meal_date').removeAttr("disabled");
        }, 'json');
    } else {
        alertify.error("Enter valid Data", 2500)
    }
}
function spe_mprice_update() {

    var sbr_price = $('#sbr_price').val();
    var slu_price = $('#slu_price').val();
    var sdi_price = $('#sdi_price').val();
    var sother_price = $('#sother_price').val();
    var spe_gu_meal_date = $('#spe_gu_meal_date').val();
    var form_data = {
        smeal_id: $('#smeal_id').val(),
        sbr_price: $('#sbr_price').val(),
        slu_price: $('#slu_price').val(),
        sdi_price: $('#sdi_price').val(),
        sother_price: $('#sother_price').val(),
        spe_gu_meal_date: $('#spe_gu_meal_date').val()
    };
    if (smeal_id.length !== 0) {
        $.post('views/commenSettingView.php', {action: 'smprice_update', form_data: form_data}, function (e) {
            alertifyMsgDisplay(e, 2000);
            spe_guest_load_mealprice_table();
            spe_guest_comboBox();
            spec_mprice_reset();
        }, 'json');
    } else {
        alertify.error("Enter valid Data", 2500)
    }
}
function sundry_update() {

    var guest_tp_comboBox = $('.guest_tp_comboBox').val();
    var room_no = $('#room_no').val();
    var tel_no = $('#tel_no').val();
    var sun_item = $('#sun_item').val();
    var sun_price = $('#sun_price').val();
    var sun_dis = $('#sun_dis').val();
    var sun_total = $('#sun_total').val();
    var sun_date = $('#sun_date').val();
    var form_data = {
        action: 'sundy_update',
        sundry_g_id: $('#sundry_g_id').val(),
        guest_type: $('.guest_tp_comboBox').val(),
        room_no: $('#room_no').val(),
        tel_no: $('#tel_no').val(),
        sun_item: $('#sun_item').val(),
        sun_price: $('#sun_price').val(),
        sun_dis: $('#sun_dis').val(),
        sun_total: $('#sun_total').val(),
        sun_date: $('#sun_date').val(),
    };
    if ($('#sundry_g_id').val().length !== 0) {
        $.post('views/commenSettingView.php', form_data, function (e) {
            alertifyMsgDisplay(e, 2000);
            sundry_load('2');
//            $('#select_sundry').val('2');
            var select_sundry = document.querySelector('#select_sundry');
            select_sundry["2"].selected = true;
            sundry_reset();
        }, 'json');
    } else {
        alertify.error("Enter valid Data", 2500)
    }
}
function delete_medium(m_id) {

    confirm("Delete Medium Details", "Are You Sure Want To Delete This record", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_medium', m_id: m_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_medium_table();
            medium_reset();
            $('#mealprice_update_div').addClass('hidden');
            $('#mealprice_save_div').removeClass('hidden');
        }, "json");
    });
}
function delete_spe_mprice(spe_id) {

    confirm("Delete Special Guest Meal Prices", "Are You Sure Want To Delete This record", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_spe_mprice', spe_mid: spe_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
        }, "json");
    });
}
function change_meal_cat(gu_id) {

    confirm("change Special guest meal prices", "Do you want to Change Special Guest Meal Prices?", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'change_cat', gu_id: gu_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
            spec_mprice_reset();
            change_guest_table();
            spe_guest_load_mealprice_table();
        }, "json");
    });
}
function delete_sundry_id(gu_id) {

    confirm("Delete Sundry Bill", "Are You Sure Want To Delete This record", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'sundry_delete', gu_id: gu_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
        }, "json");
    });
}
function spec_mprice_reset() {
    spe_guest_comboBox('0');
//    $('.guest_id_comboBox').val('0');
    $('#sbr_price').val('');
    $('#slu_price').val('');
    $('#sdi_price').val('');
    $('#sother_price').val('');
}
function sundry_reset() {
    $('.guest_tp_comboBox').val('2');
    $('.sundry_bill_comboBox').val('0');
    chosenRefresh();
    sundry_load($('.guest_tp_comboBox').val());
    $('#room_no').val('');
    $('#tel_no').val('');
    $('#sun_item').val('');
    $('#sun_price').val('');
    $('#sun_dis').val('');
    $('#sun_total').val('');
    $('#sun_date').addAttr("disabled", true);
}
//------------------Select function of the Medium load table------------------
function select_medium(m_id) {
    if (parseInt(m_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'medium_select', m_id: m_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                show_mealprice_btn();

                $.each(e, function (index, qData) {
                    $('#m_id').val(qData.meal_id);
                    $('#me_type').val(qData.scl_mediam);
                    $('#sh_code').val(qData.scl_mediam_sh);

                });
            }
        }, "json");
    } else {
        alertify.error("Invalid Sub category selection", 1000);
    }
}
//------------------Select function of the Special Meal price load table------------------
function select_spe_mealprice(spe_id) {
    if (isNaN(parseInt(spe_id))) {
        alert('error');
        return;
    }
    if (parseInt(spe_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'spe_mprice_select', sprice_id: spe_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                show_mealprice_btn();
                $.each(e, function (index, qData) {
                    $('#smeal_id').val(qData.guest_meal_rates);
//                    $('#guest_id_comboBox').val(qData.guest_id);
                    $('#sbr_price').val(qData.guest_meal_rates_bf);
                    $('#slu_price').val(qData.guest_meal_rates_lunch);
                    $('#sdi_price').val(qData.guest_meal_rates_dnnr);
                    $('#sother_price').val(qData.guest_meal_rates_other);
                    $('#spe_gu_meal_date').val(qData.guest_meal_date);
                    spe_guest_comboBox(spe_id);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid Sub category selection", 1000);
    }
}
//------------------Select function of the Sundry details------------------
function select_sundry(guest_id) {
    if (parseInt(guest_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'select_sundry_details', guest_id: guest_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#sundry_g_id').val(qData.sundry_id);
                    guest_bill_comboBox(qData.sundry_id);
                    $('.guest_tp_comboBox').val(qData.sundry_guest_type);
                    $('#room_no').val(qData.sundry_rm_no);
                    $('#tel_no').val(qData.sundry_tel);
                    $('#sun_item').val(qData.sundry_desc);
                    $('#sun_price').val(qData.sundry_price);
                    $('#sun_dis').val(qData.sundry_discount);
                    $('#sun_total').val(qData.total);
                    $('#sun_date').val(qData.sundry_date);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid Sub category selection", 1000);
    }
}

//Add Tax Rate details
//sampath wijesinghe
function tax_rate_save() {
    var tax_name = $('#tax_name').val();
    var tax_rate = $('#tax_rate').val();
    $.post("views/commenSettingView.php", {action: 'save_tax_rate', tax_name: tax_name, tax_rate: tax_rate}, function (e) {
        alertifyMsgDisplay(e, 2000);
        load_tax_rate_table();
        clear_tax_rate();
    }, "json");
}

function clear_tax_rate() {
    $('#tax_name').val("");
    $('#tax_rate').val("");
}


//sampath wijesinghe

function edit_taxes(edt_tx_id) {
    if (parseInt(edt_tx_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_txes', edt_tx_id: edt_tx_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {

                    $('#taxes_hid').val(qData.tax_id);
                    $('#tax_name').val(qData.tax_name);
                    $('#tax_rate').val(qData.tax_rate);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function update_taxes_details() {
    var taxes_hid = $('#taxes_hid').val();
    var tax_name = $('#tax_name').val();
    var tax_rate = $('#tax_rate').val();
    $.post("views/commenSettingView.php", {action: 'update_tax_rate', taxes_hid: taxes_hid, tax_name: tax_name, tax_rate: tax_rate}, function (e) {
        alertifyMsgDisplay(e, 2000);
        load_tax_rate_table();
        clear_tax_rate();
    }, "json");
}

function delete_taxes(dlte_tx) {
    confirm("Delete Taxes", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_txes', dlte_tx: dlte_tx}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_tax_rate_table();
            clear_tax_rate();
        }, "json");
    });
}

//********** School Grades Fuction ****************

function grade_save() {
    var sysgrade = $('#sch_grdeid').val();
    if (sysgrade == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'save_grade', sysgrade: sysgrade}, function (e) {
            alertifyMsgDisplay(e, 2000);
            // load_syscode_table($('.Type_ComboBox').val());
            clear_sys_code();
        }, "json");
    }
}

function clear_sys_code() {
    $('#syscode_name').val("");
    $('#syscode_code').val("");
    $('#syscode_remarks').val("");
}

function edit_sys(edt_sys) {
    if (parseInt(edt_sys) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_syscode', edt_sys: edt_sys}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {

                    $('#sys_hid').val(qData.sys_id);
                    $('.Type_ComboBox').val(qData.sys_type);
                    $('#syscode_name').val(qData.sys_name);
                    $('#syscode_code').val(qData.sys_code);
                    $('#syscode_remarks').val(qData.sys_remarks);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function syscode_update() {
    var sys_hid = $('#sys_hid').val();
    var Type_ComboBox = $('.Type_ComboBox').val();
    var syscode_name = $('#syscode_name').val();
    var syscode_code = $('#syscode_code').val();
    var syscode_remarks = $('#syscode_remarks').val();
    if (Type_ComboBox == '' || syscode_name == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'update_syscode', sys_hid: sys_hid, Type_ComboBox: Type_ComboBox, syscode_name: syscode_name, syscode_code: syscode_code, syscode_remarks: syscode_remarks}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_syscode_table($('.Type_ComboBox').val());
            clear_sys_code();
        }, "json");
    }

}

function delete_sys(dlt_sys) {
    confirm("Delete System Codes", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_syscdes', dlt_sys: dlt_sys}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_syscode_table($('.Type_ComboBox').val());
            clear_sys_code();
        }, "json");
    });
}


function room_save() {
    var room_no = $('#room_no').val();
    var rm_remrk = $('#rm_remrk').val();
    var rm_tid = $('.Type_ComboBox').val();
    if (room_no == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'room_save', room_no: room_no, rm_remrk: rm_remrk, rm_tid: rm_tid}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_create_room_table();
            clear_create_room();
        }, "json");
    }
}


function room_price_save() {
    var room_price = $('#r_price').val();
    var rm_tid = $('.Type_ComboBox').val();
    var rm_lid = $('.living_ComboBox').val();
    var rm_bid = $('.basic_ComboBox').val();
    if (room_price == '' || room_price == '0.00') {
        alertify.error('Add Valid Room Price.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'room_price_save', room_price: room_price, rm_tid: rm_tid, rm_lid: rm_lid, rm_bid: rm_bid}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_room_price();
            clear_room_price();
        }, "json");
    }
}

function clear_create_room() {
    $('#room_no').val("");
    $('#rm_remrk').val("");
}
function clear_room_price() {
    $('#r_price').val("");
}


function edit_create_rm(edt_crm_id) {
    if (parseInt(edt_crm_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_create_room', edt_crm_id: edt_crm_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#rp_hid').val(qData.rp_aid);
                    roomtype_comboBox(qData.rm_typid);
                    livincat_comboBox(qData.rm_licid);
                    basic_comboBox(qData.rm_basic);
                    $('#r_price').val(qData.rm_price);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function update_create_room_details() {
    var croom_hid = $('#croom_hid').val();
    var room_no = $('#room_no').val();
    var rm_remrk = $('#rm_remrk').val();
    var rm_id = $('.Type_ComboBox').val();
    if (room_no == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'room_update', croom_hid: croom_hid, room_no: room_no, rm_remrk: rm_remrk, rm_id: rm_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_create_room_table();
            clear_create_room();
        }, "json");
    }
}
function update_room_price_details() {
    var hid = $('#rp_hid').val();
    var ty_id = $('.Type_ComboBox').val();
    var liv_id = $('.living_ComboBox').val();
    var basic_id = $('.basic_ComboBox').val();
    var p = $('#r_price').val();
    if (p == '' || p == '0.00') {
        alertify.error('Add Valid Price in Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'price_updete', hid: hid, ty_id: ty_id, liv_id: liv_id, basic_id: basic_id, p: p}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_room_price();
            clear_room_price();
        }, "json");
    }
}


function delete_create_room_details(dlt_room) {
    confirm("Delete created rooms", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_create_room', dlt_room: dlt_room}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_create_room_table();
            clear_create_room();
        }, "json");
    });
}

function delete_roomprice_details(dlt_room) {
    confirm("Delete Price of the Room Basic", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_room_price', dlt_room: dlt_room}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_room_price();
            clear_room_price();
        }, "json");
    });
}


function feature_save() {
    var extra_feature = $('#extra_feature').val();
    var feature_remrk = $('#feature_remrk').val();
    if (extra_feature == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'extra_feature_save', extra_feature: extra_feature, feature_remrk: feature_remrk}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_extra_features_table();
            clear_extra_features();
        }, "json");
    }
}

function clear_extra_features() {
    $('#extra_feature').val("");
    $('#feature_remrk').val("");
}

function edit_room_feature_rm(edt_rm_fea_id) {
    if (parseInt(edt_rm_fea_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_extrafeatures_room', edt_rm_fea_id: edt_rm_fea_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#feature_hid').val(qData.rm_features_id);
                    $('#extra_feature').val(qData.rm_features_name);
                    $('#feature_remrk').val(qData.rm_features_remarks);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}


function update_room_feature_details() {
    var feature_hid = $('#feature_hid').val();
    var extra_feature = $('#extra_feature').val();
    var feature_remrk = $('#feature_remrk').val();
    if (extra_feature == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'extra_feature_update', feature_hid: feature_hid, extra_feature: extra_feature, feature_remrk: feature_remrk}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_extra_features_table();
            clear_extra_features();
        }, "json");
    }
}

function delete_room_features(dlt_room_features) {
    confirm("Delete room features", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_rooms_features', dlt_room_features: dlt_room_features}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_extra_features_table();
            clear_extra_features();
        }, "json");
    });
}

function delete_curncy_type(dlt_curency_type) {
    confirm("Delete Currency", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_curency_type', dlt_curency_type: dlt_curency_type}, function (e) {
//            alert(e);
            console.log(e);
            alertifyMsgDisplay(e, 2000);
            clear_curency_type();
            //samrulz
            load_curency_type_table();
        }, "json");
    });
}


function curency_rate_save() {
    var currency_comboBox = $('.currency_comboBox').val();
    var currency_rate = $('#currency_rate').val();
    var currency_date = $('#currency_date').val();
    if (currency_comboBox == '' || currency_rate == '' || currency_date == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'currency_rate_save', currency_comboBox: currency_comboBox, currency_rate: currency_rate, currency_date: currency_date}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_currency_rate_table();
            clear_currency_rates();
        }, "json");
    }
}

function clear_currency_rates() {
    $('#currency_rate').val("");
    $('#currency_date').val("");
}


function edit_curency_rate(cur_rate_id) {
    if (parseInt(cur_rate_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_curency_rate', cur_rate_id: cur_rate_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {

                    currency_combo(qData.currency_id);
                    $('#crncyrate_hid').val(qData.currency_rate_id);
                    $('#currency_rate').val(qData.currency_rate);
                    $('#currency_date').val(qData.currency_date);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}


function curency_rate_update() {
    var crncyrate_hid = $('#crncyrate_hid').val();
    var currency_comboBox = $('.currency_comboBox').val();
    var currency_rate = $('#currency_rate').val();
    var currency_date = $('#currency_date').val();
    if (crncyrate_hid == '' || currency_comboBox == '' || currency_rate == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'currency_rate_update', crncyrate_hid: crncyrate_hid, currency_comboBox: currency_comboBox, currency_rate: currency_rate, currency_date: currency_date}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_currency_rate_table();
            clear_currency_rates();
            $('#cur_rate_updateDiv').addClass('hidden');
            $('#cur_rate_save_div').removeClass('hidden');
        }, "json");
    }
}

function del_curency_rate(dlt_curency_type) {
    confirm("Delete Currency rates", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_curency_type_details', dlt_curency_type: dlt_curency_type}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_currency_rate_table();
            //samrulz
            clear_currency_rates();
        }, "json");
    });
}



function bar_main_cat_save() {
    var b_maincat = $('#b_maincat').val();
    if (b_maincat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'bar_main_cat_save', b_maincat: b_maincat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_bar_main_cat_table();
            clear_bar_main_cat();
        }, "json");
    }
}

function clear_bar_main_cat() {
    $('#b_maincat').val("");
}
function living_cat_save() {
    var l_maincat = $('#l_maincat').val();
    if (l_maincat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'living_cat_save', l_maincat: l_maincat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_livin_cat_table();
            clear_living_cat();
        }, "json");
    }
}

function clear_living_cat() {
    $('#l_maincat').val("");
}
function basic_save() {
    var b_maincat = $('#b_maincat').val();
    if (b_maincat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'basic_save', b_maincat: b_maincat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_basic_table();
            clear_basic();
        }, "json");
    }
}

function clear_basic() {
    $('#b_maincat').val("");
}


function edit_bar_main_cat(edt_b_main_id) {
    if (parseInt(edt_b_main_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_bar_main_cat', edt_b_main_id: edt_b_main_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {

                    currency_combo(qData.currency_id);
                    $('#bmaincat_hid').val(qData.bar_main_cat_id);
                    $('#b_maincat').val(qData.bar_main_cat_name);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
function edit_lining_cat(id) {
    if (parseInt(id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_living_cat', id: id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#bmaincat_hid').val(qData.li_aid);
                    $('#l_maincat').val(qData.living_cat);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
function edit_basic(id) {
    if (parseInt(id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_basic', id: id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#bmaincat_hid').val(qData.bacis_aid);
                    $('#b_maincat').val(qData.r_basic);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}


function update_bar_main_cat() {
    var b_maincat = $('#b_maincat').val();
    var bmaincat_hid = $('#bmaincat_hid').val();
    if (b_maincat == '' || bmaincat_hid == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'bar_main_cat_update', bmaincat_hid: bmaincat_hid, b_maincat: b_maincat}, function (e) {
            $('#b_maincat_save_div').removeClass('hidden');
            $('#b_maincat_updateDiv').addClass('hidden');
            alertifyMsgDisplay(e, 2000);
            load_bar_main_cat_table();
            clear_bar_main_cat();
        }, "json");
    }
}
function update_living_cat() {
    var l_maincat = $('#l_maincat').val();
    var bmaincat_hid = $('#bmaincat_hid').val();
    if (l_maincat == '' || bmaincat_hid == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'living_cat_update', bmaincat_hid: bmaincat_hid, l_maincat: l_maincat}, function (e) {
            $('#b_maincat_save_div').removeClass('hidden');
            $('#b_maincat_updateDiv').addClass('hidden');
            alertifyMsgDisplay(e, 2000);
            load_livin_cat_table();
            clear_living_cat();
        }, "json");
    }
}
function update_basic() {
    var b_maincat = $('#b_maincat').val();
    var bmaincat_hid = $('#bmaincat_hid').val();
    if (b_maincat == '' || bmaincat_hid == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'basic_update', bmaincat_hid: bmaincat_hid, b_maincat: b_maincat}, function (e) {
            $('#b_maincat_save_div').removeClass('hidden');
            $('#b_maincat_updateDiv').addClass('hidden');
            alertifyMsgDisplay(e, 2000);
            load_basic_table();
            clear_basic();
        }, "json");
    }
}
function delete_bmaincat(dlte_bmain) {
//    sampath wijesinghe
//    bar main category delete
    confirm("Delete Bar main category", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_bmaincat_details', dlte_bmain: dlte_bmain}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_bar_main_cat_table();
            clear_bar_main_cat();
        }, "json");
    });
}

function bar_sub_item_save() {
//    sampath wijesinghe
    var b_maincats = $('.b_main_comboBox').val();
    var b_subcat = $('#b_subcat').val();
    if (b_maincats == '' || b_subcat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'bar_sub_cat_save', b_maincats: b_maincats, b_subcat: b_subcat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_bar_sub_cat_table();
            clear_bar_sub_cat();
        }, "json");
    }
}

function clear_bar_sub_cat() {
    $('#b_subcat').val("");
}


function edit_bar_sub_item(b_subitm_id) {
//    sampath wijesinghe
    if (parseInt(b_subitm_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_bar_sub_cat', b_subitm_id: b_subitm_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    bar_main_comboBox(qData.main_cat_id);
                    $('#b_subcat').val(qData.bar_sub_cat_name);
                    $('#b_subcat_hid').val(qData.bar_sub_cat_id);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function bar_sub_item_update() {
    var b_maincats = $('.b_main_comboBox').val();
    var b_subcat = $('#b_subcat').val();
    var b_subcat_hid = $('#b_subcat_hid').val();
    if (b_maincats == '' || b_subcat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'bar_sub_cat_update', b_subcat_hid: b_subcat_hid, b_maincats: b_maincats, b_subcat: b_subcat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            $('#barsub_updateDiv').addClass('hidden');
            $('#barsub_save_div').removeClass('hidden');
            load_bar_sub_cat_table();
            clear_bar_sub_cat();
        }, "json");
    }
}


function del_bar_sub_cat(del_bsubcat_id) {
    confirm("Delete Bar Sub category data", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_bar_sub_category', del_bsubcat_id: del_bsubcat_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_bar_sub_cat_table();
            clear_bar_sub_cat();
        }, "json");
    });
}
//-------------Restaurant Main cat function(Wasantha)--------------------------
function clear_rest_main_cat() {
    $('#rest_maincat').val("");
}
function rest_main_cat_save() {
    var rest_maincat = $('#rest_maincat').val();
    if (rest_maincat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'rest_main_cat_save', rest_maincat: rest_maincat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_rest_main_cat_table();
//            clear_bar_main_cat();
        }, "json");
    }
}
function clear_sys_main_cat() {
    $('#sys_maincat').val("");
}
function sys_main_cat_save() {
    var sys_maincat = $('#sys_maincat').val();
    if (sys_maincat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'sys_main_cat_save', sys_maincat: sys_maincat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_syscode_main_cat_table();
            clear_sys_main_cat();
        }, "json");
    }
}


function guest_save() {
//   guest registration
    var guest_origin = $('#guest_origin :selected').html();
    var guest_resno = $('.res_no :selected').html();
    var guest_title = $('#guest_title :selected').html();
    var guest_fname = $('#guest_fname').val();
    var guest_lname = $('#guest_lname').val();
    var guest_address = $('#guest_address').val();
    var guest_identity = $('#guest_identity').val();
    var guest_tel1 = $('#guest_tel1').val();
    var guest_tel2 = $('#guest_tel2').val();
    var guest_country = $('#guest_country').val();
    var guest_email = $('#guest_email').val();
    var arrival_date = $('#arrival_date').val();
    var depature_date = $('#depature_date').val();
    var no_guest = $('#no_guest :selected').html();
    var rcat_id = $('.Type_ComboBox').val();
    var lcat_id = $('.living_ComboBox').val();
    var rbasic_id = $('.basic_ComboBox').val();
    var no_rooms = $('#no_rooms :selected').html();
    if (guest_fname == '' || guest_lname == '' || guest_address == '' || guest_identity == '' || guest_tel1 == '' || guest_country == '' || guest_email == '' || arrival_date == '' || depature_date == '' || no_guest == '' || rcat_id == '' || lcat_id == '' || rbasic_id == '' || no_rooms == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'guest_save',
            guest_resno: guest_resno,
            guest_origin: guest_origin,
            guest_title: guest_title,
            guest_fname: guest_fname,
            guest_lname: guest_lname,
            guest_address: guest_address,
            guest_identity: guest_identity,
            guest_tel1: guest_tel1,
            guest_tel2: guest_tel2,
            guest_country: guest_country,
            guest_email: guest_email,
            arrival_date: arrival_date,
            depature_date: depature_date,
            no_guest: no_guest,
            rcat_id: rcat_id,
            lcat_id: lcat_id,
            rbasic_id: rbasic_id,
            no_rooms: no_rooms}, function (e) {
            alertifyMsgDisplay(e, 2000);
            //load_agent_table();
            clear_guest();
        }, "json");
    }
}


function clear_guest() {
    $('#guest_fname').val('');
    $('#guest_lname').val('');
    $('#guest_address').val('');
    $('#guest_identity').val('');
    $('#guest_tel1').val('');
    $('#guest_tel2').val('');
    $('#guest_country').val('');
    $('#guest_email').val('');
    $('#arrival_date').val('');
    $('#depature_date').val('');
    $('.Type_ComboBox').val('');
    $('.living_ComboBox').val('');
    $('.basic_ComboBox').val('');
    $('#tot_price').val('Rs.0.00');
    nextresavation_no();
}
function room_price() {
//   room_price
    var rcat_id = $('.Type_ComboBox').val();
    var lcat_id = $('.living_ComboBox').val();
    var rbasic_id = $('.basic_ComboBox').val();
    var no_rooms = $('#no_rooms :selected').html();
    if (parseInt(rcat_id) !== 0 && parseInt(lcat_id) !== 0 && parseInt(rbasic_id) !== 0 && parseInt(no_rooms) !== 0) {
        $.post("views/commenSettingView.php", {action: 'room_price_details', rbasic_id: rbasic_id, lcat_id: lcat_id, rcat_id: rcat_id, }, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    var r_pric = qData.rm_price;
                    var tot_price = r_pric * no_rooms;
                    $('#tot_price').val(tot_price);
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
function edit_agent_details(edt_agent) {
    if (parseInt(edt_agent) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_agent_details', edt_agent: edt_agent}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#agent_hid').val(qData.agent_id);
                    $('#agent_type_comboBox').val(qData.agent_type);
                    $('#agent_name').val(qData.agent_name);
                    $('#agent_reg_no').val(qData.agent_reg_no);
                    $('#agent_address').val(qData.agent_address);
                    $('#agent_tel_1').val(qData.agent_tel1);
                    $('#agent_tel_2').val(qData.agent_tel2);
                    $('#agent_fax').val(qData.agent_fax);
                    $('#agent_web').val(qData.agent_web);
                    $('#agent_email').val(qData.agent_email);
                    $('#agent_con_person').val(qData.agent_contact_person);
                    $('#agent_con_person_tel').val(qData.agent_contactp_tel);
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function update_agent() {
//    agent registration
//    sampath wijesinghe
    var agent_hid = $('#agent_hid').val();
    var agent_type_comboBox = $('#agent_type_comboBox :selected').html();
    var agent_name = $('#agent_name').val();
    var agent_reg_no = $('#agent_reg_no').val();
    var agent_address = $('#agent_address').val();
    var agent_tel_1 = $('#agent_tel_1').val();
    var agent_tel_2 = $('#agent_tel_2').val();
    var agent_fax = $('#agent_fax').val();
    var agent_web = $('#agent_web').val();
    var agent_email = $('#agent_email').val();
    var agent_con_person = $('#agent_con_person').val();
    var agent_con_person_tel = $('#agent_con_person_tel').val();
    if (agent_type_comboBox == '' || agent_name == '' || agent_reg_no == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'agent_update',
            agent_hid: agent_hid,
            agent_type_comboBox: agent_type_comboBox,
            agent_name: agent_name,
            agent_reg_no: agent_reg_no,
            agent_address: agent_address,
            agent_tel_1: agent_tel_1,
            agent_tel_2: agent_tel_2,
            agent_fax: agent_fax,
            agent_web: agent_web,
            agent_email: agent_email,
            agent_con_person: agent_con_person,
            agent_con_person_tel: agent_con_person_tel}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_agent_table();
            clear_agent();
        }, "json");
    }
}


function delete_agent(dlt_agent) {
    confirm("Delete Agent category data", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_agent_details', dlt_agent: dlt_agent}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_agent_table();
            clear_agent();
        }, "json");
    });
}


//-----update Restaurant Mani cat--------------
function update_rest_main_cat() {
    var rest_maincat = $('#rest_maincat').val();
    var re_mcat_id = $('#re_mcat_id').val();
    if (rest_maincat == '' || re_mcat_id == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'rest_main_cat_update', re_mcat_id: re_mcat_id, rest_maincat: rest_maincat}, function (e) {
            $('#rest_maincat_save_div').removeClass('hidden');
            $('#rest_maincat_updateDiv').addClass('hidden');
            alertifyMsgDisplay(e, 2000);
            load_rest_main_cat_table();
            clear_rest_main_cat();
        }, "json");
    }
}

//-----update System Code Mani cat--------------
function update_sys_main_cat() {
    var sys_maincat = $('#sys_maincat').val();
    var sys_mcat_id = $('#sys_mcat_id').val();
    if (sys_maincat == '' || sys_mcat_id == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'sys_main_cat_update', sys_mcat_id: sys_mcat_id, sys_maincat: sys_maincat}, function (e) {
            $('#sys_maincat_save_div').removeClass('hidden');
            $('#sys_maincat_updateDiv').addClass('hidden');
            alertifyMsgDisplay(e, 2000);
            load_syscode_main_cat_table();
            clear_sys_main_cat();
        }, "json");
    }
}


function clear_rest_sub_cat() {
    $('#r_subcat').val("");
}


function rest_sub_item_update() {
    var r_maincats = $('.r_main_comboBox').val();
    var r_subcat = $('#r_subcat').val();
    var r_subcat_hid = $('#r_subcat_hid').val();
    if (r_maincats == '' || r_subcat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'rest_sub_cat_update', r_subcat_hid: r_subcat_hid, r_maincats: r_maincats, r_subcat: r_subcat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            $('#restsub_updateDiv').addClass('hidden');
            $('#restsub_save_div').removeClass('hidden');
            load_rest_sub_cat_table();
            clear_rest_sub_cat();
        }, "json");
    }
}

//************#############************Cholitha************#############************#############

//---------------laundry category---------------------
function add_laundry_main_category(main_category) {
    $.post("views/commenSettingView.php", {action: 'laundry_main_category', main_category: main_category}, function (e) {
        alertifyMsgDisplay(e, 2000);
        reset_laundry_data();
        load_laundry_main_cat_table();
    }, "json");
}

function edit_laundry_category(main_cat_id) {
    $('#laundry_cat_save_btn').addClass('hidden');
    $('#laundry_cat_update_btn').removeClass('hidden');
    $.post("views/commenSettingView.php", {action: 'get_laundry_details', main_cat_id: main_cat_id}, function (e) {
        $.each(e, function (index, data) {
            $('#laundry_main_cat_id').val(data.laundry_maincat_id);
            $('#laundry_main_cat').val(data.laundry_maincat_name);
        });
    }, "json");
}

function update_laundry_main_category(main_cat_id, cat_name) {
    $.post("views/commenSettingView.php", {action: 'update_laundry_category', main_cat_id: main_cat_id, cat_name: cat_name}, function (e) {
        alertifyMsgDisplay(e, 2000);
        reset_laundry_data();
        load_laundry_main_cat_table();
    }, "json");
}

function delete_laundry_category(laundry_cat_id) {
    confirm("Delete laundry category", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_laundry_category', laundry_cat_id: laundry_cat_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_rest_main_cat_table();
            //           clear_bar_main_cat();
        }, "json");
    });
}
function reset_laundry_data() {
    $('#laundry_cat_save_btn').removeClass('hidden');
    $('#laundry_cat_update_btn').addClass('hidden');
    $('#laundry_main_cat').val("");
}

//-----------------------Laundry types----------------------------

function save_laundry_cloths() {
    var laundry_cloth_cat = $('#cloth_main_cat_combo').val();
    var laundry_cloth_itm = $('#laundry_cloth_itm').val();
    var cloth_lundry_prize = $('#cloth_lundry_prize').val();
    var cloth_pres_prize = $('#cloth_pres_prize').val();
    var data_array = {action: 'add_laundry_cloths', laundry_cloth_cat: laundry_cloth_cat, laundry_cloth_itm: laundry_cloth_itm,
        cloth_lundry_prize: cloth_lundry_prize, cloth_pres_prize: cloth_pres_prize};
    if (laundry_cloth_cat == 0) {
        alertify.error("Please select laundry category", 2000);
        return;
    } else if (laundry_cloth_itm.length == 0) {
        alertify.error("Please insert cloth item", 2000);
        return;
    } else if (cloth_lundry_prize.length == 0) {
        alertify.error("Please insert laundry price", 2000);
        return;
    } else if (cloth_pres_prize.length == 0) {
        alertify.error("Please insert laundry pressing price", 2000);
        return;
    }
    $.post("views/commenSettingView.php", data_array, function (e) {
        alertifyMsgDisplay(e, 2000);
        laundry_types_table(laundry_cloth_cat);
        reset_laundry_form();
    }, "json");
}

function get_laundry_types(cloth_cat_id) {
    $.post("views/commenSettingView.php", {action: 'get_laundry_types', cloth_cat_id: cloth_cat_id}, function (e) {
        $.each(e, function (index, data) {
            laundry_category_combo(data.laundry_maincat_id);
            $('#laundry_cloth_itm').val(data.cloth_item);
            $('#cloth_lundry_prize').val(data.cloth_laundry_price);
            $('#cloth_pres_prize').val(data.cloth_pressing_price);
            $('#laundry_type_id').val(data.cloth_id);
        });
    }, "json");
}

function update_laundry(laundry_id) {
    var laundry_cloth_cat = $('#cloth_main_cat_combo').val();
    var laundry_cloth_itm = $('#laundry_cloth_itm').val();
    var cloth_lundry_prize = $('#cloth_lundry_prize').val();
    var cloth_pres_prize = $('#cloth_pres_prize').val();
    if (laundry_cloth_cat == 0) {
        alertify.error("Please select laundry category", 2000);
        return;
    } else if (laundry_cloth_itm.length == 0) {
        alertify.error("Please insert cloth item", 2000);
        return;
    } else if (cloth_lundry_prize.length == 0) {
        alertify.error("Please insert laundry price", 2000);
        return;
    } else if (cloth_pres_prize.length == 0) {
        alertify.error("Please insert laundry pressing price", 2000);
        return;
    }
    var array = {action: 'update_laundry_details', laundry_id: laundry_id, laundry_cloth_cat: laundry_cloth_cat, laundry_cloth_itm: laundry_cloth_itm,
        cloth_lundry_prize: cloth_lundry_prize, cloth_pres_prize: cloth_pres_prize};
    $.post("views/commenSettingView.php", array, function (e) {
        alertifyMsgDisplay(e, 2000);
        laundry_types_table(laundry_cloth_cat);
        reset_laundry_form();
    }, "json");
}

function remove_laundry_typrs(laundry_id) {
    confirm("Delete laundry types", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'remove_laundry', laundry_id: laundry_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
            laundry_types_table($('#cloth_main_cat_combo').val());
        }, "json");
    });
}

function reset_laundry_form() {
    $('#laundry_save_btn').removeClass('hidden');
    $('#laundry_update_btn').addClass('hidden');
    laundry_category_combo('0');
    $('#laundry_cloth_itm').val('');
    $('#cloth_lundry_prize').val('00.00');
    $('#cloth_pres_prize').val('00.00');
}

function clear_bar_item_reg() {
    $('#bar_item_cde').val('');
    $('#bar_itm_grp').val('');
    $('#bar_unts').val('');
    $('#bar_exp_date').val('');
    $('#barreorder').val('');
    $('#bar_amount').val('');
    $('#bar_capacity').val('');
}
//******************************************************************************
function bar_item_registration_update() {
//    bar_item registration
//    sampath wijesinghe
    var bar_item_reg_hid = $('#bar_item_reg_hid').val();
    var b_sub_comboBox = $('#b_sub_comboBox').val();
    var bar_item_cde = $('#bar_item_cde').val();
    var bar_itm_grp = $('#bar_itm_grp').val();
    var bar_unts = $('#bar_unts').val();
    var bar_exp_date = $('#bar_exp_date').val();
    var barreorder = $('#barreorder').val();
    var bar_amount = $('#bar_amount').val();
    var bar_capacity = $('#bar_capacity').val();
    if (b_sub_comboBox == '' || bar_exp_date == '' || bar_item_cde == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'item_reg_update',
            bar_item_reg_hid: bar_item_reg_hid,
            b_sub_comboBox: b_sub_comboBox,
            bar_item_cde: bar_item_cde,
            bar_itm_grp: bar_itm_grp,
            bar_unts: bar_unts,
            bar_exp_date: bar_exp_date,
            barreorder: barreorder,
            bar_amount: bar_amount,
            bar_capacity: bar_capacity}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_bar_item_reg_table();
            clear_bar_item_reg();
        }, "json");
    }
}

function delete_b_item_reg(b_item_del_id) {
//    sampath wijesinghe
//    bar item reg delete
    confirm("Delete Bar main category", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_bar_item_reg_details', b_item_del_id: b_item_del_id}, function (e) {
            load_bar_item_reg_table();
            clear_bar_item_reg();
        }, "json");
    });
}


function del_rest_sub_cat(del_rsubcat_id) {
    confirm("Delete Restaurant Sub category data", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_rest_sub_category', del_rsubcat_id: del_rsubcat_id}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_rest_sub_cat_table();
        }, "json");
    });
}

//----edit Rest main cat fun-W**---------------
function edit_rest_main_cat(edt_r_main_id) {
    if (parseInt(edt_r_main_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_rest_main_cat', edt_r_main_id: edt_r_main_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#re_mcat_id').val(qData.rest_main_cat_id);
                    $('#rest_maincat').val(qData.rest_main_cat_name);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
//----edit SYS main cat fun-W**---------------
function edit_sys_main_cat(edt_sys_main_id) {
    if (parseInt(edit_sys_main_cat) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_sys_main_cat', edt_sys_main_id: edt_sys_main_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#sys_mcat_id').val(qData.sys_cat_aid);
                    $('#sys_maincat').val(qData.sys_category_name);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
//---Delete Main Cat Restaurant-----------
function delete_restmaincat(dlte_rmain) {
//    Mr.Wasantha Kumara **
    confirm("Delete Rest main category", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_rmaincat_details', dlte_rmain: dlte_rmain}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_rest_main_cat_table();
        }, "json");
    });
}
//---Delete Systemcode Main Cat -----------
function delete_sysmaincat(dlte_sysmain) {
//    Mr.Wasantha Kumara **
    confirm("Delete System Code main category", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_sysmaincat_details', dlte_sysmain: dlte_sysmain}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_syscode_main_cat_table();
        }, "json");
    });
}

function rest_sub_item_save() {
//    Mr.Wasantha Restaurant sub cat Save functions
    var r_maincats = $('.r_main_comboBox').val();
    var r_subcat = $('#r_subcat').val();
    if (r_maincats == '' || r_subcat == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {action: 'rest_sub_cat_save', r_maincats: r_maincats, r_subcat: r_subcat}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_rest_sub_cat_table();
            clear_rest_sub_cat();
        }, "json");
    }
}

function edit_rest_sub_item(r_subitm_id) {
    if (parseInt(r_subitm_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_rest_sub_cat', r_subitm_id: r_subitm_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    rest_main_comboBox(qData.rest_main_cat_id);
                    $('#r_subcat').val(qData.rest_item_name);
                    $('#r_subcat_hid').val(qData.rest_item_id);
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
function bar_item_registration_save() {
//    bar_item registration
//    sampath wijesinghe
    var b_sub_comboBox = $('#b_sub_comboBox').val();
    var bar_item_cde = $('#bar_item_cde').val();
    var bar_itm_grp = $('#bar_itm_grp').val();
    var bar_unts = $('#bar_unts').val();
    var bar_exp_date = $('#bar_exp_date').val();
    var barreorder = $('#barreorder').val();
    var bar_amount = $('#bar_amount').val();
    var bar_capacity = $('#bar_capacity').val();
    if (b_sub_comboBox == '' || bar_exp_date == '' || bar_item_cde == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'item_reg_save',
            b_sub_comboBox: b_sub_comboBox,
            bar_item_cde: bar_item_cde,
            bar_itm_grp: bar_itm_grp,
            bar_unts: bar_unts,
            bar_exp_date: bar_exp_date,
            barreorder: barreorder,
            bar_amount: bar_amount,
            bar_capacity: bar_capacity}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_bar_item_reg_table();
            clear_bar_item_reg();
        }, "json");
    }
}



//##################################################SAMPATH############################################################################
function edit_b_item_reg(b_item_id) {
//    sampath wijesinghe
    if (parseInt(b_item_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_bar_item_reg_details', b_item_id: b_item_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    bar_main_comboBox(qData.main_cat_id);
                    bar_sub_cat_comboBox(qData.bar_sub_cat_id, qData.main_cat_id);
                    $('#bar_item_reg_hid').val(qData.bar_item_reg_id);
                    $('#bar_item_cde').val(qData.bar_item_reg_code);
                    $('#bar_itm_grp').val(qData.bar_item_reg_group);
                    $('#bar_unts').val(qData.bar_item_reg_unit);
                    $('#bar_exp_date').val(qData.bar_item_reg_exp_date);
                    $('#barreorder').val(qData.bar_item_reg_reorder);
                    $('#bar_amount').val(qData.bar_item_reg_amount);
                    $('#bar_capacity').val(qData.bar_item_reg_capacity);
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}


function rest_item_registration_save() {
//    bar_item registration
//    sampath wijesinghe
//    var r_main_comboBox = $('#r_main_comboBox').val();
    var r_sub_comboBox = $('#r_sub_comboBox').val();
    var rest_item_name = $('#rest_item_name').val();
    var rest_item_cde = $('#rest_item_cde').val();
    var rest_itm_grp = $('#rest_itm_grp').val();
    var rest_item_price = $('#rest_item_price').val();
    if (r_sub_comboBox == '' || rest_item_name == '' || rest_item_cde == '' || rest_itm_grp == '' || rest_item_price == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'rest_item_reg_save',
            r_sub_comboBox: r_sub_comboBox,
            rest_item_name: rest_item_name,
            rest_item_cde: rest_item_cde,
            rest_itm_grp: rest_itm_grp,
            rest_item_price: rest_item_price}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_rest_item_reg_table();
            clear_rest_item_reg();
        }, "json");
    }
}


function clear_rest_item_reg() {
    $('#rest_item_name').val('');
    $('#rest_item_cde').val('');
    $('#rest_itm_grp').val('');
    $('#rest_item_price').val('');
}


function edit_alacart_item_reg(alacrt_id) {
//    sampath wijesinghe
    if (parseInt(alacrt_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'edit_rest_item_reg_details', alacrt_id: alacrt_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    rest_main_comboBox(qData.rest_main_cat_id);
                    rest_sub_cat_comboBox(qData.rest_item_id, qData.rest_main_cat_id);
                    $('#rest_item_reg_hid').val(qData.ala_carte_id);
                    $('#rest_item_cde').val(qData.ala_carte_code);
                    $('#rest_itm_grp').val(qData.ala_carte_cat_group);
                    $('#rest_item_name').val(qData.ala_carte_item_name);
                    $('#rest_item_price').val(qData.ala_carte_price);
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function rest_item_registration_update() {
//    bar_item registration
//    sampath wijesinghe
//    var r_main_comboBox = $('#r_main_comboBox').val();
    var rest_item_reg_hid = $('#rest_item_reg_hid').val();
    var r_sub_comboBox = $('#r_sub_comboBox').val();
    var rest_item_name = $('#rest_item_name').val();
    var rest_item_cde = $('#rest_item_cde').val();
    var rest_itm_grp = $('#rest_itm_grp').val();
    var rest_item_price = $('#rest_item_price').val();
    if (r_sub_comboBox == '' || rest_item_name == '' || rest_item_cde == '' || rest_itm_grp == '' || rest_item_price == '' || rest_item_reg_hid == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'rest_item_reg_update',
            r_sub_comboBox: r_sub_comboBox,
            rest_item_name: rest_item_name,
            rest_item_cde: rest_item_cde,
            rest_itm_grp: rest_itm_grp,
            rest_item_price: rest_item_price,
            rest_item_reg_hid: rest_item_reg_hid}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_rest_item_reg_table();
            clear_rest_item_reg();
            $('#rest_itemreg_update_btn').addClass('hidden');
            $('#rest_itemreg_save_btn').removeClass('hidden');
        }, "json");
    }
}

function delete_alacart_item_reg(dlte_alacart) {
//   sampath wijesinghe
    confirm("Delete Items", "Are you sure want to detele this", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'delete_alacrt_details', dlte_alacart: dlte_alacart}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_rest_item_reg_table();
            clear_rest_item_reg();
        }, "json");
    });
}


function search_for_reservation_number(reg_id) {

    $('#reservation_no').html('Reservation No:' + reg_id);
    if (parseInt(reg_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'get_data_related_to_reg_id', reg_id: reg_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $('.res_no').val(e.reservation_no);
                $('#gest_hid').val(e.guest_id);
                $('#guest_fname').val(e.guset_fname);
                $('#guest_lname').val(e.guset_lname);
                $('#guest_address').val(e.guest_address);
                $('#guest_identity').val(e.guest_identity);
                $('#guest_tel1').val(e.guest_tel1);
                $('#guest_tel2').val(e.guest_tel2);
                $('#guest_country').val(e.guest_country);
                $('#guest_email').val(e.guest_email);
                $('#arrival_date').val(e.guest_arrival_date);
                $('#depature_date').val(e.guest_departure_date);
                $('#no_guest').val(e.no_of_visits);
                $('#no_rooms').val(e.no_rooms);
                $('#guest_origin').val(e.guest_origin);
                $('#guest_title').val(e.guest_title);
                roomtype_comboBox(e.guest_room_cat_id);
                livincat_comboBox(e.guest_room_livin_id);
                basic_comboBox(e.guest_basic_id);
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function update_guest() {
    var guest_hidden = $('#gest_hid').val();
    var guest_fname = $('#guest_fname').val();
    var guest_lname = $('#guest_lname').val();
    var guest_add = $('#guest_address').val();
    var guest_id = $('#guest_identity').val();
    var guest_t1 = $('#guest_tel1').val();
    var guest_t2 = $('#guest_tel2').val();
    var guest_country = $('#guest_country').val();
    var guest_email = $('#guest_email').val();
    var guest_ardate = $('#arrival_date').val();
    var guest_ddate = $('#depature_date').val();
    var guest_no = $('#no_guest').val();
    var guest_nor = $('#no_rooms').val();
    var rcat_id = $('.Type_ComboBox').val();
    var lcat_id = $('.living_ComboBox').val();
    var rbasic_id = $('.basic_ComboBox').val();
    if (parseInt(guest_hidden) !== 0 || guest_hidden == '') {
        $.post("views/commenSettingView.php", {action: 'update_guest_reg_details', guest_hidden: guest_hidden, rcat_id: rcat_id, lcat_id: lcat_id, rbasic_id: rbasic_id, guest_fname: guest_fname, guest_lname: guest_lname, guest_add: guest_add, guest_id: guest_id, guest_t1: guest_t1, guest_t2: guest_t2, guest_country: guest_country, guest_email: guest_email, guest_ardate: guest_ardate, guest_ddate: guest_ddate, guest_no: guest_no, guest_nor: guest_nor}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                alertify.success("Successfuly Updated", 1000);
                clear_guest_reg();
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function clear_guest_reg() {
    $('#guest_fname').val('');
    $('#guest_lname').val('');
    $('#guest_address').val('');
    $('#guest_identity').val('');
    $('#guest_tel1').val('');
    $('#guest_tel2').val('');
    $('#guest_country').val('');
    $('#guest_email').val('');
    $('#arrival_date').val('');
    $('#depature_date').val('');
    $('#no_guest').val('');
    $('#no_rooms').val('');
    $('#guest_origin').val('');
    $('#guest_title').val('');
}


function sundry_details(sundry) {
    var tableData = '';
    if (parseInt(sundry) !== 0) {
        $.post("views/commenSettingView.php", {action: 'sundry_details', sundry: sundry}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    index++;
                    tableData += '<tr>';
                    tableData += '<td width="5%">' + index + '</td>';
                    tableData += '<td width="10%">' + qData.sundry_rm_no + '</td>';
                    tableData += '<td width="20%">' + qData.sundry_date + '</td>';
                    tableData += '<td width="20%">' + qData.sundry_time + '</td>';
                    tableData += '<td width="20%">' + qData.sundry_price + '</td>';
                    tableData += '<td width="20%">' + qData.sundry_discount + '</td>';
                    tableData += '<td width="20%">' + qData.sundry_desc + '</td>';
                    tableData += '<td width="30%">' + qData.sundry_tel + '</td>';
                    tableData += '</tr>';
                });
                $('.sundry_table tbody').html(tableData);
                tableSorter('.sundry_table');
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
function get_gestdetails(id) {
    if (parseInt(id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'getcus_details', id: id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#res_no').val(qData.reservation_no);
                    $('#r_type').val(qData.sys_name);
                    $('#b_room').val(qData.no_rooms);
                    $('#a_room').val(qData.noroom);
                    $('#gest_no').val(qData.guest_id);
                    $('#rc_id').val(qData.guest_room_cat_id);
                    av_rooms_combo(false, qData.guest_room_cat_id);
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function get_gestdetail(id) {
    if (parseInt(id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'getcus_details', id: id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#res_nos').val(qData.reservation_no);
                    $('#r_types').val(qData.sys_name);
                    $('#b_rooms').val(qData.no_rooms);
                    $('#a_rooms').val(qData.noroom);
                    $('#gest_nos').val(qData.guest_id);
                    $('#rc_ids').val(qData.guest_room_cat_id);
                    $('#adv_amts').val(qData.gust_advance);
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function loadg_bill(id) {
    if (parseInt(id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'gest_details', id: id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#res_not').val(qData.reservation_no);
                    $('#b_roomt').val(qData.no_rooms);
                    $('#add_vt').val(qData.gust_advance);
                    $('#Bill_tot').val(qData.tot_roomponly);
                    $('#arr_t').val(qData.arrs_amt);
                    $('#bal_t').val('Rs.0.00');
                    $('#gest_t').val(qData.guest_id);
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function bill_payed(diff, bill_t, id) {
    if (diff == 0 || diff > 0 && id > 0) {
        $.post("views/commenSettingView.php", {action: 'bill_pay', bill_t: bill_t, id: id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function room_reles(id) {
    if (id > 0) {
        $.post("views/commenSettingView.php", {action: 'reless_room', id: id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
function reservation_c(id) {
    if (id > 0) {
        $.post("views/commenSettingView.php", {action: 'completed_reservation', id: id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    chosenRefresh();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}
function bill_print(id) {
    confirm("Complete Hotel Bill", "Are you sure want to Complete this bill", "No", "Yes", function () {

        setTimeout(function () {
            submitSingleDataByPost("bill.php", "id", id);
        }, 200)

    });
}



function room_book() {
//   room_booking

    var room_id = $('.sroom_ComboBox').val();
    var ges_id = $('#gest_no').val();
    var r_cid = $('#rc_id').val();
    if (room_id == '' || ges_id == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'room_book',
            room_id: room_id,
            ges_id: ges_id,
        }, function (e) {
            alertifyMsgDisplay(e, 2000);
            u_room(room_id, ges_id);
            av_rooms_combo(false, r_cid);
        }, "json");
    }
}
function u_room(room_id, ges_id) {
//   room_booking

    if (room_id == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'u_room_book',
            room_id: room_id,
            ges_id: ges_id,
        }, function (e) {
            alertifyMsgDisplay(e, 2000);
        }, "json");
    }
}
function adv_pay() {
//   room_booking
    var g_id = $('#gest_no').val();
    var adv_amt = $('#adv_amt').val();
    if (g_id == '' || adv_amt == '' || adv_amt == '0.00') {
        alertify.error('Add valid Advance Amount in the Field...!', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'adv_pay',
            g_id: g_id, adv_amt: adv_amt,
        }, function (e) {
            alertifyMsgDisplay(e, 2000);
        }, "json");
    }
}
function check_res() {
    var g_id = $('#gest_no').val();
    if (parseInt(g_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'con_ck', g_id: g_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#gest_no').val(qData.guest_id);
                    $('#r_dff').val(qData.diff_room);
                    chosenRefresh();
                    con_res();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}

function bonferm_book(g_id) {
    if (parseInt(g_id) !== 0) {
        $.post("views/commenSettingView.php", {action: 'con_book', g_id: g_id}, function (e) {
            if (e === undefined || e.length === 0 || e === null) {
                alertify.error("No Data Found", 1000);
            } else {
                $.each(e, function (index, qData) {
                    $('#res_nos').val('');
                    $('#r_types').val('');
                    $('#b_rooms').val('');
                    $('#a_rooms').val('');
                    $('#adv_amts').val('');
                    chosenRefresh();
                    load_booking();
                });
            }
        }, "json");
    } else {
        alertify.error("Invalid selection", 1000);
    }
}


function con_res() {
    var g_id = $('#gest_no').val();
    var rr = $('#r_dff').val();
//   room_booking
    if (rr > 0) {
        alertify.error('PleaseCompleted Request number of Rooms on this Customer...!', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'con_res',
            g_id: g_id,
        }, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_room_book_table();
            $('#gest_no').val('');
            $('#res_no').val('');
            $('#r_type').val('');
            $('#b_room').val('');
            $('#a_room').val('');
            $('#adv_amt').val('0.00');
        }, "json");
    }
}
function online_guest_save() {
//   online_guest registration
    var guest_origin = $('#guest_origin :selected').html();
    var guest_resno = $('.res_no :selected').html();
    var guest_title = $('#guest_title :selected').html();
    var guest_fname = $('#guest_fname').val();
    var guest_lname = $('#guest_lname').val();
    var guest_address = $('#guest_address').val();
    var guest_identity = $('#guest_identity').val();
    var guest_tel1 = $('#guest_tel1').val();
    var guest_tel2 = $('#guest_tel2').val();
    var guest_country = $('#guest_country').val();
    var guest_email = $('#guest_email').val();
    var arrival_date = $('#arrival_date').val();
    var depature_date = $('#depature_date').val();
    var no_guest = $('#no_guest :selected').html();
    var rcat_id = $('.Type_ComboBox').val();
    var lcat_id = $('.living_ComboBox').val();
    var rbasic_id = $('.basic_ComboBox').val();
    var no_rooms = $('#no_rooms :selected').html();
    if (guest_fname == '' || guest_lname == '' || guest_address == '' || guest_identity == '' || guest_tel1 == '' || guest_country == '' || guest_email == '' || arrival_date == '' || depature_date == '' || no_guest == '' || rcat_id == '' || lcat_id == '' || rbasic_id == '' || no_rooms == '') {
        alertify.error('Fill All Required Fields.', 1000);
    } else {
        $.post("views/commenSettingView.php", {
            action: 'online_guest_save',
            guest_resno: guest_resno,
            guest_origin: guest_origin,
            guest_title: guest_title,
            guest_fname: guest_fname,
            guest_lname: guest_lname,
            guest_address: guest_address,
            guest_identity: guest_identity,
            guest_tel1: guest_tel1,
            guest_tel2: guest_tel2,
            guest_country: guest_country,
            guest_email: guest_email,
            arrival_date: arrival_date,
            depature_date: depature_date,
            no_guest: no_guest,
            rcat_id: rcat_id,
            lcat_id: lcat_id,
            rbasic_id: rbasic_id,
            no_rooms: no_rooms}, function (e) {
            alertifyMsgDisplay(e, 2000);
            //load_agent_table();
            clear_guest();
        }, "json");
    }
}
function cancle_book(gid) {
    confirm("Cancle Reservation", "Are you sure want to Cancle this Resarvation", "No", "Yes", function () {
        $.post("views/commenSettingView.php", {action: 'cancle_book', gid: gid}, function (e) {
            alertifyMsgDisplay(e, 2000);
            load_booking();
            load_room_book_table();
        }, "json");
    });
}
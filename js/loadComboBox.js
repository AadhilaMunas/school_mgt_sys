
function currency_combo(selected, callBack) {
// developed by viraj
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'currency_combo'}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.currency_id)) {
                        comboData += '<option value="' + qData.currency_id + '" selected>' + qData.currency_code + ' - ' + qData.currency_symbol + '</option>';
                    } else {
                        comboData += '<option value="' + qData.currency_id + '">' + qData.currency_code + ' - ' + qData.currency_symbol + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.currency_id + '">' + qData.currency_code + ' - ' + qData.currency_symbol + '</option>';
                }
            });
        }
        $('.currency_comboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}



//set edit
function bar_main_comboBox(selected, callBack) {
// sampath wijesinghe
// bar category combo box
//2015.12.09
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'bar_main_combox'}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.bar_main_cat_id)) {
                        comboData += '<option value="' + qData.bar_main_cat_id + '" selected>' + qData.bar_main_cat_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.bar_main_cat_id + '">' + qData.bar_main_cat_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.bar_main_cat_id + '">' + qData.bar_main_cat_name + '</option>';
                }
            });
        }
        $('.b_main_comboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}
function rest_main_comboBox(selected, callBack) {
// Mr.Wasantha kumara
// restaurant category combo box
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'rest_main_combox'}, function (e) {
//        comboData += '<option value="0"> -- Select Main Items -- </option>';
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.rest_main_cat_id)) {
                        comboData += '<option value="' + qData.rest_main_cat_id + '" selected>' + qData.rest_main_cat_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.rest_main_cat_id + '">' + qData.rest_main_cat_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.rest_main_cat_id + '">' + qData.rest_main_cat_name + '</option>';
                }
            });
        }
        $('.r_main_comboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}

function syscode_comboBox(selected, callBack) {
// Mr.Wasantha kumara
// Syscode combo box
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'syscode_combox'}, function (e) {
        comboData += '<option value="0"> -- Select System code Main Category -- </option>';
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.sys_cat_aid)) {
                        comboData += '<option value="' + qData.sys_cat_aid + '" selected>' + qData.sys_category_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.sys_cat_aid + '">' + qData.sys_category_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.sys_cat_aid + '">' + qData.sys_category_name + '</option>';
                }
            });
        }
        $('.Type_ComboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}


function roomtype_comboBox(selected, callBack) {
// Mr.Wasantha kumara
// Syscode combo box
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'roomtyp_combox'}, function (e) {
        comboData += '<option value="0"> -- Select Room Category -- </option>';
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.sys_id)) {
                        comboData += '<option value="' + qData.sys_id + '" selected>' + qData.sys_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.sys_id + '">' + qData.sys_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.sys_id + '">' + qData.sys_name + '</option>';
                }
            });
        }
        $('.Type_ComboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}

function livincat_comboBox(selected, callBack) {
// Mr.Wasantha kumara
// Syscode combo box
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'livicat_combox'}, function (e) {
        comboData += '<option value="0"> -- Select Living Category -- </option>';
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.li_aid)) {
                        comboData += '<option value="' + qData.li_aid + '" selected>' + qData.living_cat + '</option>';
                    } else {
                        comboData += '<option value="' + qData.li_aid + '">' + qData.living_cat + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.li_aid + '">' + qData.living_cat + '</option>';
                }
            });
        }
        $('.living_ComboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}

function basic_comboBox(selected, callBack) {
// Mr.Wasantha kumara
// Syscode combo box
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'basic_combox'}, function (e) {
        comboData += '<option value="0"> -- Select Room Basic -- </option>';
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.bacis_aid)) {
                        comboData += '<option value="' + qData.bacis_aid + '" selected>' + qData.r_basic + '</option>';
                    } else {
                        comboData += '<option value="' + qData.bacis_aid + '">' + qData.r_basic + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.bacis_aid + '">' + qData.r_basic + '</option>';
                }
            });
        }
        $('.basic_ComboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}
function spe_guest_comboBox(selected, callBack) {
// Mr.Wasantha kumara
// Special Guest Meal price combo function
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'spe_guest_id_meal_rate'}, function (e) {
        comboData += '<option value="0"> -- Reservation No to Date  -- </option>';
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.guest_meal_rates)) {
                        console.log(selected);
                        comboData += '<option value="' + qData.guest_meal_rates + '" selected>' + qData.guest_id + "-" + "Date" + "-" + qData.guest_meal_date + '</option>';
                    } else {
                        comboData += '<option value="' + qData.guest_meal_rates + '">' + qData.reservation_no + "-" + "Date" + "-" + qData.guest_meal_date + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.guest_meal_rates + '">' + qData.guest_id + '</option>';
                }
            });
        }
        $('.guest_id_comboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}

function guest_bill_comboBox(selected, callBack) {
// Mr.Wasantha kumara
// Sundry Guest Type selecting
    var comboData = '';
    var guest_type = $('#sundry_combo').val();
    $.post("views/loadComboBox.php", {comboBox: 'sundry_bill_no', guest_type: guest_type}, function (e) {
        comboData += '<option value="0"> -- Select Sundry Bill No  -- </option>';
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="2"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.sundry_id)) {
                        comboData += '<option value="' + qData.sundry_id + '" selected>' + qData.sundry_id + '</option>';
                    } else {
                        comboData += '<option value="' + qData.sundry_id + '">' + qData.sundry_id + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.sundry_id + '">' + qData.sundry_id + '</option>';
                }
            });
        }
        $('.sundry_bill_comboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}


function laundry_category_combo(selected, callBack) {
// developed by cholitha
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'laundry_category_combo'}, function (e) {
        comboData += '<option value="0"> -- Select Cloth Category -- </option>';
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.laundry_maincat_id)) {
                        comboData += '<option value="' + qData.laundry_maincat_id + '" selected>' + qData.laundry_maincat_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.laundry_maincat_id + '">' + qData.laundry_maincat_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.laundry_maincat_id + '">' + qData.laundry_maincat_name + '</option>';
                }
            });
        }
        $('#cloth_main_cat_combo').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}


function bar_sub_cat_comboBox(selected, bsubct, callBack) {

// sampath wijesinghe
// bar sub category combo box
//2015.12.11
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'bar_sub_cat_combox', bsubct: bsubct}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.bar_sub_cat_id)) {
                        comboData += '<option value="' + qData.bar_sub_cat_id + '" selected>' + qData.bar_sub_cat_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.bar_sub_cat_id + '">' + qData.bar_sub_cat_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.bar_sub_cat_id + '">' + qData.bar_sub_cat_name + '</option>';
                }
            });
        }
        $('.b_sub_comboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}


function rest_sub_cat_comboBox(selected, rsubct, callBack) {

// sampath wijesinghe
// bar sub category combo box
//2015.12.11
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'rest_sub_cat_combox', rubct: rsubct}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.rest_item_id)) {
                        comboData += '<option value="' + qData.rest_item_id + '" selected>' + qData.rest_item_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.rest_item_id + '">' + qData.rest_item_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.rest_item_id + '">' + qData.rest_item_name + '</option>';
                }
            });
        }
        $('.r_sub_comboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}


function guest_type_deatails(selected, callBack) {
// sampath wijesinghe
// sysytem code function
//2015.12.18
    var code = '1';
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'system_code_deatails_combo', code: code}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.sys_name)) {
                        comboData += '<option value="' + qData.sys_name + '" selected>' + qData.sys_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.sys_name + '">' + qData.sys_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.sys_name + '">' + qData.sys_name + '</option>';
                }
            });
        }
        $('.guest_type').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}

function booking_method(selected, callBack) {
// sampath wijesinghe
// sysytem code function
//2015.12.18
    var code = '2';
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'system_code_deatails_combo', code: code}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.sys_name)) {
                        comboData += '<option value="' + qData.sys_name + '" selected>' + qData.sys_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.sys_name + '">' + qData.sys_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.sys_name + '">' + qData.sys_name + '</option>';
                }
            });
        }
        $('.booking_method').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}
function customer_type(selected, callBack) {
// sampath wijesinghe
// sysytem code function
//2015.12.18
    var code = '3';
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'system_code_deatails_combo', code: code}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.sys_name)) {
                        comboData += '<option value="' + qData.sys_name + '" selected>' + qData.sys_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.sys_name + '">' + qData.sys_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.sys_name + '">' + qData.sys_name + '</option>';
                }
            });
        }
        $('.customer_type').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}
function payment_terms(selected, callBack) {
// sampath wijesinghe
// sysytem code function
//2015.12.18
    var code = '4';
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'system_code_deatails_combo', code: code}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.sys_name)) {
                        comboData += '<option value="' + qData.sys_name + '" selected>' + qData.sys_name + '</option>';
                    } else {
                        comboData += '<option value="' + qData.sys_name + '">' + qData.sys_name + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.sys_name + '">' + qData.sys_name + '</option>';
                }
            });
        }
        $('.payment_term').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}
function nextresavation_no(selected, callBack) {
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'res_no'}, function (e) {
        
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.rno)) {
                        comboData += '<option value="' + qData.rno + '" selected>' + qData.nres + '</option>';
                    } else {
                        comboData += '<option value="' + qData.rno + '">' + qData.nres + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.rno + '">' + qData.nres + '</option>';
                }
            });
        $('.res_no').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}
function av_rooms_combo(selected,r_id ,callBack) {
    var comboData = '';
    $.post("views/loadComboBox.php", {comboBox: 'available_r_combo', r_id:r_id}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            comboData += '<option value="0"> -- No Data Found -- </option>';
        } else {
            $.each(e, function (index, qData) {
                if (selected !== undefined || e !== null || e.length !== 0) {
                    if (parseInt(selected) === parseInt(qData.create_rm_id)) {
                        comboData += '<option value="' + qData.create_rm_id + '" selected>' + qData.create_rm_no + '</option>';
                    } else {
                        comboData += '<option value="' + qData.create_rm_id + '">' + qData.create_rm_no + '</option>';
                    }
                } else {
                    comboData += '<option value="' + qData.create_rm_id + '">' + qData.create_rm_no + '</option>';
                }
            });
        }
        $('.sroom_ComboBox').html(comboData);
        chosenRefresh();
        if (callBack !== undefined) {
            if (typeof callBack === 'function') {
                callBack();
            }
        }
    }, "json");
}
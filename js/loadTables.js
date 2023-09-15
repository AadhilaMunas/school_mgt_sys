function load_curency_type_table() {
//@cholitha 
    var tableData = '';
    $.post("views/loadTables.php", {table: "curency_type_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="3" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.curncy_type_table tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                if (qData.currency_status == 1) {
                    var checked = 'Enable'
                } else {
                    checked = 'Disable'
                }
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + qData.currency_code + '</td>';
                tableData += '<td width="35%">' + qData.currency_symbol + '</td>';
                tableData += '<td width="35%">' + checked + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_curency_type" value="' + qData.currency_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit</button><button class="btn btn-custom-light del_curency_type" value="' + qData.currency_id + '"><i class="fa fa-trash-o fa-lg"></i>Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.curncy_type_table tbody').html('').append(tableData);
            tableSorter('.curncy_type_table');
            // TABLE ACTION BUTTONS
            //UPDATE
            $('.edit_curency_type').click(function () {
                edit_curncy_type($(this).val());
            });
            //DELETE
            $('.del_curency_type').click(function () {
                delete_curncy_type($(this).val());
                clear_curency_type();
                $('#curncy_type_updateDiv').addClass('hidden');
                $('#curncy_type_save_div').removeClass('hidden');
            });
        }
    }, "json");
}

//-----------Meal Price Load table function------------------------
// @Wasantha
function load_medium_table() {
    var tableData = '';
    $.post("views/loadTables.php", {table: "medium"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="2" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.medium_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.scl_mediam + '</td>';
                tableData += '<td width="35%">' + qData.scl_mediam_sh + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save selec_price" value="' + qData.scl_medi_aid + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_mprice" value="' + qData.scl_medi_aid + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>'
                // tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save selec_price" value="' + qData.meal_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit</button><button class="btn btn-custom-light del_mprice" value="' + qData.meal_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.medium_tbl tbody').html('').append(tableData);
            tableSorter('.medium_tbl');
            // TABLE ACTION BUTTONS
            //UPDATE
            $('.selec_price').click(function () {
                select_medium($(this).val());
            });
            //DELETE
            $('.del_mprice').click(function () {
                delete_medium($(this).val());
                medium_reset();
            });
        }
    }, "json");
}

function load_tax_rate_table() {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "tax_rate_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="3" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.taxrate_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + qData.tax_name + '</td>';
                tableData += '<td width="35%">' + qData.tax_rate + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_taxrate" value="' + qData.tax_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit</button><button class="btn btn-custom-light del_taxrate" value="' + qData.tax_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.taxrate_tbl tbody').html('').append(tableData);
            tableSorter('.taxrate_tbl');
        }
    }, "json");
}

function load_syscode_table(sys_cat_id) {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "syscode_table", sys_cat_id: sys_cat_id}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.syscode_info_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + qData.sys_name + '</td>';
                tableData += '<td width="35%">' + qData.sys_code + '</td>';
                tableData += '<td width="35%">' + qData.sys_remarks + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_sys" value="' + qData.sys_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_sys" value="' + qData.sys_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.syscode_info_tbl tbody').html('').append(tableData);
            tableSorter('.syscode_info_tbl');
        }

    }, "json");
}
function load_room_price() {
    var tableData = '';
    $.post("views/loadTables.php", {table: "room_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.rm_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + qData.sys_name + '</td>';
                tableData += '<td width="35%">' + qData.living_cat + '</td>';
                tableData += '<td width="35%">' + qData.r_basic + '</td>';
                tableData += '<td width="35%">' + qData.rm_price + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_create_rm" value="' + qData.rp_aid + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_create_rm" value="' + qData.rp_aid + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.rm_tbl tbody').html('').append(tableData);
            tableSorter('.rm_tbl');
        }
    }, "json");
}
function load_create_room_table() {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "room_save_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.rm_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + qData.create_rm_no + '</td>';
                tableData += '<td width="35%">' + qData.sys_name + '</td>';
                tableData += '<td width="35%">' + qData.create_rm_desc + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_create_rm" value="' + qData.create_rm_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_create_rm" value="' + qData.create_rm_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.rm_tbl tbody').html('').append(tableData);
            tableSorter('.rm_tbl');
        }
    }, "json");
}
function load_create_room_tables(id) {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "room_save_tables", id: id}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.rm_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + qData.create_rm_no + '</td>';
                tableData += '<td width="35%">' + qData.sys_name + '</td>';
                tableData += '<td width="35%">' + qData.create_rm_desc + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_create_rm" value="' + qData.create_rm_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_create_rm" value="' + qData.create_rm_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.rm_tbl tbody').html('').append(tableData);
            tableSorter('.rm_tbl');
        }
    }, "json");
}


function load_extra_features_table() {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "extra_features_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.feature_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.rm_features_name + '</td>';
                tableData += '<td width="35%">' + qData.rm_features_remarks + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_features_rm" value="' + qData.rm_features_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_features_rm" value="' + qData.rm_features_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.feature_tbl tbody').html('').append(tableData);
            tableSorter('.feature_tbl');
        }
    }, "json");
}

function load_currency_rate_table() {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_currency_rate_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.feature_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.currency_code + '-' + qData.currency_symbol + '</td>';
                tableData += '<td width="35%">' + qData.currency_rate + '</td>';
                tableData += '<td width="35%">' + qData.currency_date + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_curncy_rate" value="' + qData.currency_rate_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_curncy_rate" value="' + qData.currency_rate_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.cur_rate_info_tbl tbody').html('').append(tableData);
            tableSorter('.cur_rate_info_tbl');
        }
    }, "json");
}


function load_bar_main_cat_table() {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_bar_main_cat_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.b_maincat_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.bar_main_cat_name + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_bar_maincat" value="' + qData.bar_main_cat_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_bar_maincat" value="' + qData.bar_main_cat_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.b_maincat_tbl tbody').html('').append(tableData);
            tableSorter('.b_maincat_tbl');
        }
    }, "json");
}
function load_livin_cat_table() {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_living_cat_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.b_maincat_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.living_cat + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_bar_maincat" value="' + qData.li_aid + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button></div></td>';
                tableData += '</tr>';
            });
            $('.b_maincat_tbl tbody').html('').append(tableData);
            tableSorter('.b_maincat_tbl');
        }
    }, "json");
}
function load_basic_table() {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_basic_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.b_maincat_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.r_basic + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_bar_maincat" value="' + qData.bacis_aid + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button></div></td>';
                tableData += '</tr>';
            });
            $('.b_maincat_tbl tbody').html('').append(tableData);
            tableSorter('.b_maincat_tbl');
        }
    }, "json");
}


function load_bar_sub_cat_table() {
//sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_bar_sub_cat_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.barsubitem_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.bar_main_cat_name + '</td>';
                tableData += '<td width="35%">' + qData.bar_sub_cat_name + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_bar_subcat" value="' + qData.bar_sub_cat_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_bar_subcat" value="' + qData.bar_sub_cat_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.barsubitem_tbl tbody').html('').append(tableData);
            tableSorter('.barsubitem_tbl');
        }
    }, "json");
}


function load_rest_main_cat_table() {
//Wasantha **
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_rest_main_cat_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.rest_maincat_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.rest_main_cat_name + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_rest_maincat" value="' + qData.rest_main_cat_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_rest_maincat" value="' + qData.rest_main_cat_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.rest_maincat_tbl tbody').html('').append(tableData);
            tableSorter('.rest_maincat_tbl');
        }
    }, "json");
}
function load_syscode_main_cat_table() {
//Wasantha **
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_sysc_main_cat_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.sys_maincat_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.sys_category_name + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_sys_maincat" value="' + qData.sys_cat_aid + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_sys_maincat" value="' + qData.sys_cat_aid + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.sys_maincat_tbl tbody').html('').append(tableData);
            tableSorter('.sys_maincat_tbl');
        }
    }, "json");
}
function laundry_types_table(laundry_cat_id) {
//Cholitha **
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_laundry_types_table", laundry_cat_id: laundry_cat_id}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="6" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.laundry_type_table tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.laundry_maincat_name + '</td>';
                tableData += '<td width="35%">' + qData.cloth_item + '</td>';
                tableData += '<td width="35%">' + qData.cloth_laundry_price + '</td>';
                tableData += '<td width="35%">' + qData.cloth_pressing_price + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_laundry_type" value="' + qData.cloth_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_laundry_type" value="' + qData.cloth_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.laundry_type_table tbody').html('').append(tableData);
            tableSorter('.laundry_type_table');
            $('.edit_laundry_type').click(function () {
                $('#laundry_save_btn').addClass('hidden');
                $('#laundry_update_btn').removeClass('hidden');
                get_laundry_types($(this).val());
            });
            $('.del_laundry_type').click(function () {
                remove_laundry_typrs($(this).val());
            });
        }
    }, "json");
}

function load_agent_table() {
    //sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_agent_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.agent_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
//                var agent = ({
//                    "1": "Online Booking Agent",
//                    "2": "Travel Agent"
//                })[qData.agent_type];

                tableData += '<td width="35%">' + qData.agent_type + '</td>';
                tableData += '<td width="35%">' + qData.agent_reg_no + '</td>';
                tableData += '<td width="35%">' + qData.agent_name + '</td>';
                tableData += '<td width="35%">' + qData.agent_tel1 + '</td>';
                tableData += '<td width="35%">' + qData.agent_email + '</td>';
//                tableData += '<td width="35%">' + qData.agent_contact_person + '</td>';
//                tableData += '<td width="35%">' + qData.agent_contactp_tel + '</td>';
                tableData += '<td width="35%">' + qData.agent_address + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_agent" value="' + qData.agent_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_agent" value="' + qData.agent_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.agent_tbl tbody').html('').append(tableData);
            tableSorter('.agent_tbl');
        }
    }, "json");
}
function load_rest_sub_cat_table() {
//---Mr.Wasantha Kumara  **----------
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_rest_sub_cat_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="5" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.restsubitem_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td>' + index + '</td>';
                tableData += '<td width="35%">' + qData.rest_main_cat_name + '</td>';
                tableData += '<td width="35%">' + qData.rest_item_name + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_rest_subcat" value="' + qData.rest_item_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_rest_subcat" value="' + qData.rest_item_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.restsubitem_tbl tbody').html('').append(tableData);
            tableSorter('.restsubitem_tbl');
        }
    }, "json");
}
//----------------------Special guest meal price table functions--------------------------------
// Mr.Wasantha
function spe_guest_load_mealprice_table() {
    var tableData = '';
    $.post("views/loadTables.php", {table: "spe_guest_mealprice"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="2" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="8%">' + index + '</td>';
                tableData += '<td width="15%">' + qData.guest_id + '</td>';
//                tableData += '<td width="15%">' + qData.guset_name + '</td>';
                tableData += '<td width="15%">' + qData.reservation_no + '</td>';
                tableData += '<td width="35%">' + "Rs." + qData.guest_meal_rates_bf + '</td>';
                tableData += '<td width="35%">' + "Rs." + qData.guest_meal_rates_lunch + '</td>';
                tableData += '<td width="35%">' + "Rs." + qData.guest_meal_rates_dnnr + '</td>';
                tableData += '<td width="35%">' + "Rs." + qData.guest_meal_rates_other + '</td>';
                tableData += '<td width="35%">' + qData.guest_meal_date + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save selec_guest_id" value="' + qData.guest_meal_rates + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_guest_meal_price" value="' + qData.guest_meal_rates + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>'
                tableData += '</tr>';
            });
        }
        $('.special_guest_meal_tbl tbody').html(tableData);
    }, "json");
}

function change_guest_table() {
    var tableData = '';
    $.post("views/loadTables.php", {table: "change_meal_guest"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="2" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.change_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {

                index++;
                tableData += '<tr>';
                tableData += '<td width="10%">' + index + '</td>';
                tableData += '<td width="25%">' + qData.guest_id + '</td>';
                tableData += '<td width="25%">' + qData.reservation_no + '</td>';
                tableData += '<td width="50%">' + qData.guset_name + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-light del_guest_meal_cat" value="' + qData.guest_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>'
                tableData += '</tr>';
            });
            $('.change_tbl tbody').html('').append(tableData);
            tableSorter('.change_tbl');
            $('.del_guest_meal_cat').click(function () {
                change_meal_cat($(this).val());

            });
        }
    }, "json");
}
// Mr.Wasantha
function sundry_load(guest_type) {
    var tableData = '';
    $.post("views/loadTables.php", {table: "sundry_detail", guest_type: guest_type}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="2" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.sundry_detail_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.sundry_id + '</td>';
                if (qData.sundry_guest_type == '0') {
                    tableData += '<td width="35%">' + 'Open Guest' + '</td>';
                } else {
                    tableData += '<td width="35%">' + 'Guest' + '</td>';
                }
                tableData += '<td width="35%">' + qData.sundry_rm_no + '</td>';
                tableData += '<td width="35%">' + qData.sundry_tel + '</td>';
                tableData += '<td width="35%">' + qData.sundry_desc + '</td>';
                tableData += '<td width="35%">' + 'Rs.' + qData.sundry_price + '</td>';
                tableData += '<td width="35%">' + 'Rs.' + qData.sundry_discount + '</td>';
                tableData += '<td width="35%">' + 'Rs.' + qData.amount + '</td>';
                tableData += '<td width="35%">' + qData.sundry_date + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save selec_guest" value="' + qData.sundry_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_sundry" value="' + qData.sundry_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>'
                tableData += '</tr>';
            });
            $('.sundry_detail_tbl tbody').html('').append(tableData);
            tableSorter('.sundry_detail_tbl');
            // TABLE ACTION BUTTONS
            //UPDATE
            $('.selec_guest').click(function () {
                $('#sun_date').removeAttr("disabled", true);
                select_sundry($(this).val());
            });
            //DELETE
            $('.del_sundry').click(function () {
                delete_sundry_id($(this).val());
                sundry_reset();
            });
        }
    }, "json");
}
//---------------------------------Mr.Wasantha Aria Don't Touch ok--------------------------------------------------
function load_laundry_main_cat_table() {
//@cholitha 
    var tableData = '';
    $.post("views/loadTables.php", {table: "laundry_category_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="2" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.laundry_main_cat_tble tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td>' + index + '</td>';
                tableData += '<td width="35%">' + qData.laundry_maincat_name + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_laundry_category" value="' + qData.laundry_maincat_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit</button><button class="btn btn-custom-light delete_laundry_category" value="' + qData.laundry_maincat_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.laundry_main_cat_tble tbody').html('').append(tableData);
            tableSorter('.curncy_type_table');
            // TABLE ACTION BUTTONS
            //UPDATE
            $('.edit_laundry_category').click(function () {
                edit_laundry_category($(this).val());
            });
            //DELETE
            $('.delete_laundry_category').click(function () {
                delete_laundry_category($(this).val());
            });
        }
    }, "json");
}


function load_bar_item_reg_table() {
    //sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_bar_item_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="10" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.bar_item_reg_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="35%">' + index + '</td>';
                tableData += '<td width="35%">' + qData.bar_main_cat_name + '</td>';
                tableData += '<td width="35%">' + qData.bar_sub_cat_name + '</td>';
                tableData += '<td width="35%">' + qData.bar_item_reg_code + '</td>';
                tableData += '<td width="35%">' + qData.bar_item_reg_unit + '</td>';
                tableData += '<td width="35%">' + qData.bar_item_reg_exp_date + '</td>';
                tableData += '<td width="35%">' + qData.bar_item_reg_reorder + '</td>';
                tableData += '<td width="35%">' + qData.bar_item_reg_amount + '</td>';
                tableData += '<td width="35%">' + qData.bar_item_reg_capacity + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_itm_reg" value="' + qData.bar_item_reg_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_itm_reg" value="' + qData.bar_item_reg_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.bar_item_reg_tbl tbody').html('').append(tableData);
            tableSorter('.bar_item_reg_tbl');
        }
    }, "json");
}


function load_rest_item_reg_table() {
    //sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_rest_item_table"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="10" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.rest_item_reg_tbl tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="5%">' + index + '</td>';
                tableData += '<td width="30%">' + qData.rest_main_cat_name + '</td>';
                tableData += '<td width="30%">' + qData.rest_item_name + '</td>';
                tableData += '<td width="30%">' + qData.ala_carte_item_name + '</td>';
                tableData += '<td width="30%">' + qData.ala_carte_code + '</td>';
                tableData += '<td width="30%">' + qData.ala_carte_price + '</td>';
                tableData += '<td width="30%">' + qData.ala_carte_cat_group + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save edit_alacart" value="' + qData.ala_carte_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Edit &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_alacart" value="' + qData.ala_carte_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';
                tableData += '</tr>';
            });
            $('.rest_item_reg_tbl tbody').html('').append(tableData);
            tableSorter('.rest_item_reg_tbl');
        }
    }, "json");
}

function load_bar_used_table(guest_reg) {
    //sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_bar_used_table", guest_reg: guest_reg}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="10" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.bar_table tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="5%">' + index + '</td>';
                tableData += '<td width="30%">' + qData.bar_main_cat_name + '</td>';
                tableData += '<td width="30%">' + qData.bar_sub_cat_name + '</td>';
                tableData += '<td width="30%">' + qData.bar_item_reg_code + '</td>';
                tableData += '<td width="30%">' + qData.bar_qty + '</td>';
                tableData += '<td width="30%">' + qData.bar_amount + '</td>';

            });
            $('.bar_table tbody').html('').append(tableData);
            tableSorter('.bar_table');
        }
    }, "json");
}


function load_laundry_used_table(guest_regl) {
    //sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_laundry_used_table", guest_regl: guest_regl}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="15" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.laundry_table tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="5%">' + index + '</td>';
                tableData += '<td width="30%">' + qData.laundry_rm_no + '</td>';
                tableData += '<td width="30%">' + qData.laundry_date + '</td>';
                tableData += '<td width="30%">' + qData.laundry_time + '</td>';
                tableData += '<td width="30%">' + qData.laundry_maincat_name + '</td>';
                tableData += '<td width="30%">' + qData.cloth_item + '</td>';
                tableData += '<td width="30%">' + qData.laundry_item_delivery_date + '</td>';
                tableData += '<td width="30%">' + qData.laundry_item_delivery_time + '</td>';
                tableData += '<td width="30%">' + qData.laundry_item_price + '</td>';
                tableData += '<td width="30%">' + qData.laundry_item_qty + '</td>';
                tableData += '<td width="30%">' + qData.laundry_tel + '</td>';
                tableData += '<td width="30%">' + qData.cloth_laundry_price + '</td>';
                tableData += '<td width="30%">' + qData.cloth_pressing_price + '</td>';

                tableData += '<td width="30%">' + qData.bar_amount + '</td>';

            });
            $('.laundry_table tbody').html('').append(tableData);
            tableSorter('.bar_table');
        }
    }, "json");
}

function load_room_book_table(guest_regr) {
    //sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_room_book_table", guest_regr: guest_regr}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="10" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.room_table tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="5%">' + index + '</td>';
                tableData += '<td width="30%">' + qData.reservation_no + '</td>';
                tableData += '<td width="30%">' + qData.g_name + '</td>';
                tableData += '<td width="30%">' + qData.guest_arrival_date + '</td>';
                tableData += '<td width="30%">' + qData.guest_departure_date + '</td>';
                tableData += '<td width="30%">' + qData.no_rooms + '</td>';
                tableData += '<td width="30%">' + qData.sys_name + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save select_reserv" value="' + qData.guest_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Add &nbsp;&nbsp;&nbsp;&nbsp;</button><button class="btn btn-custom-light del_reserv" value="' + qData.guest_id + '"><i class="fa fa-trash-o fa-lg"></i>&nbsp;Delete</button></div></td>';

            });
            $('.room_table tbody').html('').append(tableData);
            tableSorter('.room_table');
        }
    }, "json");
}

function load_resturant_table(rest_id) {
    //sam_rulz
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_resturants_table", rest_id: rest_id}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="10" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.resturant_table tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="5%">' + index + '</td>';
                tableData += '<td width="30%">' + qData.rest_main_cat_name + '</td>';
                tableData += '<td width="30%">' + qData.rest_item_name + '</td>';
                tableData += '<td width="30%">' + qData.ala_carte_item_name + '</td>';
                tableData += '<td width="30%">' + qData.rest_item_qty + '</td>';
                tableData += '<td width="30%">' + qData.rest_item_amnt + '</td>';
                tableData += '<td width="30%">' + qData.ala_carte_price + '</td>';
                tableData += '<td width="30%">' + qData.rest_room_no + '</td>';
                tableData += '<td width="30%">' + qData.rest_tbl_no + '</td>';

            });
            $('.resturant_table tbody').html('').append(tableData);
            tableSorter('.bar_table');
        }
    }, "json");
}

function load_booking() {
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_booking"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="10" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.room_table tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="5%">' + index + '</td>';
                tableData += '<td width="30%">' + qData.reservation_no + '</td>';
                tableData += '<td width="30%">' + qData.g_name + '</td>';
                tableData += '<td width="30%">' + qData.guest_country + '</td>';
                tableData += '<td width="30%">' + qData.guest_tel1 + '</td>';
                tableData += '<td width="30%">' + qData.guest_email + '</td>';
                tableData += '<td width="30%">' + qData.guest_arrival_date + '</td>';
                tableData += '<td width="30%">' + qData.guest_departure_date + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save select_book" value="' + qData.guest_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Add &nbsp;&nbsp;&nbsp;&nbsp;</button></div></td>';

            });
            $('.room_book tbody').html('').append(tableData);
            tableSorter('.room_book');
        }
    }, "json");
}
function load_bill() {
    var tableData = '';
    $.post("views/loadTables.php", {table: "load_bill"}, function (e) {
        if (e === undefined || e.length === 0 || e === null) {
            tableData += '<tr><th colspan="10" class="alert alert-warning text-center"> -- No Data Found -- </th></tr>';
            $('.bill_table tbody').html('').append(tableData);
        } else {
            $.each(e, function (index, qData) {
                index++;
                tableData += '<tr>';
                tableData += '<td width="5%">' + index + '</td>';
                tableData += '<td width="30%">' + qData.reservation_no + '</td>';
                tableData += '<td width="30%">' + qData.gst_name + '</td>';
                tableData += '<td width="30%">' + qData.guest_arrival_date + '</td>';
                tableData += '<td width="30%">' + qData.guest_departure_date + '</td>';
                tableData += '<td width="30%">' + qData.no_rooms + '</td>';
                tableData += '<td width="50%"><div class="btn-group"><button class="btn btn-custom-save select_bill" value="' + qData.guest_id + '"><i class="fa fa-pencil fa-sm"></i>&nbsp;Add &nbsp;&nbsp;&nbsp;&nbsp;</button></div></td>';

            });
            $('.bill_table tbody').html('').append(tableData);
            tableSorter('.bill_table');
        }
    }, "json");
}
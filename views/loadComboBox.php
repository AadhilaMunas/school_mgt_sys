<?php

require_once '../config/dbc.php';
require_once '../class/database.php';
require_once '../class/systemSetting.php';
$dbClass = new database();
$system = new setting();

if (array_key_exists("comboBox", $_POST)) {
    if ($_POST['comboBox'] == 'currency_combo') {
        $system->prepareSelectQueryForJSON("SELECT
ht_currency.currency_code,
ht_currency.currency_symbol,
ht_currency.currency_id
FROM `ht_currency`");
    } elseif ($_POST['comboBox'] == 'bar_main_combox') {
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_main_cat.bar_main_cat_id,
ht_bar_main_cat.bar_main_cat_name
FROM
ht_bar_main_cat");
    } elseif ($_POST['comboBox'] == 'bar_sub_cat_combox') {
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_sub_cat.bar_sub_cat_id,
ht_bar_sub_cat.main_cat_id,
ht_bar_sub_cat.bar_sub_cat_name
FROM
ht_bar_sub_cat
WHERE
ht_bar_sub_cat.main_cat_id = '{$_POST['bsubct']}'");
    } elseif ($_POST['comboBox'] == 'rest_main_combox') {
        $system->prepareSelectQueryForJSON("SELECT
	ht_rest_main_cat.rest_main_cat_id,
	ht_rest_main_cat.rest_main_cat_name
FROM
	ht_rest_main_cat");
    } elseif ($_POST['comboBox'] == 'syscode_combox') {
        $system->prepareSelectQueryForJSON("SELECT
	ht_sys_cat.sys_cat_aid,
	ht_sys_cat.sys_category_name
FROM
	ht_sys_cat
WHERE
	ht_sys_cat.sys_cat_status = '1'");
    }elseif ($_POST['comboBox'] == 'roomtyp_combox') {
        $system->prepareSelectQueryForJSON("SELECT
ht_sys_code.sys_id,
ht_sys_code.sys_name
FROM
ht_sys_code
WHERE
ht_sys_code.sys_type = '7' AND
ht_sys_code.sysy_is_default = '1'");
    }elseif ($_POST['comboBox'] == 'livicat_combox') {
        $system->prepareSelectQueryForJSON("SELECT
ht_livin_cat.li_aid,
ht_livin_cat.living_cat
FROM
ht_livin_cat
ORDER BY
ht_livin_cat.li_aid ASC");
    }elseif ($_POST['comboBox'] == 'basic_combox') {
        $system->prepareSelectQueryForJSON("SELECT
ht_room_basic.bacis_aid,
ht_room_basic.r_basic
FROM
ht_room_basic
ORDER BY
ht_room_basic.bacis_aid ASC");
    }
    elseif ($_POST['comboBox'] == 'spe_guest_id_meal_rate') {
        $qry="SELECT
	ht_guest_meal_rates.guest_meal_date,
	ht_guest_meal_rates.guest_meal_rates,
	ht_guest_reg.reservation_no,
	ht_guest_meal_rates.guest_id
FROM
	ht_guest_meal_rates
INNER JOIN ht_guest_reg ON ht_guest_meal_rates.guest_id = ht_guest_reg.guest_id
WHERE
	ht_guest_meal_rates.guest_meal_rates_status = 1
ORDER BY
	ht_guest_meal_rates.guest_meal_rates DESC";
//        echo $qry;
        $system->prepareSelectQueryForJSON($qry);
    } elseif ($_POST['comboBox'] == 'sundry_bill_no') {
        $system->prepareSelectQueryForJSON("SELECT
	ht_sundry.sundry_id,
        ht_sundry.sundry_guest_type
FROM
	ht_sundry
WHERE
	ht_sundry.sundry_guest_type = '{$_POST['guest_type']}'
ORDER BY
	ht_sundry.sundry_id DESC");
    } elseif ($_POST['comboBox'] == 'laundry_category_combo') {
        $system->prepareSelectQueryForJSON("SELECT
ht_laundry_maincat.laundry_maincat_id,
ht_laundry_maincat.laundry_maincat_name
FROM
ht_laundry_maincat");
    } elseif ($_POST['comboBox'] == 'rest_sub_cat_combox') {
        $system->prepareSelectQueryForJSON("SELECT
ht_rest_sub_cat.rest_item_name,
ht_rest_sub_cat.rest_item_id
FROM
ht_rest_sub_cat
WHERE
ht_rest_sub_cat.rest_main_cat_id = '{$_POST['rubct']}'");
    } elseif ($_POST['comboBox'] == 'system_code_deatails_combo') {
        $system->prepareSelectQueryForJSON("SELECT
ht_sys_code.sys_type,
ht_sys_code.sys_name,
ht_sys_code.sys_code,
ht_sys_code.sys_id
FROM
ht_sys_code
WHERE
ht_sys_code.sys_type = '{$_POST['code']}'");
    }
    elseif ($_POST['comboBox'] == 'res_no') {
        $system->prepareSelectQueryForJSON("SELECT
ht_guest_reg.guest_id AS rno,
CONCAT('00',ht_guest_reg.guest_id+1) AS nres
FROM
ht_guest_reg
ORDER BY
ht_guest_reg.guest_id DESC
LIMIT 1");
}elseif ($_POST['comboBox'] == 'available_r_combo') {
        $system->prepareSelectQueryForJSON("SELECT
ht_create_rm.create_rm_no,
ht_create_rm.create_rm_id
FROM
ht_create_rm
WHERE
ht_create_rm.create_rm_status = 0 AND
ht_create_rm.rm_cat_id  = '{$_POST['r_id']}'");
    }
}


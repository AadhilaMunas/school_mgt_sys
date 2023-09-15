<?php

require_once '../config/dbc.php';
require_once '../class/database.php';
require_once '../class/systemSetting.php';
$dbClass = new database();
$system = new setting();
MainConfig::connectDB();
if (array_key_exists("table", $_POST)) {
    if ($_POST['table'] == 'curency_type_table') {
        $query = "SELECT
ht_currency.currency_id,
ht_currency.currency_code,
ht_currency.currency_symbol,
ht_currency.currency_status
FROM
ht_currency
ORDER BY
ht_currency.currency_id DESC";
        $system->prepareSelectQueryForJSON($query);
    } elseif ($_POST['table'] == 'tax_rate_table') {
        $query = "SELECT
ht_tax.tax_id,
ht_tax.tax_name,
ht_tax.tax_rate
FROM
ht_tax
ORDER BY
ht_tax.tax_id DESC";
        $system->prepareSelectQueryForJSON($query);
    } elseif ($_POST['table'] == 'syscode_table') {
        $system->prepareSelectQueryForJSON("SELECT
	ht_sys_cat.sys_category_name,
	ht_sys_code.sys_id,
	ht_sys_code.sys_name,
	ht_sys_code.sys_code,
	ht_sys_code.sys_remarks,
	ht_sys_code.sysy_is_default,
	ht_sys_code.sys_type
FROM
	ht_sys_cat
INNER JOIN ht_sys_code ON ht_sys_code.sys_type = ht_sys_cat.sys_cat_aid
WHERE
	ht_sys_cat.sys_cat_status = '1'
AND ht_sys_code.sys_type = '{$_POST['sys_cat_id']}'
ORDER BY
	ht_sys_code.sys_id DESC");
    } else if ($_POST['table'] == 'medium') {
        $qury = "SELECT
tbl_medieam.scl_medi_aid,
tbl_medieam.scl_mediam,
tbl_medieam.scl_mediam_sh
FROM
tbl_medieam
ORDER BY
tbl_medieam.scl_medi_aid DESC";
        $system->prepareSelectQueryForJSON($qury);
    } else if ($_POST['table'] == 'spe_guest_mealprice') {
        $qury = "SELECT
	ht_guest_meal_rates.guest_meal_rates,
	ht_guest_meal_rates.guest_id,
	ht_guest_meal_rates.guest_meal_rates_bf,
	ht_guest_meal_rates.guest_meal_rates_lunch,
	ht_guest_meal_rates.guest_meal_rates_dnnr,
	ht_guest_meal_rates.guest_meal_rates_other,
	ht_guest_meal_rates.guest_meal_date,
	ht_guest_reg.reservation_no,
	ht_guest_reg.guset_name
FROM
	ht_guest_meal_rates
INNER JOIN ht_guest_reg ON ht_guest_meal_rates.guest_id = ht_guest_reg.guest_id
WHERE
	ht_guest_meal_rates.guest_meal_rates_status = '1'
AND ht_guest_reg.guest_meal_rate_status = '0'
ORDER BY
	ht_guest_meal_rates.guest_meal_rates DESC";
        $system->prepareSelectQueryForJSON($qury);
    } elseif ($_POST['table'] == 'change_meal_guest') {
        $quary = "SELECT
	ht_guest_reg.guest_id,
	ht_guest_reg.reservation_no,
	ht_guest_reg.guset_name
FROM
	ht_guest_reg
INNER JOIN ht_guest_meal_rates ON ht_guest_meal_rates.guest_id = ht_guest_reg.guest_id
WHERE
	ht_guest_reg.guest_meal_rate_status = '0'
AND ht_guest_meal_rates.guest_meal_rates_status = '1'
GROUP BY
	ht_guest_meal_rates.guest_id
        ORDER BY
	ht_guest_reg.guest_id DESC";
        $system->prepareSelectQueryForJSON($quary);
    } elseif ($_POST['table'] == 'sundry_detail') {
        $query = "SELECT
	ht_sundry.sundry_id,
	ht_sundry.sundry_guest_type,
	ht_sundry.sundry_rm_no,
	ht_sundry.sundry_reg_id,
	ht_sundry.sundry_date,
	ht_sundry.sundry_time,
	ht_sundry.sundry_price,
	ht_sundry.sundry_discount,
        (sundry_price-sundry_discount)as amount,
	ht_sundry.sundry_desc,
	ht_sundry.sundry_tel
FROM
	ht_sundry
WHERE
	ht_sundry.sundry_guest_type = '{$_POST['guest_type']}'
        ORDER BY
	ht_sundry.sundry_id DESC";
        $system->prepareSelectQueryForJSON($query);
    } elseif ($_POST['table'] == 'room_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_room_price.rp_aid,
ht_room_basic.r_basic,
ht_livin_cat.living_cat,
ht_sys_code.sys_name,
ht_room_price.rm_price
FROM
ht_room_price
INNER JOIN ht_room_basic ON ht_room_price.rm_basic = ht_room_basic.bacis_aid
INNER JOIN ht_livin_cat ON ht_room_price.rm_licid = ht_livin_cat.li_aid
INNER JOIN ht_sys_code ON ht_room_price.rm_typid = ht_sys_code.sys_id
ORDER BY
ht_sys_code.sys_id ASC,
ht_room_price.rp_aid DESC");
    } elseif ($_POST['table'] == 'room_save_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_create_rm.create_rm_id,
ht_create_rm.create_rm_no,
ht_create_rm.create_rm_desc,
ht_create_rm.create_rm_status,
ht_sys_code.sys_name
FROM
ht_create_rm
LEFT OUTER JOIN ht_sys_code ON ht_sys_code.sys_id = ht_create_rm.rm_cat_id
GROUP BY
ht_create_rm.create_rm_no");
    } elseif ($_POST['table'] == 'room_save_tables') {
        $system->prepareSelectQueryForJSON("SELECT
ht_create_rm.create_rm_id,
ht_create_rm.create_rm_no,
ht_create_rm.create_rm_desc,
ht_create_rm.create_rm_status,
ht_sys_code.sys_name
FROM
ht_create_rm
LEFT OUTER JOIN ht_sys_code ON ht_sys_code.sys_id = ht_create_rm.rm_cat_id
WHERE
ht_sys_code.sys_id = '{$_POST['id']}'
GROUP BY
ht_create_rm.create_rm_no");
    } elseif ($_POST['table'] == 'extra_features_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_rm_features.rm_features_id,
ht_rm_features.rm_features_name,
ht_rm_features.rm_features_remarks,
ht_rm_features.rm_features_status
FROM
ht_rm_features
ORDER BY
ht_rm_features.rm_features_id DESC");
    } elseif ($_POST['table'] == 'load_currency_rate_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_currency_rate.currency_rate_id,
ht_currency_rate.currency_rate,
ht_currency_rate.currency_date,
ht_currency.currency_code,
ht_currency.currency_symbol
FROM
ht_currency_rate
INNER JOIN ht_currency ON ht_currency_rate.currency_id = ht_currency.currency_id
ORDER BY
ht_currency_rate.currency_rate_id DESC");
    } elseif ($_POST['table'] == 'load_bar_main_cat_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_main_cat.bar_main_cat_id,
ht_bar_main_cat.bar_main_cat_name
FROM
ht_bar_main_cat
ORDER BY
ht_bar_main_cat.bar_main_cat_id DESC");
    } elseif ($_POST['table'] == 'load_living_cat_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_livin_cat.li_aid,
ht_livin_cat.living_cat
FROM
ht_livin_cat ORDER BY
ht_livin_cat.li_aid DESC");
    } elseif ($_POST['table'] == 'load_basic_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_room_basic.bacis_aid,
ht_room_basic.r_basic
FROM
ht_room_basic ORDER BY
ht_room_basic.bacis_aid DESC");
    } elseif ($_POST['table'] == 'load_bar_sub_cat_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_sub_cat.bar_sub_cat_name,
ht_bar_main_cat.bar_main_cat_name,
ht_bar_sub_cat.bar_sub_cat_id
FROM
ht_bar_main_cat
INNER JOIN ht_bar_sub_cat ON ht_bar_sub_cat.main_cat_id = ht_bar_main_cat.bar_main_cat_id
ORDER BY
ht_bar_sub_cat.bar_sub_cat_id DESC");
    } elseif ($_POST['table'] == 'load_agent_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_agent_reg.agent_id,
ht_agent_reg.agent_type,
ht_agent_reg.agent_reg_no,
ht_agent_reg.agent_tel1,
ht_agent_reg.agent_tel2,
ht_agent_reg.agent_fax,
ht_agent_reg.agent_web,
ht_agent_reg.agent_email,
ht_agent_reg.agent_contact_person,
ht_agent_reg.agent_contactp_tel,
ht_agent_reg.agent_name,
ht_agent_reg.agent_address
FROM
ht_agent_reg
ORDER BY
ht_agent_reg.agent_id DESC
");
    } elseif ($_POST['table'] == 'load_rest_main_cat_table') {
        $system->prepareSelectQueryForJSON("SELECT
	ht_rest_main_cat.rest_main_cat_id,
	ht_rest_main_cat.rest_main_cat_name
FROM
	ht_rest_main_cat
ORDER BY
	ht_rest_main_cat.rest_main_cat_id DESC");
    } elseif ($_POST['table'] == 'load_sysc_main_cat_table') {
        $system->prepareSelectQueryForJSON("SELECT
	ht_sys_cat.sys_cat_aid,
	ht_sys_cat.sys_category_name
FROM
	ht_sys_cat
WHERE
	ht_sys_cat.sys_cat_status = '1'");
    } elseif ($_POST['table'] == 'load_bar_item_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_item_reg.bar_item_reg_code,
ht_bar_item_reg.bar_item_reg_group,
ht_bar_item_reg.bar_item_reg_unit,
ht_bar_item_reg.bar_item_reg_exp_date,
ht_bar_item_reg.bar_item_reg_reorder,
ht_bar_item_reg.bar_item_reg_amount,
ht_bar_item_reg.bar_item_reg_capacity,
ht_bar_sub_cat.bar_sub_cat_name,
ht_bar_main_cat.bar_main_cat_name,
ht_bar_item_reg.bar_item_reg_id
FROM
ht_bar_item_reg
INNER JOIN ht_bar_sub_cat ON ht_bar_item_reg.bar_sub_cat_id = ht_bar_sub_cat.bar_sub_cat_id
INNER JOIN ht_bar_main_cat ON ht_bar_sub_cat.main_cat_id = ht_bar_main_cat.bar_main_cat_id
ORDER BY
ht_bar_item_reg.bar_item_reg_id DESC");
    } elseif ($_POST['table'] == 'load_rest_sub_cat_table') {
        $system->prepareSelectQueryForJSON("SELECT
	ht_rest_sub_cat.rest_item_id,
        ht_rest_main_cat.rest_main_cat_name,
	ht_rest_sub_cat.rest_item_name
FROM
	ht_rest_sub_cat
INNER JOIN ht_rest_main_cat ON ht_rest_sub_cat.rest_main_cat_id = ht_rest_main_cat.rest_main_cat_id
ORDER BY
	ht_rest_sub_cat.rest_item_id DESC");
    } elseif ($_POST['table'] == 'laundry_category_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_laundry_maincat.laundry_maincat_id,
ht_laundry_maincat.laundry_maincat_name
FROM `ht_laundry_maincat`");
    } elseif ($_POST['table'] == 'load_laundry_types_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_laundry_cloths.cloth_id,
ht_laundry_cloths.cloth_item,
ht_laundry_cloths.cloth_laundry_price,
ht_laundry_cloths.cloth_pressing_price,
ht_laundry_maincat.laundry_maincat_name
FROM
ht_laundry_cloths
INNER JOIN ht_laundry_maincat ON ht_laundry_cloths.laundry_maincat_id = ht_laundry_maincat.laundry_maincat_id
WHERE
ht_laundry_cloths.laundry_maincat_id = '{$_POST['laundry_cat_id']}'
ORDER BY
ht_laundry_cloths.cloth_id DESC");
    } elseif ($_POST['table'] == 'load_rest_item_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_rest_main_cat.rest_main_cat_name,
ht_rest_sub_cat.rest_item_name,
ht_ala_carte.ala_carte_code,
ht_ala_carte.ala_carte_item_name,
ht_ala_carte.ala_carte_price,
ht_ala_carte.ala_carte_cat_group,
ht_ala_carte.ala_carte_id
FROM
ht_ala_carte
INNER JOIN ht_rest_sub_cat ON ht_ala_carte.rest_item_id = ht_rest_sub_cat.rest_item_id
INNER JOIN ht_rest_main_cat ON ht_rest_sub_cat.rest_main_cat_id = ht_rest_main_cat.rest_main_cat_id
ORDER BY
ht_ala_carte.ala_carte_id DESC");
    } elseif ($_POST['table'] == 'load_bar_used_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_add_item.bar_qty,
ht_bar_add_item.bar_amount,
ht_bar.bar_discount_amount,
ht_bar.bar_bill_amount,
ht_bar_add_item.bar_item_group,
ht_bar.bar_net_amount,
ht_bar_item_reg.bar_item_reg_unit,
ht_bar_item_reg.bar_item_reg_code,
ht_bar_sub_cat.bar_sub_cat_name,
ht_bar_main_cat.bar_main_cat_name
FROM
ht_bar
INNER JOIN ht_bar_add_item ON ht_bar_add_item.bar_id = ht_bar.bar_id
INNER JOIN ht_bar_item_reg ON ht_bar_add_item.bar_item_reg_id = ht_bar_item_reg.bar_item_reg_id
INNER JOIN ht_bar_sub_cat ON ht_bar_item_reg.bar_sub_cat_id = ht_bar_sub_cat.bar_sub_cat_id
INNER JOIN ht_bar_main_cat ON ht_bar_sub_cat.main_cat_id = ht_bar_main_cat.bar_main_cat_id
WHERE
ht_bar.guest_id = '{$_POST['guest_reg']}'");
    } elseif ($_POST['table'] == 'load_laundry_used_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_laundry.laundry_rm_no,
ht_laundry.laundry_date,
ht_laundry.laundry_time,
ht_laundry_maincat.laundry_maincat_name,
ht_laundry_cloths.cloth_laundry_price,
ht_laundry_cloths.cloth_pressing_price,
ht_laundry_cloths.cloth_status,
ht_laundry_add_items.laundry_item_delivery_date,
ht_laundry_add_items.laundry_item_delivery_time,
ht_laundry_add_items.laundry_item_price,
ht_laundry_add_items.laundry_item_qty,
ht_laundry.laundry_tel,
ht_laundry_cloths.cloth_item
FROM
ht_laundry
INNER JOIN ht_laundry_add_items ON ht_laundry_add_items.laundry_id = ht_laundry.laundry_id
INNER JOIN ht_laundry_cloths ON ht_laundry_add_items.cloth_id = ht_laundry_cloths.cloth_id
INNER JOIN ht_laundry_maincat ON ht_laundry_cloths.laundry_maincat_id = ht_laundry_maincat.laundry_maincat_id
WHERE
ht_laundry.laundry_guest_reg_id = '{$_POST['guest_regl']}'");
    } elseif ($_POST['table'] == 'load_room_book_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_guest_reg.guest_id,
ht_guest_reg.reservation_no,
CONCAT(guest_title,' ',guset_fname,' ',guset_lname) as g_name,
ht_guest_reg.guest_arrival_date,
ht_guest_reg.no_rooms,
ht_guest_reg.guest_departure_date,
ht_sys_code.sys_name,
ht_guest_reg.guest_room_cat_id
FROM
ht_guest_reg
INNER JOIN ht_sys_code ON ht_guest_reg.guest_room_cat_id = ht_sys_code.sys_id
WHERE
ht_guest_reg.guest_status = 2");
    } elseif ($_POST['table'] == 'load_resturants_table') {
        $system->prepareSelectQueryForJSON("SELECT
ht_rest_main_cat.rest_main_cat_name,
ht_rest_sub_cat.rest_item_name,
ht_ala_carte.ala_carte_item_name,
ht_rest_item_add.rest_item_qty,
ht_rest_item_add.rest_item_amnt,
ht_ala_carte.ala_carte_price,
ht_resturant_bill.rest_room_no,
ht_resturant_bill.rest_tbl_no,
ht_resturant_bill.rest_meal,
ht_resturant_bill.rest_menu_type,
ht_resturant_bill.rest_discount_rate,
ht_resturant_bill.rest_service_charge,
ht_resturant_bill.rest_net_amount
FROM
ht_resturant_bill
INNER JOIN ht_rest_item_add ON ht_rest_item_add.rest_bill_id = ht_resturant_bill.rest_bill_id
INNER JOIN ht_ala_carte ON ht_rest_item_add.ala_carte_id = ht_ala_carte.ala_carte_id
INNER JOIN ht_rest_sub_cat ON ht_ala_carte.rest_item_id = ht_rest_sub_cat.rest_item_id
INNER JOIN ht_rest_main_cat ON ht_rest_sub_cat.rest_main_cat_id = ht_rest_main_cat.rest_main_cat_id
WHERE
ht_resturant_bill.rest_guest_reg_id = '{$_POST['rest_id']}'");
    } elseif ($_POST['table'] == 'load_booking') {
        $system->prepareSelectQueryForJSON("SELECT
ht_guest_reg.guest_id,
ht_guest_reg.reservation_no,
CONCAT(guest_title,' ',guset_fname,' ',guset_lname) AS g_name,
ht_guest_reg.guest_arrival_date,
ht_guest_reg.no_rooms,
ht_guest_reg.guest_departure_date,
ht_sys_code.sys_name,
ht_guest_reg.guest_room_cat_id,
ht_guest_reg.guest_country,
ht_guest_reg.guest_tel1,
ht_guest_reg.guest_email,
ht_guest_reg.gust_advance
FROM
ht_guest_reg
INNER JOIN ht_sys_code ON ht_guest_reg.guest_room_cat_id = ht_sys_code.sys_id
WHERE
ht_guest_reg.guest_status = 1");
    } elseif ($_POST['table'] == 'load_bill') {
        $system->prepareSelectQueryForJSON("SELECT
ht_guest_reg.guest_id,
ht_guest_reg.reservation_no,
CONCAT(ht_guest_reg.guest_title,' ',ht_guest_reg.guset_fname,' ' ,ht_guest_reg.guset_lname) AS gst_name,
DATEDIFF(ht_guest_reg.guest_departure_date,ht_guest_reg.guest_arrival_date) AS date_dff,
ht_guest_reg.guest_arrival_date,
ht_guest_reg.guest_departure_date,
ht_guest_reg.no_rooms,
ht_guest_reg.gust_advance,
ht_guest_reg.guest_room_cat_id,
ht_guest_reg.guest_room_livin_id,
ht_guest_reg.guest_basic_id
FROM
ht_guest_reg
INNER JOIN ht_rm_reserv ON ht_rm_reserv.guest_id = ht_guest_reg.guest_id
LEFT OUTER JOIN ht_create_rm ON ht_rm_reserv.rm_create_rm_id = ht_create_rm.create_rm_id
WHERE
ht_guest_reg.guest_status = 3 AND
ht_rm_reserv.reserv_st = 0 AND
ht_create_rm.create_rm_status = 1
GROUP BY
ht_rm_reserv.guest_id
ORDER BY
ht_guest_reg.guest_departure_date ASC");
    }
}

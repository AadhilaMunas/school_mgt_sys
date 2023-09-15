<?php

session_start();
require_once '../config/dbc.php';
require_once '../class/database.php';
require_once '../class/systemSetting.php';
$system = new setting();
$database = new database();
MainConfig::connectDB();
if (array_key_exists("action", $_POST)) {


    if ($_POST['action'] == 'save_curncy_type') {
        if (empty($_POST['cur_symbol'] || $_POST['curncy_code'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Please fill currency details")));
            return;
        }
        $data = array(
            'currency_code' => $_POST['curncy_code'],
            'currency_symbol' => $_POST['cur_symbol'],
            'currency_status' => $_POST['checkboxes']
        );
        $Quary = $system->Prepare_insert("ht_currency", $data);
        $system->prepareCommandQueryForAlertify($Quary, "Successfully saved !", "System error !");
    } elseif ($_POST['action'] == 'edit_curncy') {
        $quey = "SELECT ht_currency.currency_code, ht_currency.currency_symbol, ht_currency.currency_id, ht_currency.currency_status FROM `ht_currency` WHERE ht_currency.currency_id = '{$_POST['cur_id']}'";
        $system->prepareSelectQueryForJSON($quey);
    } elseif ($_POST['action'] == 'save_tax_rate') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_tax` (`tax_name`, `tax_rate`) VALUES ('{$_POST['tax_name']}', '{$_POST['tax_rate']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } elseif ($_POST['action'] == 'edit_txes') {
        $qury = "SELECT
ht_tax.tax_id,
ht_tax.tax_name,
ht_tax.tax_rate
FROM
ht_tax
WHERE
ht_tax.tax_id = '{$_POST['edt_tx_id']}'";
        $system->prepareSelectQueryForJSON($qury);
    } else if ($_POST['action'] == 'update_tax_rate') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_tax` SET `tax_name`='{$_POST['tax_name']}', `tax_rate`='{$_POST['tax_rate']}' WHERE (`tax_id`='{$_POST['taxes_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_txes') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_tax` WHERE `tax_id` = '{$_POST['dlte_tx']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    } 
    //--------------Insert School Grades Code---------------
    elseif ($_POST['action'] == 'save_grade') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `sclmgt`.`tbl_grade` (`grade_no`) VALUES ('{$_POST['sysgrade']}');", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    //------------end Insert shool Grades Code --------------
        
        
        
        } elseif ($_POST['action'] == 'edit_syscode') {
        $qury = "SELECT
ht_sys_code.sys_id,
ht_sys_code.sys_type,
ht_sys_code.sys_name,
ht_sys_code.sys_code,
ht_sys_code.sys_remarks,
ht_sys_code.sysy_is_default
FROM
ht_sys_code
WHERE
ht_sys_code.sys_id = '{$_POST['edt_sys']}'";
        $system->prepareSelectQueryForJSON($qury);
    } else if ($_POST['action'] == 'update_syscode') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_sys_code` SET `sys_type`='{$_POST['Type_ComboBox']}', `sys_name`='{$_POST['syscode_name']}', `sys_code`='{$_POST['syscode_code']}' , `sys_remarks`='{$_POST['syscode_remarks']}' WHERE (`sys_id`='{$_POST['sys_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_syscdes') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_sys_code` WHERE `sys_id` = '{$_POST['dlt_sys']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }
    //---------------------------School Medium functions ------------------------------------
//@ Wasantha
    else if ($_POST['action'] == 'add_medium') {
        //$today = date('Y-m-d');
        if (empty($_POST['me_type'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Mediums")));
            return;
        }
        if (empty($_POST['sh_code'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Medium Short Code")));
            return;
        }
//        if (empty($_POST['di_price'])) {
//            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Dinner Price")));
//            return;
//        }
//        if (empty($_POST['other_price'])) {
//            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Other Price")));
//            return;
//        }

        mysql_query("START TRANSACTION");
        $ins = mysql_query("INSERT INTO `tbl_medieam` (`scl_mediam`, `scl_mediam_sh`)VALUES('{$_POST['me_type']}','{$_POST['sh_code']}')");
        if ($ins) {
            mysql_query("COMMIT");
            echo json_encode(array(array("msgType" => 1, "msg" => "School Medium saved")));
        } else {
            mysql_query("ROLLBACK");
            echo json_encode(array(array("msgType" => 2, "msg" => "School Medium Could not save")));
        }
    } else if ($_POST['action'] == 'medium_select') {
        $m_id = $_POST['m_id'];
        $system->prepareSelectQueryForJSON("SELECT
tbl_medieam.scl_medi_aid,
tbl_medieam.scl_mediam,
tbl_medieam.scl_mediam_sh
FROM
tbl_medieam
WHERE
tbl_medieam.scl_medi_aid ='{$m_id}'
 ");
    }
    // meal price update
    else if ($_POST['action'] == 'm_update') {
        //$today = date('Y-m-d');
        $form = $_POST['form_data'];
        if (empty($form['m_id'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Select a Maker to update")));
            return;
        }
        if (empty($form['m_type'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Medium Type")));
            return;
        }
        if (empty($form['m_sh'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Medium Type Short Code")));
            return;
        }

        foreach ($form as $key => $value) {
            $form[$key] = mysql_real_escape_string($form[$key]);
        }
        mysql_query("START TRANSACTION");
        $ins = mysql_query("UPDATE `tbl_medieam` SET `scl_mediam`='{$form['m_type']}',`scl_mediam_sh`='{$form['m_sh']}' WHERE (`scl_medi_aid`='{$form['m_id']}')") or die(mysql_error());
        if ($ins) {
            mysql_query("COMMIT");
            echo json_encode(array(array("msgType" => 1, "msg" => "School Class Medium Type Update Sucess...!")));
        } else {
            mysql_query("ROLLBACK");
            echo json_encode(array(array("msgType" => 2, "msg" => "School Class Medium Type Update Can't be Update...!")));
        }
    } else if ($_POST['action'] == 'smprice_update') {
        //$today = date('Y-m-d');
        $form = $_POST['form_data'];
        if (empty($form['smeal_id'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Select a Maker to update")));
            return;
        }
        if (empty($form['sbr_price'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Brekfast price")));
            return;
        }
        if (empty($form['slu_price'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Lunch price")));
            return;
        }
        if (empty($form['sdi_price'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Dinner price")));
            return;
        }
        if (empty($form['sother_price'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a Other price")));
            return;
        }
        if (empty($form['spe_gu_meal_date'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Enter a valid date")));
            return;
        }
        foreach ($form as $key => $value) {
            $form[$key] = mysql_real_escape_string($form[$key]);
        }
        mysql_query("START TRANSACTION");
        $ins = mysql_query("UPDATE `ht_guest_meal_rates` SET `guest_meal_rates_bf`='{$form['sbr_price']}',`guest_meal_rates_lunch`='{$form['slu_price']}',`guest_meal_rates_dnnr`='{$form['sdi_price']}',`guest_meal_rates_other`='{$form['sother_price']}',`guest_meal_date`='{$form['spe_gu_meal_date']}' WHERE (`guest_meal_rates`='{$form['smeal_id']}')") or die(mysql_error());
        if ($ins) {
            mysql_query("COMMIT");
            echo json_encode(array(array("msgType" => 1, "msg" => "Meal Price saved")));
        } else {
            mysql_query("ROLLBACK");
            echo json_encode(array(array("msgType" => 2, "msg" => "Meal Price not save")));
        }
    } elseif ($_POST['action'] == 'sundy_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `hotel_mgmt`.`ht_sundry` SET `sundry_guest_type`='{$_POST['guest_type']}', `sundry_rm_no`='{$_POST['room_no']}', `sundry_date`='{$_POST['sun_date']}',`sundry_price`='{$_POST['sun_price']}', `sundry_discount`='{$_POST['sun_dis']}', `sundry_desc`='{$_POST['sun_item']}', `sundry_tel`='{$_POST['tel_no']}', `sundry_bill_status`='1' WHERE (`sundry_id`='{$_POST['sundry_g_id']}');", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } elseif ($_POST['action'] == 'sundry_delete') {
        $system->prepareCommandQueryForAlertify("Delete From `ht_sundry` WHERE `sundry_id` = '{$_POST['gu_id']}'", "Successfully Delete", "Sorry Could Not Be Deleted");
    } 
    //-------------Delete Medium SQL Function----------------------------------
    else if ($_POST['action'] == 'delete_medium') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `tbl_medieam` WHERE `scl_medi_aid` = '{$_POST['m_id']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    } else if ($_POST['action'] == 'delete_spe_mprice') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_guest_meal_rates` WHERE `guest_meal_rates` = '{$_POST['spe_mid']}'")or die(mysql_error());
        //  $system->prepareCommandQueryForAlertify("DELETE FROM `ht_guest_meal_rates` WHERE `guest_meal_rates` = '{$_POST['spe_mid']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    } else if ($_POST['action'] == 'change_cat') {
        mysql_query("START TRANSACTION");
        $err = 0;
        $delete = mysql_query("DELETE FROM `ht_guest_meal_rates` WHERE `guest_id` = '{$_POST['gu_id']}'");
        if (!$delete) {
            $err++;
        }
        $update = mysql_query("UPDATE `hotel_mgmt`.`ht_guest_reg` SET `guest_meal_rate_status`='1' WHERE `guest_id`='{$_POST['gu_id']}'");
        if (!$update) {
            $err++;
        }
        if ($err == 0) {
            mysql_query("COMMIT");
            echo json_encode(array(array("msgType" => 1, "msg" => "Sucessfully Change Guest Meal Rates")));
        } else {
            mysql_query("ROLLBACK");
            echo json_encode(array(array("msgType" => 2, "msg" => "Sorry....!could not be change")));
        }
    }
    //    create save
//    sampath wijesinghe
    elseif ($_POST['action'] == 'room_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_create_rm` (`create_rm_no`, `create_rm_desc`, `create_rm_status`, `rm_cat_id`) VALUES ('{$_POST['room_no']}', '{$_POST['rm_remrk']}', '0','{$_POST['rm_tid']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } elseif ($_POST['action'] == 'room_price_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_room_price` (`rm_typid`, `rm_licid`, `rm_basic`, `rm_price`) VALUES ('{$_POST['rm_tid']}', '{$_POST['rm_lid']}','{$_POST['rm_bid']}','{$_POST['room_price']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'edit_create_room') {
        $crerm = $_POST['edt_crm_id'];
        $system->prepareSelectQueryForJSON("SELECT
ht_room_price.rp_aid,
ht_room_price.rm_typid,
ht_room_price.rm_licid,
ht_room_price.rm_basic,
ht_room_price.rm_price
FROM
ht_room_price
WHERE
ht_room_price.rp_aid = '{$crerm }'");
    } else if ($_POST['action'] == 'room_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_create_rm` SET `create_rm_no`='{$_POST['room_no']}', `create_rm_desc`='{$_POST['rm_remrk']}', `create_rm_status`='0',`rm_cat_id`='{$_POST['rm_id']}' WHERE (`create_rm_id`='{$_POST['croom_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'price_updete') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_room_price` SET `rm_typid`='{$_POST['ty_id']}', `rm_licid`='{$_POST['liv_id']}', `rm_basic`='{$_POST['basic_id']}', `rm_price`='{$_POST['p']}' WHERE (`rp_aid`='{$_POST['hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated This Type is Already Exist...!");
    } else if ($_POST['action'] == 'delete_create_room') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_create_rm` WHERE `create_rm_id` = '{$_POST['dlt_room']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    } else if ($_POST['action'] == 'delete_room_price') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_room_price` WHERE `rp_aid` = '{$_POST['dlt_room']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }
    //   extra features
//    sampath wijesinghe
    elseif ($_POST['action'] == 'extra_feature_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_rm_features` (`rm_features_name`, `rm_features_remarks`, `rm_features_status`) VALUES ('{$_POST['extra_feature']}', '{$_POST['feature_remrk']}', '0')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'edit_extrafeatures_room') {
        $ex_feature = $_POST['edt_rm_fea_id'];
        $system->prepareSelectQueryForJSON("SELECT
ht_rm_features.rm_features_id,
ht_rm_features.rm_features_name,
ht_rm_features.rm_features_remarks,
ht_rm_features.rm_features_status
FROM
ht_rm_features
WHERE
ht_rm_features.rm_features_id = '{$ex_feature }'");
    } else if ($_POST['action'] == 'extra_feature_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_rm_features` SET `rm_features_name`='{$_POST['extra_feature']}', `rm_features_remarks`='{$_POST['feature_remrk']}', `rm_features_status`='0' WHERE (`rm_features_id`='{$_POST['feature_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_rooms_features') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_rm_features` WHERE `rm_features_id` = '{$_POST['dlt_room_features']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    } else if ($_POST['action'] == 'update_currency_type') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_currency` SET `currency_code`='{$_POST['curncy_code']}', `currency_symbol`='{$_POST['curncy_symbol']}', `currency_status`='{$_POST['checkboxes']}' WHERE (`currency_id`='{$_POST['curncy_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_curency_type') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_currency` WHERE `currency_id` = '{$_POST['dlt_curency_type']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }
    //    sampath wijesinghe
    elseif ($_POST['action'] == 'currency_rate_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_currency_rate` (`currency_id`, `currency_rate`, `currency_date`) VALUES ('{$_POST['currency_comboBox']}', '{$_POST['currency_rate']}', '{$_POST['currency_date']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'edit_curency_rate') {
        $cur_rate_id = $_POST['cur_rate_id'];
        $system->prepareSelectQueryForJSON("SELECT
ht_currency_rate.currency_rate_id,
ht_currency_rate.currency_rate,
ht_currency_rate.currency_date,
ht_currency_rate.currency_id
FROM
ht_currency_rate
WHERE
ht_currency_rate.currency_rate_id = '{$cur_rate_id }'");
    } else if ($_POST['action'] == 'currency_rate_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_currency_rate` SET `currency_id`='{$_POST['currency_comboBox']}', `currency_rate`='{$_POST['currency_rate']}', `currency_date`='{$_POST['currency_date']}' WHERE (`currency_rate_id`='{$_POST['crncyrate_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_curency_type_details') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_currency_rate` WHERE `currency_rate_id` = '{$_POST['dlt_curency_type']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }
    //    sampath wijesinghe
    elseif ($_POST['action'] == 'bar_main_cat_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_bar_main_cat` (`bar_main_cat_name`) VALUES ('{$_POST['b_maincat']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } elseif ($_POST['action'] == 'living_cat_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_livin_cat` (`living_cat`) VALUES ('{$_POST['l_maincat']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } elseif ($_POST['action'] == 'basic_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_room_basic` (`r_basic`) VALUES ('{$_POST['b_maincat']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'edit_bar_main_cat') {
        $b_main_cat = $_POST['edt_b_main_id'];
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_main_cat.bar_main_cat_name,
ht_bar_main_cat.bar_main_cat_id
FROM
ht_bar_main_cat
WHERE
ht_bar_main_cat.bar_main_cat_id = '{$b_main_cat }'");
    } else if ($_POST['action'] == 'edit_living_cat') {
        $l_cat = $_POST['id'];
        $system->prepareSelectQueryForJSON("SELECT
ht_livin_cat.li_aid,
ht_livin_cat.living_cat
FROM
ht_livin_cat
WHERE
ht_livin_cat.li_aid = '{$l_cat }'");
    } else if ($_POST['action'] == 'edit_basic') {
        $b = $_POST['id'];
        $system->prepareSelectQueryForJSON("SELECT
ht_room_basic.bacis_aid,
ht_room_basic.r_basic
FROM
ht_room_basic
WHERE
ht_room_basic.bacis_aid = '{$b}'");
    } else if ($_POST['action'] == 'bar_main_cat_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_bar_main_cat` SET `bar_main_cat_name`='{$_POST['b_maincat']}' WHERE (`bar_main_cat_id`='{$_POST['bmaincat_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'basic_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_room_basic` SET `r_basic`='{$_POST['b_maincat']}' WHERE (`bacis_aid`='{$_POST['bmaincat_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'living_cat_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_livin_cat` SET `living_cat`='{$_POST['l_maincat']}' WHERE (`li_aid`='{$_POST['bmaincat_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_bmaincat_details') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_bar_main_cat` WHERE `bar_main_cat_id` = '{$_POST['dlte_bmain']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }
    //    sampath wijesinghe
    elseif ($_POST['action'] == 'bar_sub_cat_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_bar_sub_cat` (`main_cat_id`, `bar_sub_cat_name`) VALUES ('{$_POST['b_maincats']}', '{$_POST['b_subcat']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'edit_bar_sub_cat') {
        $b_sub_cat = $_POST['b_subitm_id'];
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_sub_cat.bar_sub_cat_id,
ht_bar_sub_cat.main_cat_id,
ht_bar_sub_cat.bar_sub_cat_name
FROM
ht_bar_sub_cat
WHERE
ht_bar_sub_cat.bar_sub_cat_id = '{$b_sub_cat }'");
    } else if ($_POST['action'] == 'bar_sub_cat_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_bar_sub_cat` SET `main_cat_id`='{$_POST['b_maincats']}', `bar_sub_cat_name`='{$_POST['b_subcat']}' WHERE (`bar_sub_cat_id`='{$_POST['b_subcat_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_bar_sub_category') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_bar_sub_cat` WHERE `bar_sub_cat_id` = '{$_POST['del_bsubcat_id']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }

    //    Wasantha Kumara **
    elseif ($_POST['action'] == 'rest_main_cat_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_rest_main_cat` (`rest_main_cat_name`) VALUES ('{$_POST['rest_maincat']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'spe_mprice_select') {
        $sprice_id = $_POST['sprice_id'];
        $system->prepareSelectQueryForJSON("SELECT
	ht_guest_meal_rates.guest_id,
	ht_guest_meal_rates.guest_meal_rates_bf,
	ht_guest_meal_rates.guest_meal_rates_lunch,
	ht_guest_meal_rates.guest_meal_rates_dnnr,
	ht_guest_meal_rates.guest_meal_rates_other,
	ht_guest_meal_rates.guest_meal_date,
	ht_guest_meal_rates.guest_meal_rates
FROM
	ht_guest_meal_rates
WHERE
	ht_guest_meal_rates.guest_meal_rates_status = '1' AND ht_guest_meal_rates.guest_meal_rates = '{$sprice_id}'
ORDER BY
	ht_guest_meal_rates.guest_meal_rates DESC");
    }    //    Wasantha Kumara **
    elseif ($_POST['action'] == 'select_sundry_details') {
        $sundry_id = $_POST['guest_id'];
        $system->prepareSelectQueryForJSON("SELECT
	ht_sundry.sundry_id,
	ht_sundry.sundry_guest_type,
	ht_sundry.sundry_rm_no,
	ht_sundry.sundry_reg_id,
	ht_sundry.sundry_date,
	ht_sundry.sundry_time,
	ht_sundry.sundry_price,
	ht_sundry.sundry_discount,
        (sundry_price-sundry_discount)as total, 
	ht_sundry.sundry_desc,
	ht_sundry.sundry_tel,
	ht_sundry.sundry_bill_status
FROM
	ht_sundry
WHERE
	ht_sundry.sundry_id = '{$sundry_id}'");
    } elseif ($_POST['action'] == 'sys_main_cat_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_sys_cat` (`sys_category_name`,`sys_cat_status`) VALUES ('{$_POST['sys_maincat']}','1')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } elseif ($_POST['action'] == 'guest_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_guest_reg` (`reservation_no`, `guest_origin`, `guest_booking_method`, `guest_title`, `guset_fname`, `guset_lname`, `guest_address`, `guest_identity`, `guest_tel1`, `guest_tel2`, `guest_country`, `guest_email`, `guest_arrival_date`, `guest_departure_date`, `no_of_visits`, `guest_room_cat_id`, `guest_room_livin_id`, `guest_basic_id`, `no_rooms`, `guest_status`) VALUES ('{$_POST['guest_resno']}','{$_POST['guest_origin']}','Direct', '{$_POST['guest_title']}', '{$_POST['guest_fname']}', '{$_POST['guest_lname']}','{$_POST['guest_address']}', '{$_POST['guest_identity']}', '{$_POST['guest_tel1']}', '{$_POST['guest_tel2']}', '{$_POST['guest_country']}','{$_POST['guest_email']}', '{$_POST['arrival_date']}', '{$_POST['depature_date']}', '{$_POST['no_guest']}', '{$_POST['rcat_id']}', '{$_POST['lcat_id']}', '{$_POST['rbasic_id']}','{$_POST['no_rooms']}', '2');", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } elseif ($_POST['action'] == 'online_guest_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_guest_reg`(`reservation_no`, `guest_origin`, `guest_booking_method`, `guest_title`, `guset_fname`, `guset_lname`, `guest_address`, `guest_identity`, `guest_tel1`, `guest_tel2`, `guest_country`, `guest_email`, `guest_arrival_date`, `guest_departure_date`, `no_of_visits`, `guest_room_cat_id`, `guest_room_livin_id`, `guest_basic_id`, `no_rooms`, `guest_status`) VALUES ('{$_POST['guest_resno']}','{$_POST['guest_origin']}','online', '{$_POST['guest_title']}', '{$_POST['guest_fname']}', '{$_POST['guest_lname']}','{$_POST['guest_address']}', '{$_POST['guest_identity']}', '{$_POST['guest_tel1']}', '{$_POST['guest_tel2']}', '{$_POST['guest_country']}','{$_POST['guest_email']}', '{$_POST['arrival_date']}', '{$_POST['depature_date']}', '{$_POST['no_guest']}', '{$_POST['rcat_id']}', '{$_POST['lcat_id']}', '{$_POST['rbasic_id']}','{$_POST['no_rooms']}', '1');", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'edit_agent_details') {
        $edit_agent = $_POST['edt_agent'];
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
WHERE
ht_agent_reg.agent_id = '{$edit_agent}'");
    } else if ($_POST['action'] == 'agent_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_agent_reg` SET `agent_type`='{$_POST['agent_type_comboBox']}', `agent_reg_no`='{$_POST['agent_reg_no']}', `agent_tel1`='{$_POST['agent_tel_1']}', `agent_tel2`='{$_POST['agent_tel_2']}', `agent_fax`='{$_POST['agent_fax']}', `agent_web`='{$_POST['agent_web']}', `agent_email`='{$_POST['agent_email']}', `agent_contact_person`='{$_POST['agent_con_person']}', `agent_contactp_tel`='{$_POST['agent_con_person_tel']}', `agent_name`='{$_POST['agent_name']}', `agent_address`='{$_POST['agent_address']}' WHERE (`agent_id`='{$_POST['agent_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_agent_details') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_agent_reg` WHERE `agent_id` = '{$_POST['dlt_agent']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    } else if ($_POST['action'] == 'edit_rest_main_cat') {
        $r_main_cat = $_POST['edt_r_main_id'];
        $system->prepareSelectQueryForJSON("SELECT
	ht_rest_main_cat.rest_main_cat_id,
	ht_rest_main_cat.rest_main_cat_name
FROM
	ht_rest_main_cat
WHERE
ht_rest_main_cat.rest_main_cat_id = '{$r_main_cat }'");
    } else if ($_POST['action'] == 'edit_sys_main_cat') {
        $sys_main_cat = $_POST['edt_sys_main_id'];
        $system->prepareSelectQueryForJSON("SELECT
	ht_sys_cat.sys_cat_aid,
	ht_sys_cat.sys_category_name
FROM
	ht_sys_cat
WHERE
	ht_sys_cat.sys_cat_status = '1'
AND ht_sys_cat.sys_cat_aid = '{$sys_main_cat }'");
    } else if ($_POST['action'] == 'delete_rmaincat_details') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_rest_main_cat` WHERE `rest_main_cat_id` = '{$_POST['dlte_rmain']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    } else if ($_POST['action'] == 'rest_main_cat_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_rest_main_cat` SET `rest_main_cat_name`='{$_POST['rest_maincat']}' WHERE (`rest_main_cat_id`='{$_POST['re_mcat_id']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'sys_main_cat_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_sys_cat` SET `sys_category_name`='{$_POST['sys_maincat']}' WHERE (`sys_cat_aid`='{$_POST['sys_mcat_id']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_sysmaincat_details') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_sys_cat` WHERE `sys_cat_aid` = '{$_POST['dlte_sysmain']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }
    //    sampath wijesinghe
    elseif ($_POST['action'] == 'item_reg_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_bar_item_reg` (`bar_sub_cat_id`, `bar_item_reg_code`, `bar_item_reg_group`, `bar_item_reg_unit`, `bar_item_reg_exp_date`, `bar_item_reg_reorder`, `bar_item_reg_status`, `bar_item_reg_amount`, `bar_item_reg_capacity`) VALUES ('{$_POST['b_sub_comboBox']}', '{$_POST['bar_item_cde']}', '{$_POST['bar_itm_grp']}', '{$_POST['bar_unts']}', '{$_POST['bar_exp_date']}', '{$_POST['barreorder']}', '0', '{$_POST['bar_amount']}', '{$_POST['bar_capacity']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'item_reg_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_bar_item_reg` SET `bar_sub_cat_id`='{$_POST['b_sub_comboBox']}', `bar_item_reg_code`='{$_POST['bar_item_cde']}', `bar_item_reg_group`='{$_POST['bar_itm_grp']}', `bar_item_reg_unit`='{$_POST['bar_unts']}', `bar_item_reg_exp_date`='{$_POST['bar_exp_date']}', `bar_item_reg_reorder`='{$_POST['barreorder']}', `bar_item_reg_status`='0', `bar_item_reg_amount`='{$_POST['bar_amount']}', `bar_item_reg_capacity`='{$_POST['bar_capacity']}' WHERE (`bar_item_reg_id`='{$_POST['bar_item_reg_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'edit_bar_item_reg_details') {
        $b_item_id = $_POST['b_item_id'];
        $system->prepareSelectQueryForJSON("SELECT
ht_bar_item_reg.bar_item_reg_id,
ht_bar_item_reg.bar_sub_cat_id,
ht_bar_item_reg.bar_item_reg_code,
ht_bar_item_reg.bar_item_reg_group,
ht_bar_item_reg.bar_item_reg_unit,
ht_bar_item_reg.bar_item_reg_exp_date,
ht_bar_item_reg.bar_item_reg_reorder,
ht_bar_item_reg.bar_item_reg_status,
ht_bar_item_reg.bar_item_reg_amount,
ht_bar_item_reg.bar_item_reg_capacity,
ht_bar_sub_cat.main_cat_id
FROM
ht_bar_item_reg
INNER JOIN ht_bar_sub_cat ON ht_bar_item_reg.bar_sub_cat_id = ht_bar_sub_cat.bar_sub_cat_id
WHERE
ht_bar_item_reg.bar_item_reg_id = '{$b_item_id}'");
    } else if ($_POST['action'] == 'delete_bar_item_reg_details') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_bar_item_reg` WHERE `bar_item_reg_id` = '{$_POST['b_item_del_id']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }

//    -----Mr.Wasantha Kumara ** ----------Sub cat rest functions---------------------
    elseif ($_POST['action'] == 'rest_sub_cat_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_rest_sub_cat` (`rest_main_cat_id`, `rest_item_name`) VALUES ('{$_POST['r_maincats']}', '{$_POST['r_subcat']}')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } else if ($_POST['action'] == 'edit_rest_sub_cat') {
        $r_sub_cat = $_POST['r_subitm_id'];
        $system->prepareSelectQueryForJSON("SELECT
	ht_rest_sub_cat.rest_item_id,
	ht_rest_sub_cat.rest_main_cat_id,
	ht_rest_sub_cat.rest_item_name
FROM
	ht_rest_sub_cat
WHERE
ht_rest_sub_cat.rest_item_id = '{$r_sub_cat }'");
    } else if ($_POST['action'] == 'rest_sub_cat_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_rest_sub_cat` SET `rest_main_cat_id`='{$_POST['r_maincats']}', `rest_item_name`='{$_POST['r_subcat']}' WHERE (`rest_item_id`='{$_POST['r_subcat_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'delete_rest_sub_category') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_rest_sub_cat` WHERE `rest_item_id` = '{$_POST['del_rsubcat_id']}'", "Successfully Deleted", "Sorry Could Not Be Deleted");
    }

    //cholitha
    //-----------------cholitha-------------------------------------
    elseif ($_POST['action'] == 'laundry_main_category') {
        if (empty($_POST['main_category'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Please add laundry category")));
            return;
        }
        $data = array(
            'laundry_maincat_name' => $_POST['main_category']
        );
        $query = $system->Prepare_insert("ht_laundry_maincat", $data);
        $system->prepareCommandQueryForAlertify($query, "Successfully saved !", "System error !");
    } elseif ($_POST['action'] == 'get_laundry_details') {
        $system->prepareSelectQueryForJSON("SELECT
ht_laundry_maincat.laundry_maincat_id,
ht_laundry_maincat.laundry_maincat_name
FROM `ht_laundry_maincat`
WHERE
ht_laundry_maincat.laundry_maincat_id = '{$_POST['main_cat_id']}'");
    } elseif ($_POST['action'] == 'update_laundry_category') {
        if (empty($_POST['cat_name'])) {
            echo json_encode(array(array("msgType" => 2, "msg" => "Please add laundry category")));
            return;
        }
        $query = "UPDATE `ht_laundry_maincat` SET `laundry_maincat_name` = '{$_POST['cat_name']}' WHERE (`laundry_maincat_id` = '{$_POST['main_cat_id']}');";
        $system->prepareCommandQueryForAlertify($query, "Successfully updated !", "System error !");
    } elseif ($_POST['action'] == 'delete_laundry_category') {
        $query = "DELETE FROM `ht_laundry_maincat` WHERE `laundry_maincat_id` = '{$_POST['laundry_cat_id']}'";
        $system->prepareCommandQueryForAlertify($query, "Successfully deleted !", "System error !");
    } else if ($_POST['action'] == 'add_laundry_cloths') {
        $data_array = array(
            'laundry_maincat_id' => $_POST['laundry_cloth_cat'],
            'cloth_item' => $_POST['laundry_cloth_itm'],
            'cloth_laundry_price' => $_POST['cloth_lundry_prize'],
            'cloth_pressing_price' => $_POST['cloth_pres_prize']
        );
        $Quary = $system->Prepare_insert('ht_laundry_cloths', $data_array);
        $system->prepareCommandQueryForAlertify($Quary, "Successfully saved !", "System error !");
    } elseif ($_POST['action'] == 'get_laundry_types') {
        $system->prepareSelectQueryForJSON("SELECT
ht_laundry_cloths.cloth_id,
ht_laundry_cloths.cloth_item,
ht_laundry_cloths.cloth_laundry_price,
ht_laundry_cloths.cloth_pressing_price,
ht_laundry_cloths.laundry_maincat_id
FROM
ht_laundry_cloths
WHERE
ht_laundry_cloths.cloth_id = '{$_POST['cloth_cat_id']}'");
    } elseif ($_POST['action'] == 'update_laundry_details') {
        $system->prepareCommandQueryForAlertify("UPDATE `hotel_mgmt`.`ht_laundry_cloths`
SET `laundry_maincat_id` = '{$_POST['laundry_cloth_cat']}',
 `cloth_item` = '{$_POST['laundry_cloth_itm']}',
 `cloth_laundry_price` = '{$_POST['cloth_lundry_prize']}',
 `cloth_pressing_price` = '{$_POST['cloth_pres_prize']}'
WHERE
	(`cloth_id` = '{$_POST['laundry_id']}');", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } elseif ($_POST['action'] == 'remove_laundry') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_laundry_cloths` WHERE `cloth_id` = '{$_POST['laundry_id']}'", "Successfully deleted !", "System error !");
    }
    //    sampath wijesinghe
    elseif ($_POST['action'] == 'rest_item_reg_save') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_ala_carte` (`ala_carte_code`, `rest_item_id`, `ala_carte_item_name`, `ala_carte_price`, `ala_carte_cat_group`, `ala_carte_status`) VALUES ('{$_POST['rest_item_cde']}', '{$_POST['r_sub_comboBox']}', '{$_POST['rest_item_name']}', '{$_POST['rest_item_price']}', '{$_POST['rest_itm_grp']}', '0')", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } elseif ($_POST['action'] == 'edit_rest_item_reg_details') {
        $system->prepareSelectQueryForJSON("SELECT
ht_ala_carte.ala_carte_code,
ht_ala_carte.rest_item_id,
ht_ala_carte.ala_carte_item_name,
ht_ala_carte.ala_carte_price,
ht_ala_carte.ala_carte_cat_group,
ht_ala_carte.ala_carte_status,
ht_ala_carte.ala_carte_id,
ht_rest_sub_cat.rest_main_cat_id
FROM
ht_ala_carte
INNER JOIN ht_rest_sub_cat ON ht_ala_carte.rest_item_id = ht_rest_sub_cat.rest_item_id
WHERE
ht_ala_carte.ala_carte_id = '{$_POST['alacrt_id']}'");
    } else if ($_POST['action'] == 'rest_item_reg_update') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_ala_carte` SET `ala_carte_code`='{$_POST['rest_item_cde']}', `rest_item_id`='{$_POST['r_sub_comboBox']}', `ala_carte_item_name`='{$_POST['rest_item_name']}', `ala_carte_price`='{$_POST['rest_item_price']}', `ala_carte_cat_group`='{$_POST['rest_itm_grp']}', `ala_carte_status`='0' WHERE (`ala_carte_id`='{$_POST['rest_item_reg_hid']}');
", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } elseif ($_POST['action'] == 'delete_alacrt_details') {
        $system->prepareCommandQueryForAlertify("DELETE FROM `ht_ala_carte` WHERE `ala_carte_id` = '{$_POST['dlte_alacart']}'", "Successfully deleted !", "System error !");
    } elseif ($_POST['action'] == 'chck_items') {
        $system->prepareSelectQueryForJSONSingleData("SELECT
COUNT(ht_currency.currency_status) as tcount
FROM
ht_currency
WHERE
ht_currency.currency_status = '1'");
    } elseif ($_POST['action'] == 'get_data_related_to_reg_id') {
        $system->prepareSelectQueryForJSONSingleData("SELECT
ht_guest_reg.guest_id,
ht_guest_reg.reservation_no,
ht_guest_reg.guest_origin,
ht_guest_reg.guest_booking_method,
ht_guest_reg.guest_title,
ht_guest_reg.guset_fname,
ht_guest_reg.guset_lname,
ht_guest_reg.guest_address,
ht_guest_reg.guest_identity,
ht_guest_reg.guest_tel1,
ht_guest_reg.guest_tel2,
ht_guest_reg.guest_country,
ht_guest_reg.guest_email,
ht_guest_reg.guest_arrival_date,
ht_guest_reg.guest_departure_date,
ht_guest_reg.no_of_visits,
ht_guest_reg.guest_room_cat_id,
ht_guest_reg.guest_room_livin_id,
ht_guest_reg.guest_basic_id,
ht_guest_reg.no_rooms
FROM
ht_guest_reg
WHERE
ht_guest_reg.reservation_no = '{$_POST['reg_id']}'");
    } else if ($_POST['action'] == 'update_guest_reg_details') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_guest_reg` SET  `guset_fname`='{$_POST['guest_fname']}', 
`guset_lname`='{$_POST['guest_lname']}', 
`guest_address`='{$_POST['guest_add']}', 
`guest_identity`='{$_POST['guest_id']}', 
`guest_tel1`='{$_POST['guest_t1']}', 
`guest_tel2`='{$_POST['guest_t2']}', 
`guest_country`='{$_POST['guest_country']}', 
`guest_email`='{$_POST['guest_email']}', 
`guest_arrival_date`='{$_POST['guest_ardate']}', 
`guest_departure_date`='{$_POST['guest_ddate']}', 
`no_of_visits`='{$_POST['guest_no']}', 
`guest_room_cat_id`='{$_POST['rcat_id']}', 
`guest_room_livin_id`='{$_POST['lcat_id']}', 
`guest_basic_id`='{$_POST['rbasic_id']}', 
`no_rooms`='{$_POST['guest_nor']}' WHERE (`guest_id`='{$_POST['guest_hidden']}');", "Successfully Updated", "Sorry ! Could Not Be Updated");
    } else if ($_POST['action'] == 'sundry_details') {
        $system->prepareSelectQueryForJSON("SELECT
ht_sundry.sundry_id,
ht_sundry.sundry_rm_no,
ht_sundry.sundry_date,
ht_sundry.sundry_time,
ht_sundry.sundry_price,
ht_sundry.sundry_discount,
ht_sundry.sundry_desc,
ht_sundry.sundry_tel,
ht_sundry.sundry_guest_type
FROM
ht_sundry
WHERE
ht_sundry.sundry_reg_id = '{$_POST['sundry']}'");
    } else if ($_POST['action'] == 'next_resave') {
        $system->prepareSelectQueryForJSON("SELECT ht_guest_reg.guest_id,
CONCAT('00',max(ht_guest_reg.guest_id)+1)as id
FROM
ht_guest_reg");
    } else if ($_POST['action'] == 'getcus_details') {
        $system->prepareSelectQueryForJSON("SELECT
ht_guest_reg.guest_room_cat_id,
ht_guest_reg.reservation_no,
ht_guest_reg.no_rooms,
ht_guest_reg.guest_id,
ht_guest_reg.gust_advance,
ht_sys_code.sys_name,
COUNT(ht_create_rm.create_rm_no) as noroom
FROM
ht_guest_reg
INNER JOIN ht_sys_code ON ht_guest_reg.guest_room_cat_id = ht_sys_code.sys_id
INNER JOIN ht_create_rm ON ht_sys_code.sys_id = ht_create_rm.rm_cat_id
WHERE
ht_create_rm.create_rm_status ='0'  AND
ht_guest_reg.guest_id = '{$_POST['id']}'");
    } elseif ($_POST['action'] == 'room_book') {
        $system->prepareCommandQueryForAlertify("INSERT INTO `ht_rm_reserv` (`guest_id`, `rm_create_rm_id`) VALUES ('{$_POST['ges_id']}','{$_POST['room_id']}');", "Successfully Saved", "Sorry ..! Could Not Be Saved");
    } elseif ($_POST['action'] == 'u_room_book') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_create_rm` SET  `create_rm_status`='1',`g_id`='{$_POST['ges_id']}' WHERE (create_rm_id='{$_POST['room_id']}');", "room update Completed", "room update Could Not Be Saved");
    } elseif ($_POST['action'] == 'adv_pay') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_guest_reg` SET  `gust_advance`='{$_POST['adv_amt']}' WHERE (guest_id='{$_POST['g_id']}');", "Advance Pay Successfully", "Advance Pay Could Not Be Completed");
    } elseif ($_POST['action'] == 'con_ck') {
        $g_id = $_POST['g_id'];
        $system->prepareSelectQueryForJSON("SELECT
hotel.ht_guest_reg.guest_id,
hotel.ht_guest_reg.guest_status,
hotel.ht_guest_reg.no_rooms,
COUNT(hotel.ht_guest_reg.no_rooms)as tot,
(hotel.ht_guest_reg.no_rooms - COUNT(hotel.ht_guest_reg.no_rooms)) as diff_room
FROM
hotel.ht_guest_reg
INNER JOIN hotel.ht_rm_reserv ON hotel.ht_rm_reserv.guest_id = hotel.ht_guest_reg.guest_id
WHERE
hotel.ht_rm_reserv.reserv_st = 0 AND
hotel.ht_guest_reg.guest_id =  '{$g_id}'");
    } elseif ($_POST['action'] == 'con_res') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_guest_reg` SET  `guest_status`='3' WHERE (guest_id='{$_POST['g_id']}');", "Room Reservation Successfully Completed", "Reservation Could Not Be Completed");
    } elseif ($_POST['action'] == 'con_book') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_guest_reg` SET  `guest_status`='2' WHERE (guest_id='{$_POST['g_id']}');", "Booking Conform Successfully Completed", "Reservation Could Not Be Completed");
    } elseif ($_POST['action'] == 'cancle_book') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_guest_reg` SET  `guest_status`='0' WHERE (guest_id='{$_POST['gid']}');", "Booking Cancle Completed", "Booking Could Not Be Cancle");
    } else if ($_POST['action'] == 'room_price_details') {
        $system->prepareSelectQueryForJSON("SELECT
ht_room_price.rm_price
FROM
ht_room_price
WHERE
ht_room_price.rm_typid = '{$_POST['rcat_id']}' AND
ht_room_price.rm_licid = '{$_POST['lcat_id']}' AND
ht_room_price.rm_basic = '{$_POST['rbasic_id']}'");
    } else if ($_POST['action'] == 'gest_details') {
        $system->prepareSelectQueryForJSON("SELECT
ht_guest_reg.guest_id,
ht_guest_reg.reservation_no,
CONCAT(ht_guest_reg.guest_title,' ',ht_guest_reg.guset_fname,' ',ht_guest_reg.guset_lname) AS gst_name,
DATEDIFF(ht_guest_reg.guest_departure_date,ht_guest_reg.guest_arrival_date) AS date_dff,
ht_guest_reg.guest_arrival_date,
ht_guest_reg.guest_departure_date,
ht_guest_reg.no_rooms,
ht_guest_reg.gust_advance,
ht_guest_reg.guest_room_cat_id,
ht_guest_reg.guest_room_livin_id,
ht_guest_reg.guest_basic_id,
(ht_room_price.rm_price*DATEDIFF(ht_guest_reg.guest_departure_date,ht_guest_reg.guest_arrival_date)*ht_guest_reg.no_rooms) as tot_roomponly,
((ht_room_price.rm_price*DATEDIFF(ht_guest_reg.guest_departure_date,ht_guest_reg.guest_arrival_date)*ht_guest_reg.no_rooms)- ht_guest_reg.gust_advance) as arrs_amt,
ht_room_price.rm_price
FROM
ht_guest_reg
INNER JOIN ht_rm_reserv ON ht_rm_reserv.guest_id = ht_guest_reg.guest_id
LEFT OUTER JOIN ht_create_rm ON ht_rm_reserv.rm_create_rm_id = ht_create_rm.create_rm_id
INNER JOIN ht_room_price ON ht_room_price.rm_typid = ht_guest_reg.guest_room_cat_id AND ht_room_price.rm_licid = ht_guest_reg.guest_room_livin_id AND ht_room_price.rm_basic = ht_guest_reg.guest_basic_id
WHERE
ht_guest_reg.guest_status = 3 AND
ht_rm_reserv.reserv_st = 0 AND
ht_create_rm.create_rm_status = 1 AND
ht_guest_reg.guest_id = '{$_POST['id']}'
GROUP BY
ht_rm_reserv.guest_id");
    } elseif ($_POST['action'] == 'bill_pay') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_guest_reg` SET `guest_status`='4', `total_payed`='{$_POST['bill_t']}', `bill_payed_date`=CURRENT_DATE`() WHERE (`guest_id`='{$_POST['id']}');", "Bill Payed Successfully Completed", "Bill Payed Could Not Be Completed");
    } elseif ($_POST['action'] == 'completed_reservation') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_rm_reserv` SET `reserv_st`='1' WHERE ( `guest_id`='{$_POST['id']}');", "Reservation Successfully Completed", "Reservation Could Not Be Completed");
    } elseif ($_POST['action'] == 'reless_room') {
        $system->prepareCommandQueryForAlertify("UPDATE `ht_create_rm` SET `create_rm_status`='0' WHERE (`g_id`='{$_POST['id']}');", "Room Releas Successfully Completed", "Room Releas Could Not Be Completed");
    }
}

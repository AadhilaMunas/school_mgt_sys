<?php

class settings {

    function prepareSelectQueryForJSON($query) {
        $data = array();
        $result = mysql_query($query)or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    function getNextAutoIncrementID($table) {
        $result = mysql_query("SHOW TABLE STATUS LIKE '" . $table . "'");
        $row = mysql_fetch_array($result);
        return $nextId = $row['Auto_increment'];
    }

    function getFirstKey($arr) {
        reset($arr);
        return key($arr);
    }

    function prepareAjaxSelectBox($array, $value_name, $data_name, $selectedValue = false, $error_msg = ' -- No Data Found -- ') {
        if (!empty($array)) {
            foreach ($array as $data) {
                if (isset($selectedValue) && $data[$value_name] == $selectedValue) {
                    echo '<option value="' . $data[$value_name] . '" selected>' . $data[$data_name] . '</option>';
                } else {
                    echo '<option value="' . $data[$value_name] . '">' . $data[$data_name] . '</option>';
                }
            }
        } else {
            echo '<option value="0">' . $error_msg . '</option>';
        }
    }

    function autoRedict($redirectPath, $time) {
        echo '<script type="text/javascript">
		window.setTimeout(function() {
		window.location.href = "' . $redirectPath . '";
		},' . $time . ')
             </script>';
    }

    function prepareSelectQuery($query) {
        $data = array();
        $result = mysql_query($query) or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function prepareRowCountQuery($query) {
        $data = array();
        $result = mysql_query($query) or die(mysql_error());
        $count = mysql_num_rows($result);
        return $count;
    }

    function prepareCommandQuery($query, $successMsg, $errorMsg) {
        $save = mysql_query($query);
        if (isset($save) && $save) {
            echo '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> ' . $successMsg . ' </div>';
        } else {
            echo '<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error!</strong> ' . $errorMsg . ' </div>';
        }
    }

    function prepareCommandQueryForAlertify($query, $successMsg, $errorMsg) {
        $save = mysql_query($query) or die(mysql_error());
        if (isset($save) && $save) {
            echo json_encode(array(array("msgType" => 1, "msg" => $successMsg)));
        } else {
            echo json_encode(array(array("msgType" => 2, "msg" => $errorMsg)));
        }
    }

    function prepareQueryCount($tableName) {
        $count = 0;
        $query = "SELECT COUNT(*) as count FROM " . $tableName;
        $countData = $this->getSelectQuaryForAllData($query);
        return $countData[0]['count'];
    }

    function prepareQueryCountByCondition($tableName, $colName, $colValue) {
        $count = 0;
        $query = "SELECT COUNT(*) as count FROM " . $tableName . " WHERE " . $colName . " = '" . $colValue . "'";
        return $countData[0]['count'];
    }

    function getallitemtypefor_combo() {
        $data = array();
        $result = mysql_query("SELECT
pr_emp_item_types.id,
pr_emp_item_types.name
FROM
pr_emp_item_types");
        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function prepareCommandQuerySpecial($query) {
        $save = mysql_query($query)or die(mysql_error());
        if (isset($save) && $save) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function prepareSelectQueryForJSONSingleData($query) {
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        echo json_encode($row);
    }

}

class get_data {

    function PresantationTypes() {
        $data = array();
        $result = mysql_query("SELECT
item_subcat1.main_item_cat,
item_subcat1.subcat1_name,
item_subcat1.subcat1_id
FROM
item_subcat1");
        while ($row = mysql_fetch_assoc($result)) {
            $data[$row['subcat1_id']] = array(
                'name' => $row['subcat1_name'],
                'items' => array()
            );
        }
        return $data;
    }

//-------------------------Supplers cat........................................
    function Presantation_Suppnames($repot_month, $repot_year) {
        $data = array();
        $result = mysql_query("SELECT 
r_suplier_reg.sup_name,
r_suplier_reg.sup_id,
SUM(r_grn_itm_data.grn_itm_tot_cost) as month_tot_purces,
r_suplier_reg.sup_id,
SUM(r_grn_itm_data.grn_ini_qty * r_grn_itm_data.initial_retail_price) as month_retail_tot_price
FROM
r_grn_data
INNER JOIN r_grn_itm_data ON r_grn_data.grn_no = r_grn_itm_data.grn_no
INNER JOIN r_suplier_reg ON r_grn_data.grn_sup_id = r_suplier_reg.sup_id
WHERE
MONTH(grn_date) = '{$repot_month}' AND
YEAR(grn_date) = '{$repot_year}'
GROUP BY
r_suplier_reg.sup_name");
        while ($row = mysql_fetch_assoc($result)) {
            $data[$row['sup_id']] = array(
                'name' => $row['sup_name'],
                'mtot_purch' => $row['month_tot_purces'],
                'mtot_retail' => $row['month_retail_tot_price'],
                'grns' => array()
            );
        }

        return $data;
    }

//---------------------------transfer out summary Report main cats---------------------------
    function Presantation_transfer_outcat($date_1, $date_2) {
        $data = array();
        $result = mysql_query("SELECT
sum(itm_transfer_details.retail_price*itm_transfer_details.qty) as tot_rows_retail,
sum(itm_transfer_details.destination_price*itm_transfer_details.qty) as tot_rows_desti,
destinations.destination_id,
destinations.dest_name
FROM
itm_transfer_details
INNER JOIN destinations ON itm_transfer_details.destination_id = destinations.destination_id
WHERE
itm_transfer_details.tra_date BETWEEN '{$date_1}' AND '{$date_2}'
GROUP BY
itm_transfer_details.destination_id
ORDER BY
itm_transfer_details.transfer_id ASC");
        while ($row = mysql_fetch_assoc($result)) {
            $data[$row['destination_id']] = array(
                'dest_name' => $row['dest_name'],
                'destot_retail' => $row['tot_rows_retail'],
                'destot_desti' => $row['tot_rows_desti'],
                'destin' => array()
            );
        }
        return $data;
    }

//----------------------------main cat and row totals for F16D report---------------------------
    function Presantation_F16D($repot_month, $repot_year) {
        $data = array();
        $result = mysql_query("SELECT
DAY(r_grn_data.grn_date) as day,
Sum(r_grn_data.grn_total) AS daytot_ws,
Sum(r_grn_data.discount) AS day_totdiscount,
sum(r_grn_data.grn_total-r_grn_data.discount) AS day_total,
Sum(IFNULL(r_grn_itm_data.grn_itm_tot_cost,0) /IFNULL((r_grn_itm_data.grn_ini_qty - r_grn_itm_data.free_qntty),0)*r_grn_itm_data.free_qntty) AS day_free_issuestot,
Sum(r_grn_itm_data.initial_retail_price*r_grn_itm_data.grn_ini_qty) AS daytot_retailprice,
r_grn_data.grn_no,
r_grn_data.grn_date
FROM
r_grn_data
INNER JOIN r_grn_itm_data ON r_grn_itm_data.grn_no = r_grn_data.grn_no 
WHERE MONTH(r_grn_data.grn_date) = '{$repot_month}' AND YEAR(r_grn_data.grn_date) = '{$repot_year}'
AND r_grn_itm_data.grn_no > '0'
GROUP BY
r_grn_data.grn_date");
        while ($row = mysql_fetch_assoc($result)) {
            $data[$row['day']] = array(
                'date' => $row['day'],
                'daytot_ws' => $row['daytot_ws'],
                'daytot_dis' => $row['day_totdiscount'],
                'dattot_tatal' => $row['day_total'],
                'daytot_freis' => $row['day_free_issuestot'],
                'daytot_retail' => $row['daytot_retailprice'],
                'dates_detail' => array()
            );
        }

        return $data;
    }

    function ThereputicTypes() {
        $data = array();
        $result = mysql_query("SELECT
item_subcat2.subcat2_id,
item_subcat2.subcat2_name
FROM `item_subcat2`");
        while ($row = mysql_fetch_assoc($result)) {
            $data[$row['subcat2_id']] = array(
                'th_name' => $row['subcat2_name'],
                'cat2' => array()
            );
        }
        return $data;
    }

}

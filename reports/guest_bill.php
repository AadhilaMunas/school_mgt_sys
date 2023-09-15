<?php
include("../config/dbc.php");
include("../commen_functions.php");
$settings = new settings();
//=============================================================
//=============================================================
if (isset($_POST['id'])) {
    $query1 = mysql_query("SELECT
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
(ht_room_price.rm_price*DATEDIFF(ht_guest_reg.guest_departure_date,ht_guest_reg.guest_arrival_date)*ht_guest_reg.no_rooms) AS tot_roomponly,
((ht_room_price.rm_price*DATEDIFF(ht_guest_reg.guest_departure_date,ht_guest_reg.guest_arrival_date)*ht_guest_reg.no_rooms)- ht_guest_reg.gust_advance) AS arrs_amt,
ht_room_price.rm_price,
ht_guest_reg.guest_origin,
ht_guest_reg.guest_booking_method,
ht_guest_reg.guest_identity,
ht_guest_reg.guest_tel1,
ht_guest_reg.guest_country,
ht_sys_code.sys_name
FROM
ht_guest_reg
INNER JOIN ht_rm_reserv ON ht_rm_reserv.guest_id = ht_guest_reg.guest_id
LEFT OUTER JOIN ht_create_rm ON ht_rm_reserv.rm_create_rm_id = ht_create_rm.create_rm_id
INNER JOIN ht_room_price ON ht_room_price.rm_typid = ht_guest_reg.guest_room_cat_id AND ht_room_price.rm_licid = ht_guest_reg.guest_room_livin_id AND ht_room_price.rm_basic = ht_guest_reg.guest_basic_id
INNER JOIN ht_sys_code ON ht_room_price.rm_typid = ht_sys_code.sys_id
WHERE
ht_guest_reg.guest_status = 4 AND
ht_rm_reserv.reserv_st = 1 AND
ht_create_rm.create_rm_status = 1 AND
ht_guest_reg.guest_id = '{$_POST['id']}'
GROUP BY
ht_rm_reserv.guest_id ");
    while ($row = mysql_fetch_assoc($query1)) {
        $report_data[] = $row;
    }
    $default_page_break = 20;
    $first_pageBreak = 15;
    $totalPages = ceil(count($report_data) / $default_page_break);
}
$thead = "<thead>
    <th style=\"width: 0.5cm\">&nbsp;</th>
    <th style=\"width: 10cm\">Item Name</th>
    <th style=\"width: 3cm\">Required</th>
    <th style=\"width: 3cm\">Remaining</th>
</thead>";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> - Pinnaland Hotel  - </title>
        <style type="text/css">
            @media Print {
                .displayHide{
                    display: none;
                }
            }

            table {
                width: 100%;
            }
            table, td, th {
                border: 1px solid #999999;
                font-size: 10pt;
            }

            td,th {
                padding: 5px;
            }
            .page-breaker {
                page-break-after: always;
            }
            table{
                border-collapse: collapse;
            }
            thead{
                font-weight: bold;
            }
            .head{
                border-style:groove;padding: 3pt;
            }
        </style>

    </head>
    <body>
        <?php // echo print_r($_POST); ?>
        <div style="margin: 20px; width: 40%;" class="displayHide">
            <a href="../purchase_order.php"><button type="submit" >Back</button></a>
            <button class="print" type="button" onclick="window.print();">Print Document</button>
        </div>
        <div style="float: right;">
            <span class="head"><strong>Pinnalanda Gotel Guest Bill </strong></span><br><br><br>
            <span><strong>Guest ID:</strong></span><span><?php echo $_POST['id']; ?></span><br>
            <span><strong>Reservation No:</strong></span><span><?php
                session_start();
                echo $_SESSION['branch_name'];
                ?></span><br>
            <span><strong>Prepared Date:</strong></span><span><?php echo $suppler_details[0]['create_date']; ?></span><br>
            <span><strong>Required Date:</strong></span><span><?php echo $suppler_details[0]['reuire_date']; ?></span><br><br><br>

        </div>
        <div>
            <div>
                <span style="font-size: 15px;"><strong>Co-operative Hospital Society.Ltd,</strong></span><br>
                <span>No. 303, Colombo Road, Kurunegala</span><br>
                <span>Tel. 037-2222464, Fax- 037-2232242</span><br>
                <hr style="width: 20%;float: left;"><br>
            </div>
        </div>
        <div>
            <span style="font-weight: bold;">Supplier</span><br>
            <div style="margin-left: 10pt;">
                <?php echo $suppler_details[0]['sup_name']; ?><br>
                <?php echo $suppler_details[0]['sup_address']; ?>
                <br>Tel.&nbsp;&nbsp; <?php echo $suppler_details[0]['sup_tp']; ?><br>
            </div>
        </div>
        <table>
            <?php echo $thead; ?><tbody>
                <?php
                if (isset($_POST['po_num'])) {// ----- if form submit
                    if (!empty($report_data)) {
                        $PAGE_ROW_COUNT = 0;
                        $TOT_ROW_COUNT = 0;
                        $PAGE_COUNT = 1;
                        foreach ($report_data as $inv) {
                            $PAGE_ROW_COUNT++;
                            $TOT_ROW_COUNT++;
                            echo "<tr>
                        <td>" . $TOT_ROW_COUNT . "</td>
                        <td>{$inv['Item_name']}</td>
                        <td style='text-align: center;'>{$inv['po_req_qty']}</td>
                        <td style='text-align: center;'>{$inv['po_rem_qty']}</td>
                        </tr>";
                            if (($PAGE_ROW_COUNT == $default_page_break) || ($TOT_ROW_COUNT == $first_pageBreak)) {
                                $PAGE_ROW_COUNT = 0;
                                echo "</tbody>";

                                echo "</table><div style='text-align: right;'>page {$PAGE_COUNT} of {$totalPages}</div><div class=\"page-breaker\"></div><table>" . $thead . "<tbody>";
                                $PAGE_COUNT++;
                            }
                        }
                    } else {
                        echo "<tr><td colspan='9' style='text-align:center;'>No Recrords Found..</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align:center;'>No Recrords Found..</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div style="margin-top: 10px;">
            <span>................................................................................................................................................................................................................................................... <br>
                I, The store in-charge, hereby declare that the aforementioned items were received with due care and attention.</span>
            <span>For Office Use</span><br><br>
            <span>Approved By :.........................................</span><br>
            <span>N/A</span>
        </div>
        <?php
        if (isset($_POST['po_num']) && !empty($report_data)) {
            echo "<div style='text-align: right;'>page {$PAGE_COUNT} of {$totalPages}</div>";
        }
        ?>

    </body>
</html>
<script src="../js/systemConfig.js"></script>

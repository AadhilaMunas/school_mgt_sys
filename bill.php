
<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <link rel="stylesheet" href="style.css">
        <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
        <script src="script.js"></script>
        <style>
            /* reset */

            *
            {
                border: 0;
                box-sizing: content-box;
                color: inherit;
                font-family: inherit;
                font-size: inherit;
                font-style: inherit;
                font-weight: inherit;
                line-height: inherit;
                list-style: none;
                margin: 0;
                padding: 0;
                text-decoration: none;
                vertical-align: top;
            }

            /* content editable */

            *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

            *[contenteditable] { cursor: pointer; }

            *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

            span[contenteditable] { display: inline-block; }

            /* heading */

            h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

            /* table */

            table { font-size: 75%; table-layout: fixed; width: 100%; }
            table { border-collapse: separate; border-spacing: 2px; }
            th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
            th, td { border-radius: 0.25em; border-style: solid; }
            th { background: #EEE; border-color: #BBB; }
            td { border-color: #DDD; }

            /* page */

            html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
            html { background: #999; cursor: default; }

            body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
            body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

            /* header */

            header { margin: 0 0 3em; }
            header:after { clear: both; content: ""; display: table; }

            header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; }
            header span, header img { display: block; float: right; }
            header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
            header img { max-height: 100%; max-width: 100%; }
            header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 3em; }
            article:after { clear: both; content: ""; display: table; }
            article h1 { clip: rect(0 0 0 0); position: absolute; }

            article address { float: left; font-size: 125%; font-weight: bold; }

            /* table meta & balance */

            table.meta, table.balance { float: right; width: 36%; }
            table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

            /* table meta */

            table.meta th { width: 40%; }
            table.meta td { width: 60%; }

            /* table items */

            table.inventory { clear: both; width: 100%; }
            table.inventory th { font-weight: bold; text-align: center; }

            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) { text-align: right; width: 12%; }
            table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }

            /* table balance */

            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }

            /* javascript */

            .add, .cut
            {
                border-width: 1px;
                display: block;
                font-size: .8rem;
                padding: 0.25em 0.5em;	
                float: left;
                text-align: center;
                width: 0.6em;
            }

            .add, .cut
            {
                background: #9AF;
                box-shadow: 0 1px 2px rgba(0,0,0,0.2);
                background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
                background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
                border-radius: 0.5em;
                border-color: #0076A3;
                color: #FFF;
                cursor: pointer;
                font-weight: bold;
                text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
            }

            .add { margin: -2.5em 0 0; }

            .add:hover { background: #00ADEE; }

            .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
            .cut { -webkit-transition: opacity 100ms ease-in; }

            tr:hover .cut { opacity: 1; }

            @media print {
                * { -webkit-print-color-adjust: exact; }
                html { background: none; padding: 0; }
                body { box-shadow: none; margin: 0; }
                span:empty { display: none; }
                .add, .cut { display: none; }
            }

            @page { margin: 0; }
        </style>

    </head>
    <body>




        <?php
        include './config/dbc.php';
        $conn = new MainConfig();
        session_start();


        $pid = $_POST['id'];



        $sql = "SELECT
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
ht_guest_reg.guest_id = '$pid'
GROUP BY
ht_rm_reserv.guest_id ";
        $re = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($re)) {
            $id = $row['guest_id'];
            $title = $row['title'];
            $fname = $row['gst_name'];
            $lname = $row['gst_name'];
            $troom = $row['troom'];
            $bed = $row['tbed'];
            $nroom = $row['nroom'];
            $cin = $row['cin'];
            $cout = $row['cout'];
            $meal = $row['meal'];
            $ttot = $row['ttot'];
            $mepr = $row['mepr'];
            $btot = $row['btot'];
            $fintot = $row['fintot'];
            $days = $row['noofdays'];
        }

        $type_of_room = 0;
        if ($troom == "Superior Room") {
            $type_of_room = 320;
        } else if ($troom == "Deluxe Room") {
            $type_of_room = 220;
        } else if ($troom == "Guest House") {
            $type_of_room = 180;
        } else if ($troom == "Single Room") {
            $type_of_room = 150;
        }

        if ($bed == "Single") {
            $type_of_bed = $type_of_room * 1 / 100;
        } else if ($bed == "Double") {
            $type_of_bed = $type_of_room * 2 / 100;
        } else if ($bed == "Triple") {
            $type_of_bed = $type_of_room * 3 / 100;
        } else if ($bed == "Quad") {
            $type_of_bed = $type_of_room * 4 / 100;
        } else if ($bed == "None") {
            $type_of_bed = $type_of_room * 0 / 100;
        }

        if ($meal == "Room only") {
            $type_of_meal = $type_of_bed * 0;
        } else if ($meal == "Breakfast") {
            $type_of_meal = $type_of_bed * 2;
        } else if ($meal == "Half Board") {
            $type_of_meal = $type_of_bed * 3;
        } else if ($meal == "Full Board") {
            $type_of_meal = $type_of_bed * 4;
        }
        ?>
        <header>
            <h1>Invoice</h1>
            <address >
                <p>Hotel Pinnalanda,</p>
                <p>Pinnawala,<br>Rambukkana,<br>Sri Lanka.</p>
                <p>(+94) 035 2 266171</p>
            </address>
            <span><img alt="" src="assets/img/logo.png"></span>
        </header>
        <article>
            <h1>Recipient</h1>
            <address >
                <p><?php echo $title . $fname . " " . $lname ?> <br></p>
            </address>
            <table class="meta">
                <tr>
                    <th><span >Invoice #</span></th>
                    <td><span ><?php echo $id; ?></span></td>
                </tr>
                <tr>
                    <th><span >Date</span></th>
                    <td><span ><?php echo $cout; ?> </span></td>
                </tr>

            </table>
            <table class="inventory">
                <thead>
                    <tr>
                        <th><span >Item</span></th>
                        <th><span >No of Days</span></th>
                        <th><span >Rate</span></th>
                        <th><span >Quantity</span></th>
                        <th><span >Price</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span ><?php echo $troom; ?></span></td>
                        <td><span ><?php echo $days; ?> </span></td>
                        <td><span data-prefix>$</span><span ><?php echo $type_of_room; ?></span></td>
                        <td><span ><?php echo $nroom; ?> </span></td>
                        <td><span data-prefix>$</span><span><?php echo $ttot; ?></span></td>
                    </tr>
                    <tr>
                        <td><span ><?php echo $bed; ?>  Bed </span></td>
                        <td><span ><?php echo $days; ?></span></td>
                        <td><span data-prefix>$</span><span ><?php echo $type_of_bed; ?></span></td>
                        <td><span ><?php echo $nroom; ?> </span></td>
                        <td><span data-prefix>$</span><span><?php echo $btot; ?></span></td>
                    </tr>
                    <tr>
                        <td><span ><?php echo $meal; ?>  </span></td>
                        <td><span ><?php echo $days; ?></span></td>
                        <td><span data-prefix>$</span><span ><?php echo $type_of_meal ?></span></td>
                        <td><span ><?php echo $nroom; ?> </span></td>
                        <td><span data-prefix>$</span><span><?php echo $mepr; ?></span></td>
                    </tr>
                </tbody>
            </table>

            <table class="balance">
                <tr>
                    <th><span >Total</span></th>
                    <td><span data-prefix>$</span><span><?php echo $fintot; ?></span></td>
                </tr>
                <tr>
                    <th><span >Amount Paid</span></th>
                    <td><span data-prefix>$</span><span >0.00</span></td>
                </tr>
                <tr>
                    <th><span >Balance Due</span></th>
                    <td><span data-prefix>$</span><span><?php echo $fintot; ?></span></td>
                </tr>
            </table>
        </article>
        <aside>
            <h1><span >Contact us</span></h1>
            <div >
                <p align="center">Email :- info@Pinnalanda.com || Web :- www.Pinnalanda.com || Phone :- (+94) 035 2 266171 </p>
            </div>
        </aside>
    </body>
</html>

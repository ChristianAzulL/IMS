<?php 
error_reporting(E_ALL);
ini_set('max_execution_time', 300);
ini_set('memory_limit', '4G');
ini_set('display_errors', 1); 

include "../config/database.php";
include "../config/on_session.php";
require_once '../../vendor/autoload.php'; // mPDF

use Picqer\Barcode\BarcodeGeneratorPNG;

header('Content-Type: image/png');

// Sanitize GET inputs
$from = htmlspecialchars($_GET['from'] ?? '');
$to = htmlspecialchars($_GET['to'] ?? '');
$raw_category = $_GET['category'] ?? '';
$categories = explode(',', $_GET['category'] ?? '');
$escaped = array_map(fn($cat) => "'" . trim(htmlspecialchars($cat, ENT_QUOTES)) . "'", $categories);
$imploded_category = implode(',', $escaped);
$warehouse_transaction = htmlspecialchars($_GET['wh'] ?? '');

// echo $warehouse_transaction;


$bg_colors = ['bg-100', 'bg-200', 'bg-300', 'bg-400', 'bg-500', 'bg-600', 'table-primary', 'table-info', 'table-dark', 'table-warning', 'table-success'];
$grand_total_qty = 0;
$grand_total_unit_cost = 0;
$grand_total_gross = 0;
$grand_total_net = 0;
$num = 1;

echo $raw_category;

if(empty($raw_category) && empty($warehouse_transaction)){
    $category_additional_query = "AND ol.warehouse IN ($user_warehouse_id)";
    $item_additional_query = "AND ol.warehouse IN ($user_warehouse_id)";
    echo "ta";
} elseif(!empty($raw_category) && !empty($warehouse_transaction)) {
    $category_additional_query = "AND c.hashed_id IN ($raw_category) AND ol.warehouse = '$warehouse_transaction'";
    $item_additional_query = "AND ol.warehouse = '$warehouse_transaction'";
    echo "tang";
} elseif(empty($raw_category) && !empty($warehouse_transaction)) {
    $category_additional_query = "AND ol.warehouse = '$warehouse_transaction'";
    $item_additional_query = "AND ol.warehouse = '$warehouse_transaction'";
    echo "tangina";
}

if(empty($warehouse_transaction)){
    $ware_treans = $imploded_warehouse_names;
} else {
    $warehouse_trans_sql = "SELECT warehouse_name FROM warehouse WHERE hashed_id = '$warehouse_transaction' LIMIT 1";
    $warehouse_trans_res = $conn->query($warehouse_trans_sql);
    if($warehouse_trans_res->num_rows>0){
        $row = $warehouse_trans_res->fetch_assoc();
        $ware_treans = $row['warehouse_name'];
    } else {
        $ware_treans = "N/A";
    }
}

$response = array('success' => false, 'message' => 'Something went wrong.');
$table_rows = [];

if ($from && $to) {

    $category_query = "
    SELECT 
        c.hashed_id AS category_id,
        c.category_name,
        COUNT(oc.unique_barcode) AS outbounded_qty,
        SUM(s.capital) AS unit_cost,
        SUM(oc.sold_price) AS gross_sale
    FROM category c
    LEFT JOIN product p ON p.category = c.hashed_id
    LEFT JOIN stocks s ON s.product_id = p.hashed_id
    LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode
    LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
    WHERE
    s.item_status !=8
    AND DATE(ol.date_sent) BETWEEN '$from' AND '$to'
    $category_additional_query
    GROUP BY c.category_name
    ";

    echo $category_query;

    
    
    $category_result = $conn->query($category_query);
    if($category_result->num_rows>0){
        while($row=$category_result->fetch_assoc()){
            $random_bg = $bg_colors[array_rand($bg_colors)];
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            $outbound_qty = $row['outbounded_qty'];
            $sub_unit_cost = $row['unit_cost'];
            $sub_gross = $row['gross_sale'];
            $sub_netincome = $sub_gross - $sub_unit_cost;
            $grand_total_qty += $outbound_qty;
            $grand_total_unit_cost += $sub_unit_cost;
            $grand_total_gross += $sub_gross;
            $table_rows[] = '
            <tr class="' . $random_bg . '">
                <td class="fs-10">' . $num . '</td>
                <td class="fs-10" colspan="11">'. $category_name .'</td>
                <td class="fs-10 text-end">'. $outbound_qty .'</td>
                <td class="fs-10 text-end" style="width: 500px;">' . $sub_unit_cost .'</td>
                <td class="fs-10 text-end" style="width: 500px;">' . $sub_gross . '</td>
                <td class="fs-10 text-end" style="width: 500px;">' . $sub_netincome . '</td>
            </tr>
            <tr class="' . $random_bg . '">
                <td class="fs-11"><b></b></td>
                <td class="fs-11"><b>ORDER #</b></td>
                <td class="fs-11"><b>OUTBOUND #</b></td>
                <td class="fs-11"><b>CUSTOMER</b></td>
                <td class="fs-11"><b>OUTBOUND DATE</b></td>
                <td class="fs-11"><b>SUPPLIER</b></td>
                <td class="fs-11"><b>LOCAL/ IMPORT</b></td>
                <td class="fs-11"><b>DESCRIPTION</b></td>
                <td class="fs-11"><b>BRAND</b></td>
                <td class="fs-11"><b>BARCODE</b></td>
                <td class="fs-11"><b>BATCH</b></td>
                <td class="fs-11"><b>STAFF</b></td>
                <td class="fs-11"><b>STATUS</b></td>
                <td class="fs-11 text-end"><b>UNIT COST</b></td>
                <td class="fs-11 text-end"><b>GROSS SALE</b></td>
                <td class="fs-11 text-end"><b>NET INCOME</b></td>
            </tr>
            ';

            $item_query = "
            SELECT
                oc.unique_barcode,
                oc.sold_price,
                ol.order_num,
                oc.hashed_id AS outbound_num,
                ol.customer_fullname,
                ol.date_sent,
                sup.supplier_name,
                sup.local_international,
                p.description,
                b.brand_name,
                s.batch_code,
                s.capital,
                u.user_fname,
                u.user_lname,
                oc.status AS outbound_status
            FROM outbound_content oc
            LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
            LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode
            LEFT JOIN supplier sup ON sup.hashed_id = s.supplier
            LEFT JOIN product p ON p.hashed_id = s.product_id
            LEFT JOIN brand b ON b.hashed_id = p.brand
            LEFT JOIN users u ON u.hashed_id = ol.user_id
            WHERE 
            p.category = '$category_id'
            AND s.item_status != 8
            AND DATE(ol.date_sent) BETWEEN '$from' AND '$to'
            $item_additional_query
            ORDER BY u.user_fname, oc.status ASC
            ";
            $item_res = $conn->query($item_query);
            if($item_res->num_rows>0){
                while($row=$item_res->fetch_assoc()){
                    $unique_barcode = $row['unique_barcode'];
                    $sold_price = $row['sold_price'];
                    $order_num = $row['order_num'];
                    $outbound_num = $row['outbound_num'];
                    $customer_fullname = $row['customer_fullname'];
                    $supplier_name = $row['supplier_name'];
                    $local_international = $row['local_international'];
                    $description = $row['description'];
                    $brand_name = $row['brand_name'];
                    $batch_code = $row['batch_code'];
                    $capital = $row['capital'];
                    $date_sent = $row['date_sent'];
                    $net_income = $sold_price - $capital;
                    $staff_fullname = $row['user_fname'] . " " . $row['user_lname'];
                    if($row['outbound_status'] == 0){
                        $outbound_status = '<span class="badge rounded-pill badge-subtle-success">Paid</span>';
                    } elseif($row['outbound_status'] == 1){
                        $outbound_status = '<span class="badge rounded-pill badge-subtle-warning">Returned</span>';
                    } elseif($row['outbound_status'] == 2){
                        $outbound_status = '<span class="badge rounded-pill badge-subtle-danger">Voided</span>';
                    } elseif($row['outbound_status'] == 6){
                        $outbound_status = '<span class="badge rounded-pill badge-subtle-primary">Outbounded</span>';
                    }
                    
                    $table_rows[] = '
                    <tr class="' . $random_bg . '">
                        <td class="fs-11"></td>
                        <td class="fs-11">' . $order_num . '</td>
                        <td class="fs-11">' . $outbound_num . '</td>
                        <td class="fs-11">' . $customer_fullname . '</td>
                        <td class="fs-11">' . $date_sent . '</td>
                        <td class="fs-11">' . $supplier_name . '</td>
                        <td class="fs-11">' . $local_international . '</td>
                        <td class="fs-11">' . $description . '</td>
                        <td class="fs-11">' . $brand_name . '</td>
                        <td class="fs-11">' . $unique_barcode . '</td>
                        <td class="fs-11">' . $batch_code . '</td>
                        <td class="fs-11">' . $staff_fullname . '</td>
                        <td class="fs-11">' . $outbound_status . '</td>
                        <td class="fs-11 text-end">' . $capital . '</td>
                        <td class="fs-11 text-end">' . $sold_price . '</td>
                        <td class="fs-11 text-end">' . $net_income . '</td>
                    </tr>';
                }
            }
            
            $num++;
        }
        // $grand_total_net = $grand_total_gross - $grand_total_unit_cost;
        // $table_rows[] = '<tr>
        //     <td></td>
        //     <td class="fs-10 text-end pe-3" colspan="11"><b><i>Total</i></b></td>
        //     <td class="fs-10 text-end"><b><i>' . $grand_total_qty . '</i></b></td>
        //     <td class="fs-10 text-end"><b><i>' . $grand_total_unit_cost . '</i></b></td>
        //     <td class="fs-10 text-end"><b><i>' . $grand_total_gross . '</i></b></td>
        //     <td class="fs-10 text-end"><b><i>' . $grand_total_net . '</i></b></td>
        // </tr>';
    } else {
        $table_rows[] = '<tr><td class="text-center" colspan="14">No Data Available</td></tr>';
    }


    $tables = '<tr>
        <th class="label">PREPARED BY:</th><td class="value">' . htmlspecialchars($user_fullname) . '</td>
        <th class="label">FROM:</th><td class="value">' . date('F j, Y', strtotime($from)) . '</td>
        <th class="label">TO:</th><td class="value">' . date('F j, Y', strtotime($to)) . '</td>
        <th class="label">Date:</th><td class="value">' . date('F j, Y') . '</td>
        <th class="label">Warehouse:</th><td class="value">' . $ware_treans . '</td>
    </tr>';

    $html = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                font-size: 12px;
            }

            h1 {
                text-align: center;
                margin: 30px 0;
                color: #2c3e50;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th, td {
                padding: 6px 8px;
                border: 1px solid #ccc;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            .text-end {
                text-align: right;
            }

            .meta-table td,
            .meta-table th {
                border: none;
                padding: 4px 8px;
            }

            .label {
                font-weight: bold;
                background-color: #f0f0f0;
            }

            .value {
                background-color: #ffffff;
            }

            .category-header {
                font-weight: bold;
                font-size: 13px;
            }

            .totals-row td {
                font-weight: bold;
                font-style: italic;
                background-color: #f8f9fa;
            }

            .category-block tr {
                font-size: 11px;
            }
        </style>
    </head>
    <body>
        <h1>Transaction Overview</h1>

        <table class='meta-table'>
            $tables
        </table>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th colspan='11'>CATEGORY</th>
                    <th class='text-end'>QTY</th>
                    <th class='text-end'>SUBTOTAL UNIT COST</th>
                    <th class='text-end'>SUBTOTAL GROSS SALES</th>
                    <th class='text-end'>SUBTOTAL NET INCOME</th>
                </tr>
            </thead>
            <tbody>" . implode('', $table_rows) . "</tbody>
        </table>
    </body>
    </html>";



    $mpdf = new \Mpdf\Mpdf([
        'format' => [297, 210],
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
    ]);

    $mpdf->WriteHTML($html);
    $fileName = $from . ' to ' . $to . '.pdf';

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    $mpdf->Output($fileName, 'D');
    exit;
}

echo json_encode($response);
exit;
?>

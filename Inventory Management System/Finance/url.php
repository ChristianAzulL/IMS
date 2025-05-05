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
if(!empty($_GET['category'])){
    $raw_category = $_GET['category'];
    // Step 1: Trim spaces and split the string by commas
    $categories = array_map('trim', explode(',', $raw_category));
    
    // Step 2: Wrap each category in single quotes
    $categories = array_map(function($category) {
        return "'" . $category . "'";
    }, $categories);
    
    // Step 3: Join the array elements back into a single string
    $raw_category = implode(', ', $categories); // Reassign to $raw_category
} else {
    $raw_category = "";
}


// Output the final result
// echo $raw_category;  // Outputs: 'category_1', 'category_2', 'category_3'
// $categories = explode(',', $_GET['category'] ?? '');
// $escaped = array_map(fn($cat) => "'" . trim(htmlspecialchars($cat, ENT_QUOTES)) . "'", $categories);
// $imploded_category = implode(',', $escaped);
$warehouse_transaction = htmlspecialchars($_GET['wh'] ?? '');

if(!empty($_GET['supplier'])){
    $get_supplier = htmlspecialchars($_GET['supplier'] ?? '');

    $suppliers = array_map('trim', explode(',', $get_supplier));

    $suppliers = array_map(function($supplier){
        return "'" . $supplier . "'";
    }, $suppliers);

    $get_supplier = implode(', ', $suppliers); 
} else {
    $get_supplier = "";
}

$sup_type = htmlspecialchars($_GET['sup_type'] ?? '');
if($sup_type === "All"){
    $display_sup = "Local/ Import";
} else {
    $display_sup = $sup_type;
}

// echo "===============================" . $get_supplier . "=========================";

// echo $warehouse_transaction;


$bg_colors = ['bg-100', 'bg-200', 'bg-300', 'bg-400', 'bg-500', 'bg-600', 'table-primary', 'table-info', 'table-dark', 'table-warning', 'table-success'];
$grand_total_qty = 0;
$grand_total_unit_cost = 0;
$grand_total_gross = 0;
$grand_total_net = 0;
$num = 1;
// echo "----------------------------------" . $raw_category . "---------------------------------------";

if(empty($raw_category) && empty($warehouse_transaction)){
    $category_additional_query = "AND ol.warehouse IN ($user_warehouse_id)";
    $item_additional_query = "AND ol.warehouse IN ($user_warehouse_id)";
    $supplier_warehouse_additional = "AND ol.warehouse IN ($user_warehouse_id)";
    // echo "ta";
} elseif(!empty($raw_category) && !empty($warehouse_transaction)) {
    $category_additional_query = "AND c.hashed_id IN ($raw_category) AND ol.warehouse = '$warehouse_transaction'";
    $item_additional_query = "AND ol.warehouse = '$warehouse_transaction'";
    $supplier_warehouse_additional = "AND p.category IN ($raw_category) AND ol.warehouse = '$warehouse_transaction'";
    // echo "tang";
} elseif(empty($raw_category) && !empty($warehouse_transaction)) {
    $category_additional_query = "AND ol.warehouse = '$warehouse_transaction'";
    $item_additional_query = "AND ol.warehouse = '$warehouse_transaction'";
    $supplier_warehouse_additional = "AND ol.warehouse = '$warehouse_transaction'";
    // echo "tangina";
}

if(empty($get_supplier) && $sup_type === "All"){
    $additional_supplier_query = "";
} elseif(empty($get_supplier) && $sup_type === "Local"){
    $additional_supplier_query = "AND sup.local_international = 'Local'";
} elseif(empty($get_supplier) && $sup_type === "International"){
    $additional_supplier_query = "AND sup.local_international = 'International'";
} elseif(!empty($get_supplier) && $sup_type === "All"){
    $additional_supplier_query = "AND s.supplier IN ($get_supplier)";
} elseif(!empty($get_supplier) && $sup_type === "Local"){
    $additional_supplier_query = "AND s.supplier IN ($get_supplier) AND sup.local_international = 'Local'";
} elseif(!empty($get_supplier) && $sup_type === "International"){
    $additional_supplier_query = "AND s.supplier IN ($get_supplier) AND sup.local_international = 'International'";
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
    $supplier_query = "
        SELECT 
            sup.hashed_id AS supplier_head_id,
            sup.supplier_name AS supplier,
            sup.local_international AS sup_type,
            COUNT(oc.unique_barcode) AS sup_outbounded_qty,
            SUM(s.capital) AS sup_unit_cost,
            SUM(oc.sold_price) AS sup_gross_sale
        FROM supplier sup
        LEFT JOIN stocks s ON s.supplier = sup.hashed_id
        LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode
        LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
        LEFT JOIN product p ON p.hashed_id = s.product_id
        WHERE
        oc.status = 0
        AND s.item_status NOT IN (4, 8)
        AND MONTH(ol.date_sent) = MONTH(NOW()) AND YEAR(ol.date_sent) = YEAR(NOW())
        $supplier_warehouse_additional
        AND ol.status = 0
        $additional_supplier_query
        GROUP BY sup.supplier_name
    ";
    // echo "<br>" . $supplier_query . "<br>";
    $supplier_res = $conn->query($supplier_query);
    if($supplier_res->num_rows>0){
        while($row=$supplier_res->fetch_assoc()){
            $random_bg = $bg_colors[array_rand($bg_colors)];
            $sup_supplier = $row['supplier'];
            $sup_supplierType = $row['sup_type'];
            $sup_outboundedQty = $row['sup_outbounded_qty'];
            $sup_unitCost = $row['sup_unit_cost'];
            $sup_grossSale = $row['sup_gross_sale'];
            $sup_supplierHeadId = $row['supplier_head_id'];
            $sup_netincome = $sup_grossSale - $sup_unitCost;

            $table_rows[] = '
            <tr class="' . $random_bg . '">
                <td class="fs-10">' . $num . '</td>
                <td class="fs-10">' . $sup_supplier . '</td>
                <td class="fs-10" colspan="9"></td>
                <td class="fs-10 text-end">'. $sup_outboundedQty .'</td>
                <td class="fs-10 text-end" style="width: 500px;">' . $sup_unitCost .'</td>
                <td class="fs-10 text-end" style="width: 500px;">' . $sup_grossSale . '</td>
                <td class="fs-10 text-end" style="width: 500px;">' . $sup_netincome . '</td>
            </tr>
                        ';

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
            LEFT JOIN supplier sup ON sup.hashed_id = s.supplier
            LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode
            LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
            WHERE
            oc.status = 0
            AND s.item_status NOT IN (4, 8)
            AND DATE(ol.date_sent) BETWEEN '$from' AND '$to'
            AND s.supplier = '$sup_supplierHeadId'
            AND ol.status = 0
            $category_additional_query
            GROUP BY c.category_name
            ";

            // echo $category_query;

            
            
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
                        <td class="fs-10"></td>
                        <td class="fs-10"></td>
                        <td class="fs-10" colspan="9">'. $category_name .'</td>
                        <td class="fs-10 text-end">'. $outbound_qty .'</td>
                        <td class="fs-10 text-end" style="width: 500px;">' . $sub_unit_cost .'</td>
                        <td class="fs-10 text-end" style="width: 500px;">' . $sub_gross . '</td>
                        <td class="fs-10 text-end" style="width: 500px;">' . $sub_netincome . '</td>
                    </tr>
                    <tr class="' . $random_bg . '">
                        <td class="fs-11"><b></b></td>
                        <td class="fs-10"></td>
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
                        s.capital
                    FROM outbound_content oc
                    LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
                    LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode
                    LEFT JOIN supplier sup ON sup.hashed_id = s.supplier
                    LEFT JOIN product p ON p.hashed_id = s.product_id
                    LEFT JOIN brand b ON b.hashed_id = p.brand
                    WHERE 
                    p.category = '$category_id'
                    AND oc.status = 0
                    AND s.item_status NOT IN (4, 8)
                    AND DATE(ol.date_sent) BETWEEN '$from' AND '$to'
                    AND s.supplier = '$sup_supplierHeadId'
                    AND ol.status = 0
                    $item_additional_query
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
                            
                            $table_rows[] = '
                            <tr class="' . $random_bg . '">
                                <td class="fs-11"></td>
                                <td class="fs-10"></td>
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
                                <td class="fs-11 text-end">' . $capital . '</td>
                                <td class="fs-11 text-end">' . $sold_price . '</td>
                                <td class="fs-11 text-end">' . $net_income . '</td>
                            </tr>';
                        }
                    }
                    
                    $num++;
                }
            } else {
                $table_rows[] = '<tr><td class="text-center" colspan="14">No Data Available</td></tr>';
            }
        }
        $grand_total_net = $grand_total_gross - $grand_total_unit_cost;
        $table_rows[] = '<tr>
            <td class="fs-10 text-start pe-3" colspan="11"><b><i>Total</i></b></td>
            <td class="fs-10 text-end"><b><i>' . $grand_total_qty . '</i></b></td>
            <td class="fs-10 text-end"><b><i>' . $grand_total_unit_cost . '</i></b></td>
            <td class="fs-10 text-end"><b><i>' . $grand_total_gross . '</i></b></td>
            <td class="fs-10 text-end"><b><i>' . $grand_total_net . '</i></b></td>
        </tr>';
    }
            


    $tables = '<tr>
        <th class="label">PREPARED BY:</th><td class="value">' . htmlspecialchars($user_fullname) . '</td>
        <th class="label">COVERAGE:</th><td class="value">' . htmlspecialchars($display_sup) . '</td>
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
        <h1>FINANCE</h1>

        <table class='meta-table'>
            $tables
        </table>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>SUPPLIER</th>
                    <th colspan='9'>CATEGORY</th>
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


    // echo $html;
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

// echo json_encode($response);
exit;
?>

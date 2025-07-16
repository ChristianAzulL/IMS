<?php 
include "../config/database.php";

// Second query: Using prepared statements and handling result
$query = "SELECT 
            p.description, 
            b.brand_name, 
            c.category_name, 
            p.parent_barcode, 
            s.unique_barcode, 
            oc.quantity_before, 
            oc.quantity_after, 
            oc.status AS outbound_status, 
            ol.date_request_void, 
            ol.date_approved, 
            ol.date_paid, 
            ol.date_sent, 
            ol.customer_fullname, 
            ol.payment_method, 
            co.courier_name, 
            lp.logistic_name, 
            ol.order_num, 
            ol.order_line_id,
            w.warehouse_name,
            u.user_fname,
            u.user_lname
        FROM outbound_content oc
        LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode
        LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
        LEFT JOIN product p ON p.hashed_id = s.product_id
        LEFT JOIN brand b ON b.hashed_id = p.brand
        LEFT JOIN category c ON c.hashed_id = p.category
        LEFT JOIN warehouse w ON w.hashed_id = ol.warehouse
        LEFT JOIN courier co ON co.hashed_id = ol.courier
        LEFT JOIN logistic_partner lp ON lp.hashed_id = ol.platform
        LEFT JOIN users u ON u.hashed_id = ol.user_id
    ";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Print header
    echo "ORDER NO,ORDER LINE ID,CUSTOMER,PRODUCT DESCRIPTION,BRAND,CATEGORY,PARENT BARCODE,UNIQUE BARCODE,QUANTITY BEFORE,QUANTITY AFTER,STATUS,DATE REQUEST VOID,DATE APPROVED,DATE PAID,DATE SENT,PAYMENT METHOD,COURIER,PLATFORM,WAREHOUSE,TRANSACTED BY\n";

    while ($row = $result->fetch_assoc()) {
        // Convert status code to text
        switch ($row['outbound_status']) {
            case 6:
                $outbound_status = "OUTBOUNDED";
                break;
            case 0:
                $outbound_status = "PAID";
                break;
            case 2:
                $outbound_status = "RETURNED";
                break;
            case 3:
                $outbound_status = "VOID REQUESTED";
                break;
            case 4:
                $outbound_status = "VOIDED";
                break;
            case 5:
                $outbound_status = "VOID REJECTED";
                break;
            default:
                $outbound_status = "UNKNOWN";
        }

        $transacted_by = trim($row['user_fname'] . " " . $row['user_lname']);

        echo "<br>" . 
            $row['order_num'] . "," .
            $row['order_line_id'] . "," .
            $row['customer_fullname'] . "," .
            $row['description'] . "," .
            $row['brand_name'] . "," .
            $row['category_name'] . "," .
            $row['parent_barcode'] . "," .
            $row['unique_barcode'] . "," .
            $row['quantity_before'] . "," .
            $row['quantity_after'] . "," .
            $outbound_status . "," .
            $row['date_request_void'] . "," .
            $row['date_approved'] . "," .
            $row['date_paid'] . "," .
            $row['date_sent'] . "," .
            $row['payment_method'] . "," .
            $row['courier_name'] . "," .
            $row['logistic_name'] . "," .
            $row['warehouse_name'] . "," .
            $transacted_by;
    }
} else {
    echo "No data found.";
}
?>

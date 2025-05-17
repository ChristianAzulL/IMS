<?php 
$promotion_data = [];

if (!empty($_GET['wh'])) {
    $warehouse_dashboard_id = $_GET['wh']; // sample: warehouse1
    $warehouse_dashboard_id = mysqli_real_escape_string($conn, $warehouse_dashboard_id); // Sanitize the input
    
    $promotion_product_query = "
        SELECT 
            p.description,
            p.product_img,
            b.brand_name,
            c.category_name,
            COUNT(oc.unique_barcode) AS total_outbound
        FROM product p
        LEFT JOIN brand b ON b.hashed_id = p.brand
        LEFT JOIN category c ON c.hashed_id = p.category
        LEFT JOIN stocks s ON s.product_id = p.hashed_id
        LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode
        LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
        WHERE oc.status = 0
            AND (s.batch_code IS NOT NULL AND s.batch_code != '-')
            AND ol.date_sent >= DATE_FORMAT(NOW(), '%Y-%m-01')
            AND ol.date_sent < DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH)
            AND s.warehouse = '$warehouse_dashboard_id'
        GROUP BY p.description
        ORDER BY total_outbound ASC
        LIMIT 10
    ";

} else {
    // Convert into quoted format
    $warehouse_list = explode(',', $_SESSION['warehouse_ids']);
    // Sanitize each warehouse ID string to avoid SQL injection
    $warehouse_list = array_map(function($warehouse) use ($conn) {
        return "'" . mysqli_real_escape_string($conn, $warehouse) . "'";
    }, $warehouse_list);
    
    $warehouse_dashboard_id = implode(",", $warehouse_list); // sample: 'warehouse1','warehouse2','warehouse3'

    $promotion_product_query = "
        SELECT 
            p.description,
            p.product_img,
            b.brand_name,
            c.category_name,
            COUNT(oc.unique_barcode) AS total_outbound
        FROM product p
        LEFT JOIN brand b ON b.hashed_id = p.brand
        LEFT JOIN category c ON c.hashed_id = p.category
        LEFT JOIN stocks s ON s.product_id = p.hashed_id
        LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode
        LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
        WHERE s.warehouse IN ($warehouse_dashboard_id)
            AND oc.status = 0
            AND (s.batch_code IS NOT NULL AND s.batch_code != '-')
            AND ol.date_sent >= DATE_FORMAT(NOW(), '%Y-%m-01')
            AND ol.date_sent < DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH)
        GROUP BY p.description
        ORDER BY total_outbound ASC
        LIMIT 10
    ";
}

$promotion_product_res = $conn->query($promotion_product_query);
if($promotion_product_res->num_rows>0){
    while($row=$promotion_product_res->fetch_assoc()){
        $promotion_item = $row['description'];
        $promotion_item_img = $row['product_img'] ?? 'def_img.png';
        $promotion_brand = $row['brand_name'];
        $promotion_category = $row['category_name'];
        $promotion_total_outbound = $row['total_outbound'];

        $promotion_data[] = '<tr>
                <td><img class="img" src="../../assets/img/' . basename($promotion_item_img) . '" style="height: 30px; width: 30px;" alt=""></td>
                <td>' . $promotion_item . '</td>
                <td>' . $promotion_brand . '</td>
                <td>' . $promotion_category . '</td>
                <td class="text-end">' . number_format($promotion_total_outbound) . '</td>
            </tr>';
      
    }
}

if(count($promotion_data) == 0){
    $promotion_data[] = '<tr><td colspan="5" class="text-center">No data available</td></tr>';
}
?>

<div class="card">
    <div class="card-header">
        <h6><a href="../Promotions/">For Promotion</a> <?php echo $date_today;?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 data-table fs-10" data-datatables='{"paging":false,"scrollY":"300px","scrollCollapse":true}'>
                <thead class="bg-warning">
                    <tr>
                        <th></th>
                        <th>Description</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th class="text-end">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($promotion_data AS $promotion_display){
                        echo $promotion_display;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

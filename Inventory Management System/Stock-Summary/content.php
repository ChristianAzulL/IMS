<?php
$rows = [];
if(isset($_GET['supplier']) && isset($_GET['supplier_name']) && isset($_GET['category']) && isset($_GET['category_name'])){
    $supplier_id = $_GET['supplier'];
    $category_id = $_GET['category'];
    $supplier_name = $_GET['supplier_name'];
    $category_name = $_GET['category_name'];
    $supplier_type = $_GET['supplier_type'];

    $product_stocks = "SELECT 
                            p.product_img,
                            p.description,
                            b.brand_name,
                            COUNT(s.unique_barcode) AS stocks,
                            w.warehouse_name
                        FROM product p
                        LEFT JOIN stocks s ON s.product_id = p.hashed_id
                        LEFT JOIN brand b ON b.hashed_id = p.brand
                        LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
                        WHERE p.category = ''
                        AND s.supplier = ''
                        AND s.item_status IN (0, 3)
                        GROUP BY p.product_img, p.description, b.brand_name, w.warehouse_name, s.warehouse";
} else {
    $product_stocks = "SELECT 
                            p.product_img,
                            p.description,
                            b.brand_name,
                            COUNT(s.unique_barcode) AS stocks,
                            w.warehouse_name,
                            sup.supplier_name,
                            sup.local_international
                        FROM product p
                        LEFT JOIN stocks s ON s.product_id = p.hashed_id
                        LEFT JOIN brand b ON b.hashed_id = p.brand
                        LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
                        WHERE s.item_status IN (0, 3)
                        GROUP BY p.product_img, p.description, b.brand_name, w.warehouse_name, s.warehouse, sup.supplier_name, sup.local_international";
}
$product_stocks_result = $conn->query($product_stocks);
if($product_stocks_result->num_rows>0){
    while($row=$product_stocks_result->fetch_assoc()){
        $product_img = $row['product_img'];
        $product_description = $row['description'];
        $brand_name = $row['brand_name'];
        $stocks = $row['stocks'];
        $product_warehouse = $row['warehouse_name'];

        $rows[] = '<tr>
            <td><img src="../../assets/img/' . $product_img . '" height="50" alt=""></td>
            <td>' . $product_description . '</td>
            <td>' . $brand_name . '</td>
            <td>' . $product_warehouse . '</td>
            <td>' . $product_warehouse . '</td>
        </tr>';
    }
} else {
    $rows[] = '<tr>
            <td colspan="5">No Data Available!</td>
        </tr>';
}
?>
<div class="row">

</div>
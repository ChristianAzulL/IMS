<?php
$rows = [];
if(isset($_GET['supplier']) && isset($_GET['supplier_name']) && isset($_GET['category']) && isset($_GET['category_name'])){
    $supplier_id = $_GET['supplier'];
    $category_id = $_GET['category'];
    $supplier_name = $_GET['supplier_name'];
    $category_name = $_GET['category_name'];
    $supplier_type = $_GET['supplier_type'];
    $paragraph = "For Supplier: " . $supplier_name . " and Category: " . $category_name;

    $total_qty = 0;
    $total_capital = 0;

    $product_stocks = "SELECT 
                            p.product_img,
                            p.description,
                            b.brand_name,
                            COUNT(s.unique_barcode) AS stocks,
                            SUM(s.capital) AS unit_cost,
                            w.warehouse_name
                        FROM product p
                        LEFT JOIN stocks s ON s.product_id = p.hashed_id
                        LEFT JOIN brand b ON b.hashed_id = p.brand
                        LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
                        WHERE p.category = ''
                        AND s.supplier = ''
                        AND s.item_status IN (0, 3)
                        GROUP BY p.product_img, p.description, b.brand_name, w.warehouse_name, s.warehouse";
    $product_stocks_result = $conn->query($product_stocks);
    if($product_stocks_result->num_rows>0){
        while($row=$product_stocks_result->fetch_assoc()){
            $product_img = $row['product_img'];
            $product_description = $row['description'];
            $brand_name = $row['brand_name'];
            $stocks = $row['stocks'];
            $product_warehouse = $row['warehouse_name'];
            $capital = $row['unit_cost'];
            $total_qty += $stocks;
            $total_capital += $total_capital;

            

            $rows[] = '<tr>
                <td><img src="../../assets/img/' . $product_img . '" height="50" alt=""></td>
                <td>' . $product_description . '</td>
                <td>' . $brand_name . '</td>
                <td>' . $product_warehouse . '</td>
                <td>' . $supplier_name . '</td>
                <td>' . $supplier_type . '</td>
                <td>' . $stocks . '</td>
                <td>' . $capital . '</td>
            </tr>';

        }
        $rows[] = '<tr>
            <td colspan="5">TOTAL</td>
            <td>' . $stocks . '</td>
            <td>' . $capital . '</td>
        </tr>';
    } else {
        $rows[] = '<tr>
                <td colspan="8">No Data Available!</td>
            </tr>';
    }
} else {
    $total_qty = 0;
    $total_capital = 0;
    $supplier_query = "SELECT * FROM supplier ORDER BY supplier_name ASC";
    $supplier_result = $conn->query($supplier_query);
    if($supplier_result->num_rows>0){
        while($row=$supplier_result->fetch_assoc()){
            $supplier_id = $row['hashed_id'];
            $supplier_name = $row['supplier_name'];
            $supplier_type = $row['supplier_type'];

            $product_stocks = "SELECT 
                            p.product_img,
                            p.description,
                            b.brand_name,
                            COUNT(s.unique_barcode) AS stocks,
                            w.warehouse_name,
                            c.category_name
                        FROM product p
                        LEFT JOIN stocks s ON s.product_id = p.hashed_id
                        LEFT JOIN brand b ON b.hashed_id = p.brand
                        LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
                        LEFT JOIN category c ON c.hashed_id = p.category
                        WHERE s.item_status IN (0, 3)
                        AND s.supplier = '$supplier_id'
                        GROUP BY p.product_img, p.description, b.brand_name, w.warehouse_name, s.warehouse, sup.supplier_name, sup.local_international
                        ORDER BY c.category_name";
            $product_stocks_result = $conn->query($product_stocks);
            if($product_stocks_result->num_rows>0){
                while($row=$product_stocks_result->fetch_assoc()){
                    $product_img = $row['product_img'];
                    $product_description = $row['description'];
                    $brand_name = $row['brand_name'];
                    $stocks = $row['stocks'];
                    $product_warehouse = $row['warehouse_name'];
                    $capital = $row['unit_cost'];
                    $category_name = $row['category_name'];
                    $total_qty += $stocks;
                    $total_capital += $total_capital;

                    

                    $rows[] = '<tr>
                        <td><img src="../../assets/img/' . $product_img . '" height="50" alt=""></td>
                        <td>' . $product_description . '</td>
                        <td>' . $brand_name . '</td>
                        <td>' . $product_warehouse . '</td>
                        <td>' . $supplier_name . '</td>
                        <td>' . $supplier_type . '</td>
                        <td>' . $stocks . '</td>
                        <td>' . $capital . '</td>
                    </tr>';

                }
                $rows[] = '<tr>
                    <td colspan="5">TOTAL</td>
                    <td>' . $stocks . '</td>
                    <td>' . $capital . '</td>
                </tr>';
            } else {
                $rows[] = '<tr>
                        <td colspan="8">No Data Available!</td>
                    </tr>';
            }
        }
    }
}

?>
<div class="row">
    <div class="col-xxl-14">
        <div class="card">
            <div class="card-header">
                <h2>Stock Summary</h2>
            </div>
        </div>
    </div>

</div>
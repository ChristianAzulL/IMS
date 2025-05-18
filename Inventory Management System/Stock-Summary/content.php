<?php
$rows = [];
if(isset($_GET['supplier']) && isset($_GET['supplier_name']) && isset($_GET['category']) && isset($_GET['category_name'])){
    $supplier_id = $_GET['supplier'];
    $supplier_name = $_GET['supplier_name'];
    $category_id = $_GET['category'];
    $category_name = $_GET['category_name'];
    $supplier_type = $_GET['supplier_type'];
    $paragraph = "For Supplier: " . $supplier_name . " and Category: " . $category_name;

    if (!empty($category_id) && !empty($category_name)) {
        $additional_query = " AND p.category = '$category_id'";
        $additional_takes = "";
    } else {
        $additional_query = "";
        $additional_takes = ",c.category_name";
    }


    $total_qty = 0;
    $total_capital = 0;

    $product_stocks = "SELECT 
                            p.product_img,
                            p.description,
                            b.brand_name,
                            COUNT(s.unique_barcode) AS stocks,
                            SUM(s.capital) AS unit_cost,
                            w.warehouse_name
                            $additional_takes
                        FROM product p
                        LEFT JOIN stocks s ON s.product_id = p.hashed_id
                        LEFT JOIN brand b ON b.hashed_id = p.brand
                        LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
                        LEFT JOIN category c ON c.hashed_id = p.category
                        WHERE s.supplier = '$supplier_id'
                        AND s.item_status IN (0, 3)
                        $additional_query
                        GROUP BY p.product_img, p.description, b.brand_name, w.warehouse_name, s.warehouse
                        ORDER BY p.category";
    $product_stocks_result = $conn->query($product_stocks);
    if($product_stocks_result->num_rows>0){
        while($row=$product_stocks_result->fetch_assoc()){
            $product_img = $row['product_img'] ?? 'def_img.png';
            $product_description = $row['description'];
            $brand_name = $row['brand_name'];
            $stocks = $row['stocks'];
            $product_warehouse = $row['warehouse_name'];
            $capital = $row['unit_cost'];
            $category_name2 = $row['category_name'] ?? $category_name;
            $total_qty += $stocks;
            $total_capital += $capital;

            

            $rows[] = '<tr>
                <td><img src="../../assets/img/' . $product_img . '" height="50" alt=""></td>
                <td>' . $product_description . '</td>
                <td>' . $brand_name . '</td>
                <td>' . $category_name2 . '</td>
                <td>' . $product_warehouse . '</td>
                <td>' . $supplier_name . '</td>
                <td>' . $supplier_type . '</td>
                <td>' . $stocks . '</td>
                <td>' . $capital . '</td>
            </tr>';

        }
        $rows[] = '<tr>
            <td>Total for ' . $supplier_name . '</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>' . $stocks . '</td>
            <td>' . $capital . '</td>
        </tr>';
    }
} else {
    $supplier_query = "SELECT * FROM supplier ORDER BY supplier_name ASC";
    $supplier_result = $conn->query($supplier_query);
    $paragraph = "All";
    if($supplier_result->num_rows>0){
        while($row=$supplier_result->fetch_assoc()){
            $supplier_id = $row['hashed_id'];
            $supplier_name = $row['supplier_name'];
            $supplier_type = $row['local_international'];
            $total_qty = 0;
            $total_capital = 0;

            $product_stocks = "SELECT 
                            p.product_img,
                            p.description,
                            b.brand_name,
                            COUNT(s.unique_barcode) AS stocks,
                            SUM(s.capital) AS unit_cost,
                            w.warehouse_name,
                            c.category_name
                        FROM product p
                        LEFT JOIN stocks s ON s.product_id = p.hashed_id
                        LEFT JOIN brand b ON b.hashed_id = p.brand
                        LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
                        LEFT JOIN category c ON c.hashed_id = p.category
                        WHERE s.item_status IN (0, 3)
                        AND s.supplier = '$supplier_id'
                        GROUP BY p.product_img, p.description, b.brand_name, w.warehouse_name, s.warehouse
                        ORDER BY c.category_name";
            $product_stocks_result = $conn->query($product_stocks);
            if($product_stocks_result->num_rows>0){
                while($row=$product_stocks_result->fetch_assoc()){
                    $product_img = $row['product_img'] ?? 'def_img.png';
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
                        <td>' . $category_name . '</td>
                        <td>' . $product_warehouse . '</td>
                        <td>' . $supplier_name . '</td>
                        <td>' . $supplier_type . '</td>
                        <td>' . $stocks . '</td>
                        <td>' . $capital . '</td>
                    </tr>';

                }
                $rows[] = '<tr>
                    <td>Total for ' . $supplier_name . '</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>' . $stocks . '</td>
                    <td>' . $capital . '</td>
                </tr>';
            }
        }
    }
}

?>
<div class="row">
    <div class="col-xxl-14">
        <div class="card">
            <div class="card-header bg-success bg-gradient">
                <h2>Stock Summary</h2>
                <p><?php echo $paragraph;?></p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table fs-10" data-datatables='{"paging":false,"scrollY":"300px","scrollCollapse":true}'>
                        <thead class="bg-dark">
                            <th></th>
                            <th>Description</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Warehouse</th>
                            <th>Supplier</th>
                            <th>Local/Import</th>
                            <th>Stocks</th>
                            <th>Unit Cost</th>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($rows AS $stock){
                                echo $stock;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
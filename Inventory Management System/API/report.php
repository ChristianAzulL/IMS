<?php
// Sanitize and fetch warehouse selection
$selected_wh = $_GET['select_warehouse'] ?? null;

// Sanitize user warehouse IDs
$quoted_warehouse_ids = array_map(function ($id) use ($conn) {
    return "'" . $conn->real_escape_string(trim($id)) . "'";
}, $user_warehouse_ids);
$imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);

// Display warehouse name or "All Warehouses"
if ($selected_wh) {
    $stmt = $conn->prepare("SELECT warehouse_name, hashed_id FROM warehouse WHERE hashed_id = ? LIMIT 1");
    $stmt->bind_param("s", $selected_wh);
    $stmt->execute();
    $result = $stmt->get_result();
    $api_warehouse_name = "Unknown";
    $api_warehouse_id = null;

    if ($row = $result->fetch_assoc()) {
        $api_warehouse_name = $row['warehouse_name'];
        $api_warehouse_id = $row['hashed_id'];
    }
    ?>
    <div class="d-flex flex-inline mb-6 mx-4">
        <div class="col-4">
            <h4>Warehouse: <?php echo ucwords(strtolower($api_warehouse_name)); ?></h4>
        </div>
        <div class="col-6 text-end">
            <a href="#" class="btn btn-info me-2"><span class="fas fa-download"></span></a>
        </div>
        <div class="col-auto text-end">
            <div class="dropdown font-sans-serif mb-2">
                <a class="btn btn-falcon-default dropdown-toggle" id="dropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Warehouse</a>
                <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="../Reports/">All</a>
                    <?php echo implode("\n", $warehouse_dropdown); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="d-flex flex-inline mb-6 mx-4">
        <div class="col-4">
            <h4>All Warehouses</h4>
        </div>
        <div class="col-6 text-end">
            <a href="#" class="btn btn-info me-2"><span class="fas fa-download"></span></a>
        </div>
        <div class="col-auto text-end">
            <div class="dropdown font-sans-serif mb-2">
                <a class="btn btn-falcon-default dropdown-toggle" id="dropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Warehouse</a>
                <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="../Reports/">All</a>
                    <?php echo implode("\n", $warehouse_dropdown); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
    <table class="table mb-0 data-table fs-10 mx-0" data-datatables="data-datatables">
        <thead class="bg-200">
            <tr class="table-secondary">
            <th class="text-900 sort text-nowrap">Category</th>
            <th class="text-900 sort text-nowrap text-end">Total Unit Cost</th>
            <th class="text-900 sort text-nowrap text-end">Quantity</th>
            </tr>
        </thead>
        <tbody>
<?php
$category_query = "SELECT category_name, hashed_id FROM category ORDER BY category_name ASC";
$category_res = $conn->query($category_query);

if ($category_res && $category_res->num_rows > 0) {
    while ($row = $category_res->fetch_assoc()) {
        $c_category_name = $row['category_name'];
        $c_category_id   = $row['hashed_id'];

        $category_capital = 0;
        $category_qty = 0;

        $stmt = $conn->prepare("
            SELECT 
                p.hashed_id 
            FROM product p 
            LEFT JOIN brand b ON b.hashed_id = p.brand 
            WHERE p.category = ?
        ");
        $stmt->bind_param("s", $c_category_id);
        $stmt->execute();
        $product_result = $stmt->get_result();

        while ($product = $product_result->fetch_assoc()) {
            $product_id = $product['hashed_id'];

            if ($selected_wh && $api_warehouse_id) {
                $stock_stmt = $conn->prepare("
                    SELECT capital 
                    FROM stocks 
                    WHERE item_status = 0 
                        AND product_id = ?
                        AND YEAR(`date`) = YEAR(CURDATE()) 
                        AND MONTH(`date`) = MONTH(CURDATE())
                        AND warehouse = ?
                ");
                $stock_stmt->bind_param("ss", $product_id, $api_warehouse_id);
            } else {
                // fallback: use IN clause for user warehouses
                $stock_query = "
                    SELECT capital 
                    FROM stocks 
                    WHERE item_status = 0 
                        AND product_id = '$product_id'
                        AND YEAR(`date`) = YEAR(CURDATE()) 
                        AND MONTH(`date`) = MONTH(CURDATE())
                        AND warehouse IN ($imploded_warehouse_ids)
                ";
                $stock_stmt = $conn->prepare($stock_query);
            }

            $stock_stmt->execute();
            $stock_result = $stock_stmt->get_result();

            while ($stock_row = $stock_result->fetch_assoc()) {
                $total_capital = floatval($stock_row['capital']);
                $quantity = 1;

                $category_capital += $total_capital;
                $category_qty += $quantity;
            }
        }
        ?>
        <tr>
            <td><?php echo ucwords(strtolower($c_category_name)); ?></td>
            <td class="text-end"><?php echo number_format($category_capital, 2); ?></td>
            <td class="text-end"><?php echo number_format($category_qty); ?></td>
        </tr>
        <?php
    }
}
?>
        </tbody>
    </table>








    
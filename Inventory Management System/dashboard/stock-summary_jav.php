<?php 
include "../config/database.php";
include "../config/on_session.php";

// Determine the time of day
$hour = date("H"); // Get the current hour in 24-hour format

if ($hour >= 5 && $hour < 12) {
    $time_name = "Morning";
} elseif ($hour >= 12 && $hour < 17) {
    $time_name = "Afternoon";
} elseif ($hour >= 17 && $hour < 21) {
    $time_name = "Evening";
} else {
    $time_name = "Midnight";
}


$quoted_warehouse_ids = array_map(function ($id) {
    return "'" . trim($id) . "'";
}, $user_warehouse_ids);

// Create a comma-separated string of quoted IDs
$imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);
$dashboard_wh = $_GET['wh'];



$dashboard_supplier_query = "SELECT * FROM supplier";
$dashboard_supplier_res = $conn->query($dashboard_supplier_query);

$stock_summary = [];
if($dashboard_supplier_res->num_rows>0){
    while($row = $dashboard_supplier_res->fetch_assoc()){
        $supplier_id = $row['hashed_id'];
        $supplier_name = $row['supplier_name'];
        $supplier_type = $row['local_international'];

        $sub_total_capital = 0;
        $sub_total_qty = 0;

        // Fetch categories once, outside the supplier loop
        $category_dashboard_sql = "SELECT hashed_id, category_name FROM category";
        $category_dashboard_res = $conn->query($category_dashboard_sql);
        $categories = [];
        if($category_dashboard_res->num_rows > 0){
            while($category_row = $category_dashboard_res->fetch_assoc()){
                $categories[] = $category_row;
            }
        }

        // Loop through categories
        foreach ($categories as $category) {
            $category_id = $category['hashed_id'];
            $category_name = $category['category_name'];

            // Warehouse selection logic
            if (isset($_GET['wh']) || !empty($_GET['wh'])) {
                $warehouse_dashboard_id = $_GET['wh']; // sample: warehouse1
                $warehouse_dashboard_id = mysqli_real_escape_string($conn, $warehouse_dashboard_id); // Sanitize the input

                $dashboard_stocks_query = "
                    SELECT
                        SUM(s.capital) AS total_capital,
                        COUNT(s.unique_barcode) AS qty
                    FROM stocks s 
                    LEFT JOIN product p ON p.hashed_id = s.product_id
                    WHERE
                    p.category = '$category_id' 
                    AND s.item_status NOT IN (1, 4, 8)
                    AND s.warehouse = '$warehouse_dashboard_id'
                    AND p.category = '$category_id'
                    AND s.supplier = '$supplier_id'
                    AND (s.batch_code IS NOT NULL AND s.batch_code != '-')
                ";
            } else {

                // Convert into quoted format
                $warehouse_list = explode(',', $_SESSION['warehouse_ids']);
                // Sanitize each warehouse ID string to avoid SQL injection
                $warehouse_list = array_map(function($warehouse) use ($conn) {
                    return "'" . mysqli_real_escape_string($conn, $warehouse) . "'";
                }, $warehouse_list);
                
                $warehouse_dashboard_id = implode(",", $warehouse_list); // sample: 'warehouse1','warehouse2','warehouse3'
            
                $dashboard_stocks_query = "
                    SELECT
                        SUM(s.capital) AS total_capital,
                        COUNT(s.unique_barcode) AS qty
                    FROM stocks s 
                    LEFT JOIN product p ON p.hashed_id = s.product_id
                    WHERE
                    p.category = '$category_id' 
                    AND s.item_status NOT IN (1, 4, 8)
                    AND s.warehouse IN ($warehouse_dashboard_id)
                    AND p.category = '$category_id'
                    AND s.supplier = '$supplier_id'
                    AND (s.batch_code IS NOT NULL AND s.batch_code != '-')
                ";
            }            

            // Execute the stock query
            $dashboard_stocks_res = $conn->query($dashboard_stocks_query);
            if($dashboard_stocks_res->num_rows > 0){
                $row = $dashboard_stocks_res->fetch_assoc();
                $total_capital = $row['total_capital'];
                $total_qty = $row['qty'];

                $sub_total_capital += $total_capital;
                $sub_total_qty += $total_qty;

                // Add stock row to summary
                $stock_summary[] = '<tr>
                    <td><a href="../Stock-Summary/?supplier=' . $supplier_id . '&&supplier_name=' . $supplier_name . '&&category=&&category_name=&&supplier_type=' . $supplier_type . '">' . $supplier_name . '</a></td>
                    <td><a href="../Stock-Summary/?supplier=' . $supplier_id . '&&supplier_name=' . $supplier_name . '&&category=' . $category_id . '&&category_name=' . $category_name . '&&supplier_type=' . $supplier_type . '">' . $category_name . '</a></td>
                    <td>' . $total_qty . '</td>
                    <td>' . number_format($total_capital, 2) . '</td> <!-- Currency Format --> 
                </tr>';
            }
        }

        // Add supplier total row
        $stock_summary[] = '<tr class="bg-400">
            <td>' . $supplier_name . ' Total</td>
            <td></td>
            <td>' . $sub_total_qty . '</td>
            <td>' . number_format($sub_total_capital, 2) . '</td> <!-- Currency Format --> 
        </tr>';
    }
}

// Check if the stock summary is empty, if yes, create a temporary row
if(count($stock_summary) == 0) {
    $stock_summary[] = '<tr>
        <td colspan="4" class="text-center">No data available</td>
    </tr>';
}
?>

<div class="card">
    <div class="card-header">
        <h6><a href="../Stock-Summary/">Stock Summary</a> as of <?php echo $date_today;?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0 data-table fs-10" data-datatables='{"paging":false,"scrollY":"500px","scrollCollapse":true}'>
                <thead class="bg-dark">
                    <tr>
                        <th>Supplier</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($stock_summary AS $stock_summary_display){
                        echo $stock_summary_display;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

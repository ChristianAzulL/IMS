<?php
// Function to sanitize inputs
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barcodeKeyword = isset($_POST['barcode_keyword']) ? sanitizeInput($_POST['barcode_keyword']) : null;
    $startDate = isset($_POST['start_date']) ? sanitizeInput($_POST['start_date']) : null;
    $endDate = isset($_POST['end_date']) ? sanitizeInput($_POST['end_date']) : null;
    $selectedUsers = isset($_POST['multiple_users']) ? array_map('sanitizeInput', $_POST['multiple_users']) : [];
    $warehouse_selected = isset($_POST['warehouse']) ? sanitizeInput($_POST['warehouse']) : null;

    // Validate date format
    $startDateObj = DateTime::createFromFormat('d/m/y', $startDate);
    $endDateObj = DateTime::createFromFormat('d/m/y', $endDate);
    $startDateSQL = $startDateObj ? $startDateObj->format('Y-m-d') : null;
    $endDateSQL = $endDateObj ? $endDateObj->format('Y-m-d') . ' 23:59:59' : null;

    // Start building query
    $query = "SELECT hashed_id FROM outbound_logs WHERE 1=1";

    // Add date filter
    if ($startDateSQL && $endDateSQL) {
        $query .= " AND date_sent BETWEEN '$startDateSQL' AND '$endDateSQL'";
    }

    // Add warehouse filter
    if ($warehouse_selected) {
        $query .= " AND warehouse = '$warehouse_selected'";
    }

    // Add user filter
    if (!empty($selectedUsers)) {
        $selectedUsers = array_filter($selectedUsers, fn($user) => $user !== "Select staff...");
        if (!empty($selectedUsers)) {
            $userIds = "'" . implode("','", $selectedUsers) . "'";
            $query .= " AND user_id IN ($userIds)";
        }
    }

    // Debugging: Output the query
    echo "<pre>$query</pre>";

    // Execute query
    $result = mysqli_query($conn, $query);
    if ($result) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        print_r($rows);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
?>
<div class="card">
    <div class="card-body bg-body-tertiary overflow-hidden p-lg-6" style="height: 100vh;">
        <form action="../Transaction-overview/index.php" method="POST">
            <div class="tab-content row">
                <div class="col-4 mb-3">
                    <label for="barcode_keyword">Filter by Barcode /Keyword</label>
                    <input type="text" name="barcode_keyword" id="barcode_keyword" class="form-control" />
                </div>
                <div class="col-2 mb-3">
                    <label class="form-label" for="start_datepicker">Start Date</label>
                    <input class="form-control datetimepicker" name="start_date" id="start_datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' />
                </div>
                <div class="col-2 mb-3">
                    <label class="form-label" for="end_datepicker">End Date</label>
                    <input class="form-control datetimepicker" name="end_date" id="end_datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' />
                </div>
                <div class="col-4 mb-3">
                    <label for="staff_name">Staff Name</label>
                    <select class="form-select js-choice" id="staff_name" multiple="multiple" size="1" name="multiple_users[]" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option disabled selected hidden>Select staff...</option>
                        <?php 
                        $staff_sql = "SELECT * FROM users ORDER BY user_lname ASC";
                        $stmt = $conn->prepare($staff_sql); // Use prepared statements
                        $stmt->execute();
                        $res = $stmt->get_result();
                        if ($res->num_rows > 0) {
                            while ($row = $res->fetch_assoc()) {
                                $staff_name = htmlspecialchars($row['user_lname'] . ", " . $row['user_fname'], ENT_QUOTES, 'UTF-8');
                                $staff_userid = htmlspecialchars($row['hashed_id'], ENT_QUOTES, 'UTF-8');
                                echo '<option value="' . $staff_userid . '">' . $staff_name . '</option>'; 
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="warehouse">Warehouse</label>
                    <select class="form-select" name="warehouse" id="warehouse">
                    <?php echo implode("\n", $warehouse_options2); ?>
                    </select>
                </div>
                <div class="col-3 pt-4">
                    <div class="form-check mt-1">
                        <input class="form-check-input" name="group_by_product_id" id="group_by_item" type="checkbox" value="group" />
                        <label class="form-check-label" for="group_by_item">Group by Item</label>
                    </div>
                </div>
                <div class="col-4 mb-3 pt-4">
                    <button type="submit" class="btn btn-primary mt-1">Generate Report</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
}
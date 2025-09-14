<div class="card">
    <div class="card-header text-center">
        <h2>Inbound / Outbound Summary</h2>
    </div>
    <div class="card-body">
        <form action="../Inbound-Outbound-Summary/index.php" method="POST">
        <div class="row">
            <div class="col-6">
                <label for="organizerMultiple">Warehouse</label>
                <select class="form-select" name="warehouses" required>
                    <option value="">Select warehouse</option>
                    <?php 
                    $warehouses_query = "SELECT * FROM warehouse";
                    $warehouse_res = $conn->query($warehouses_query);
                    if($warehouse_res->num_rows>0){
                        while($row=$warehouse_res->fetch_assoc()){
                            echo '<option value="' . $row['hashed_id'] . '">' . $row['warehouse_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-4">
                <label class="form-label" for="timepicker2">Select Date Range</label>
                <input class="form-control datetimepicker" id="timepicker2" type="text" name="date_between" placeholder="dd/mm/yy to dd/mm/yy" data-options='{"mode":"range","dateFormat":"d/m/y","disableMobile":true}' />
            </div>
            <div class="col-2 pt-4">
                <button class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
        </form>

        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selected_Warehouse = $_POST['warehouses'];
            $date_between = $_POST['date_between']; // e.g. "14/09/25 to 16/09/25"

            // Split the string by " to "
            list($startStr, $endStr) = explode(' to ', $date_between);

            // Convert to DateTime objects
            $startDate = DateTime::createFromFormat('d/m/y', $startStr);
            $endDate = DateTime::createFromFormat('d/m/y', $endStr);

            // Set time for start and end
            $startDate->setTime(0, 0, 0);        // 00:00:00
            $endDate->setTime(23, 59, 59);       // 23:59:59

            // Format as Y-m-d H:i:s
            $startDateFormatted = $startDate->format('Y-m-d H:i:s');
            $endDateFormatted = $endDate->format('Y-m-d H:i:s');

            // Example output
            // echo $startDateFormatted . " to " . $endDateFormatted;


        ?>
        <div class="text-center">
            <p>
                NOTE: This report only includes stocks received from the beginning of last month up to today.
                Stocks received before the start of last month are NOT counted in the totals.
                Ending Inventory = (All Inbound Stocks within date range) - (All Outbound Stocks within date range)
                Amounts shown are based on recorded capital value.
            </p><br>
            <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-local.php?warehouse_id=<?php echo $selected_Warehouse;?>&&start=<?php echo $startDateFormatted;?>&&end=<?php echo $endDateFormatted;?>"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download Inventory Per Location CSV</span></a>
            
        </div>
        <?php
        }
        ?>
    </div>
</div>
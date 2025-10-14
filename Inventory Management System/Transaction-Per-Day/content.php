<div class="card">
    <div class="card-header text-center">
        <h2>Monthly Report to Export</h2>
    </div>
    <div class="card-body">
        <form action="../Transaction-Per-Day/index" method="POST">
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label" for="timepicker2">Select Date Range</label>
                    <input class="form-control datetimepicker" id="timepicker2" type="text" name="date_between" placeholder="dd/mm/yy to dd/mm/yy" data-options='{"mode":"range","dateFormat":"d/m/y","disableMobile":true}' required/>
                </div>
                <div class="col-6 mb-3">
                    <label for="">Select Warehouse</label>
                    <select name="warehouse_id" class="form-select" required>
                        <option value="" selected="">Select Warehouse</option>
                        <?php 
                        $wh_selection = "SELECT hashed_id, user_fname, user_lname FROM users ORDER BY user_lname ASC";
                        $wh_selection_res = $conn->query($wh_selection);
                        if($wh_selection_res->num_rows>0){
                            while($row=$wh_selection_res->fetch_assoc()){
                                echo '<option value="' . $row['hashed_id'] . '">' . $row['user_lname'] . ", " . $row['user_fname'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
        <?php 
        if(isset($_POST['date_between'])){
            $date_between = $_POST['date_between']; // e.g. "14/09/25" or "14/09/25 to 16/09/25"
            $selected_wh = $_POST['warehouse_id'];

            if (strpos($date_between, ' to ') !== false) {
                // It's a range
                list($startStr, $endStr) = explode(' to ', $date_between);

                $startDate = DateTime::createFromFormat('d/m/y', $startStr);
                $endDate   = DateTime::createFromFormat('d/m/y', $endStr);

                $startDate->setTime(0, 0, 0);
                $endDate->setTime(23, 59, 59);
            } else {
                // It's a single date
                $startDate = DateTime::createFromFormat('d/m/y', $date_between);
                $endDate   = clone $startDate;

                $startDate->setTime(0, 0, 0);
                $endDate->setTime((int)date('H'), (int)date('i'), (int)date('s')); // current time
            }

            $startDateFormatted = $startDate->format('Y-m-d H:i:s');
            $endDateFormatted   = $endDate->format('Y-m-d H:i:s');

            // Example output
            // echo $startDateFormatted . " to " . $endDateFormatted;
        ?>
        <div class="text-center">
            <p>
                Please note: This is a <strong>demo version</strong> of the system.  
                CSV downloads are currently limited.  
                The complete functionality will be accessible upon client approval of the quotation.
            </p><br>
            <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-otl.php?start=<?php echo $startDateFormatted;?>&&end=<?php echo $endDateFormatted;?>&&user=<?php echo $selected_wh;?>"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download Outbound Transactions CSV</span></a>
            <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-itl.php?start=<?php echo $startDateFormatted;?>&&end=<?php echo $endDateFormatted;?>&&user=<?php echo $selected_wh;?>"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download Inbound Transactions CSV</span></a>
            
        </div>
        <?php 
        }
        ?>
    </div>
</div>
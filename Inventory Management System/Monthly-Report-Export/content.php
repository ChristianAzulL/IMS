<div class="card">
    <div class="card-header text-center">
        <h2>Monthly Report to Export</h2>
    </div>
    <div class="card-body">
        <form action="../Monthly-Report-Export/index" method="POST">
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label" for="timepicker2">Select Date Range</label>
                    <input class="form-control datetimepicker" id="timepicker2" type="text" name="date_between" placeholder="dd/mm/yy to dd/mm/yy" data-options='{"mode":"range","dateFormat":"d/m/y","disableMobile":true}' />
                </div>
                <div class="col-12 mb-3">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
        <?php 
        if(isset($_POST['date_between'])){
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
                Please note: This is a <strong>demo version</strong> of the system.  
                CSV downloads are currently limited.  
                The complete functionality will be accessible upon client approval of the quotation.
            </p><br>
            <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-isl.php?start=<?php echo $startDateFormatted;?>&&end=<?php echo $endDateFormatted;?>"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download Inventory Summary Per Location CSV</span></a>
            <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-otl.php?start=<?php echo $startDateFormatted;?>&&end=<?php echo $endDateFormatted;?>"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download Outbound Transactions Per Location CSV</span></a>
            <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-itl.php?start=<?php echo $startDateFormatted;?>&&end=<?php echo $endDateFormatted;?>"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download Inbound Transactions Per Location CSV</span></a>
            
        </div>
        <?php 
        }
        ?>
    </div>
</div>
<div class="card">
    <div class="card-header text-center">
        <h2>Inventory Per Supplier</h2>
    </div>
    <div class="card-body">
        <?php 
            $supplier_query = "SELECT * FROM supplier WHERE (local_international !='International' OR local_international !='Local') AND current_status = 0";
            $supplier_res = $conn->query($supplier_query);
            if($supplier_res->num_rows>0){
            ?>
            <div class="text-center">
                <p>
                    Action required: One or more suppliers have not been assigned a classification.  
                    Please update their records by specifying whether they are <strong>"Local"</strong> or <strong>"Import"</strong>.
                </p>
            </div>

            <?php
            } else {
            ?>
            <div class="text-center">
                <p>
                    Please note: This is a <strong>demo version</strong> of the system.  
                    CSV downloads are currently limited to <strong>three categories</strong>.  
                    The complete functionality will be accessible upon client approval of the quotation.
                </p><br>
                <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-local.php"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download Inventory Per Supplier Local CSV</span></a>
                <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-imports.php"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download Inventory Per Supplier Imports CSV</span></a>
            </div>

            
            <?php
            }
        ?>
    </div>
</div>
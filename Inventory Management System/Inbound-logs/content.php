<?php
// Unset session variable if set
if (isset($_SESSION['inbound_id'])) {
    unset($_SESSION['inbound_id']);
}

// Get total count for pagination
$count_sql = "SELECT COUNT(*) as total FROM inbound_logs";
$count_res = $conn->query($count_sql);
$total_rows = $count_res->fetch_assoc()['total'];
$limit = 10; // Number of records per page
$total_pages = ceil($total_rows / $limit);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch inbound log records with necessary joins
$inbound_sql = "SELECT il.*, u.user_fname, u.user_lname, w.warehouse_name, s.supplier_name 
                FROM inbound_logs il
                LEFT JOIN users u ON u.hashed_id = il.user_id
                LEFT JOIN warehouse w ON w.hashed_id = il.warehouse
                LEFT JOIN supplier s ON s.hashed_id = il.supplier
                ORDER BY il.id DESC";
$inbound_res = $conn->query($inbound_sql);
?>

<div class="card">
    <div class="card-body overflow-hidden py-6 px-0">
        <div class="row justify-content-between gx-3 gy-0 px-3">
            <div id="tableExample3" data-list='{"valueNames":["inbound_no","po_no","warehouse","supplier","date","receiver"],"page":5,"pagination":true}'>
                <div class="row justify-content-end g-0">
                    <?php 
                    if(strpos($access, "new_inbound")!==false){
                    ?>
                    <div class="col-auto mb-3">
                        <button class="btn btn-primary py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Create</button>
                        <button class="btn btn-warning py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#csv-modal"><span class="fas fa-file-csv"></span> Upload CSV</button>
                        <button class="btn btn-warning py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#csv-modal-unique"><span class="fas fa-file-csv"></span> Upload CSV(Unique Barcodes)</button>
                    </div>
                    <?php 
                    }
                    ?>
                    <div class="col-sm-auto">
                        <select class="form-select form-select-sm mb-3" data-list-filter="warehouse">
                            <option selected value="">Select warehouse</option>
                            <?php echo implode("\n", $warehouse_options); ?>
                        </select>
                    </div>
                    <div class="col-auto col-sm-5 mb-3">
                        <form>
                            <div class="input-group">
                                <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                                <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Table -->
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs-10 mb-0">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 sort" data-sort="inbound_no">Inbound no.</th>
                                <th class="text-900 sort" data-sort="po_no">P.O no.</th>
                                <th class="text-900 sort" data-sort="warehouse">Warehouse</th>
                                <th class="text-900 sort" data-sort="supplier">Supplier</th>
                                <th class="text-900 sort" data-sort="date">Date Received</th>
                                <th class="text-900 sort" data-sort="receiver">Received by</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="table-body">
                            <?php while ($row = $inbound_res->fetch_assoc()) { ?>
                                <tr>
                                    <td class="inbound_no">
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#view-modal" target-id="<?php echo $row['unique_key']; ?>">
                                            <strong><?php echo $row['unique_key']; ?></strong>
                                        </a>
                                    </td>
                                    <td class="po_no">PO#<?php echo $row['po_id']; ?></td>
                                    <td class="warehouse"><?php echo $row['warehouse_name']; ?></td>
                                    <td class="supplier"><?php echo $row['supplier_name']; ?></td>
                                    <td class="date"><?php echo $row['date_received']; ?></td>
                                    <td class="receiver"><?php echo $row['user_fname'] . " " . $row['user_lname']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Controls -->
                <div class="d-flex justify-content-center mt-3">
                    <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                    <ul class="pagination mb-0"></ul>
                    <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="target-id"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- upcoming -->
<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Select Supplier</h4>
        </div>
        <div class="p-4 pb-0">
          <form action="set_inbound_session.php" method="POST">
          <div class="row">

            <div class="col-lg-5 mb-3">
              <label for="">P.O no</label>
              <select name="po_id" class="form-select" required>
                <option value="" selected>Select Purchased Order #</option>
                <?php 
                  // Quote each ID in the array
                  $quoted_warehouse_ids = array_map(function ($id) {
                    return "'" . trim($id) . "'";
                  }, $user_warehouse_ids);

                  // Create a comma-separated string of quoted IDs
                  $imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);
                  // Ensure that $imploded_warehouse_ids is safely included in the query to avoid SQL injection
                  if (isset($imploded_warehouse_ids) && !empty($imploded_warehouse_ids)) {
                    // Assuming $imploded_warehouse_ids is a comma-separated string of integers
                    $po_query = "SELECT id FROM purchased_order WHERE warehouse IN ($imploded_warehouse_ids) AND date_received IS NULL ORDER BY id DESC";
                    
                    // Execute the query
                    $res = $conn->query($po_query);

                    // Check if the query is successful and returns rows
                    if ($res) {
                      if ($res->num_rows > 0) {
                        // Output the options for PO
                        while ($row = $res->fetch_assoc()) {
                          echo '<option value="' . htmlspecialchars($row['id']) . '">PO-' . htmlspecialchars($row['id']) . '</option>';
                        }
                      } else {
                        // If no rows returned, suggest creating a PO
                        echo '<option value="">No POs found, please create one</option>';
                      }
                    } else {
                      // Handle query failure (optional)
                      echo '<option value="">Error fetching data</option>';
                    }
                  } else {
                    echo '<option value="">Invalid or empty warehouse IDs</option>';
                  }
                ?>
              </select>

            </div>

            <div class="col-lg-7 mb-3">
              <label class="form-label" for="datepicker">Received Date</label>
              <input class="form-control datetimepicker" name="received_date" id="datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' required/>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Next</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="csv-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Upload CSV</h4>
        </div>
        <div class="p-4 pb-0">
          <form action="../csv-select/index" method="POST" enctype="multipart/form-data">
          <div class="row">

            <div class="col-lg-5 mb-3">
              <label class="col-form-label" for="recipient-name">Warehouse:</label>
              <select class="form-select" id="warehouse" required="required" name="warehouse" required>
                <option value="">Select warehouse...</option>
                  <?php echo implode("\n", $warehouse_options2); ?>
                <?php ?>
              </select>
              <div class="invalid-feedback">Please select one</div>
            </div>

            <div class="col-lg-4 mb-3">
              <label class="form-label" for="datepicker">Received Date</label>
              <input class="form-control datetimepicker" name="received_date" id="datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' required/>
            </div>
            
            <div class="col-lg-5 mb-3">
                <label for="">Upload CSV</label>
                <input type="file" name="csv_file" id="input_csv" class="form-control" accept=".csv" required>
            </div>

            

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" type="submit" name="submit" value="Upload CSV">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="csv-modal-unique" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Upload CSV</h4>
        </div>
        <div class="p-4 pb-0">
          <form action="../csv-select-unique/index" method="POST" enctype="multipart/form-data">
          <div class="row">

            <div class="col-lg-5 mb-3">
              <label class="col-form-label" for="recipient-name">Warehouse:</label>
              <select class="form-select" id="warehouse" required="required" name="warehouse" required>
                <option value="">Select warehouse...</option>
                  <?php echo implode("\n", $warehouse_options2); ?>
                <?php ?>
              </select>
              <div class="invalid-feedback">Please select one</div>
            </div>

            <div class="col-lg-4 mb-3">
              <label class="form-label" for="datepicker">Received Date</label>
              <input class="form-control datetimepicker" name="received_date" id="datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' required/>
            </div>
            
            <div class="col-lg-5 mb-3">
                <label for="">Upload CSV</label>
                <input type="file" name="csv_file" id="input_csv" class="form-control" accept=".csv" required>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-primary" type="submit" name="submit" value="Upload CSV">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Load modal content dynamically
$(document).on("click", "a[data-bs-toggle='modal']", function() {
    var targetId = $(this).attr("target-id"); // Get unique key
    $("#target-id").load("form-content.php?id=" + targetId); // Load content
});
</script>

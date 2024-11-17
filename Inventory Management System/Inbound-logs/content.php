<?php
// Unset the specific session variable
if (isset($_SESSION['inbound_id'])) {
  unset($_SESSION['inbound_id']);
}
?>
<!-- <div class="card">
<div class="card-body overflow-hidden p-lg-6">
    <div class="row align-items-center">
    <div class="col-lg-6"><img class="img-fluid" src="../assets/img/icons/spot-illustrations/21.png" alt="" /></div>
    <div class="col-lg-6 ps-lg-4 my-5 text-center text-lg-start">
        <h3 class="text-primary">Edit me!</h3>
        <p class="lead">Create Something Beautiful.</p><a class="btn btn-falcon-primary" href="../documentation/getting-started.html">Getting started</a>
    </div>
    </div>
</div>
</div> -->
<div class="card">
  <div class="card-body overflow-hidden py-6 px-0">
<div id="tableExample4" data-list='{"valueNames":["inbound_no","po_no","supplier","date","receiver"]}'>
  <div class="row justify-content-end justify-content-end gx-3 gy-0 px-3">
    <div class="col-auto mb-3">
      <button class="btn btn-primary py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Create</button>
      <button class="btn btn-warning py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#csv-modal"><span class="fas fa-file-csv"></span> Upload CSV</button>
    </div>
    <!-- <div class="col-sm-auto"><select class="form-select form-select-sm mb-3" data-list-filter="country">
        <option selected="" value="">Select country</option>
        <option value="usa">USA</option>
        <option value="canada">Canada</option>
        <option value="uk">UK</option>
      </select></div> -->
    <div class="col-sm-auto"><select class="form-select form-select-sm mb-3" data-list-filter="warehouse">
      <option selected="" value="">Select Warehouse</option>
      <?php echo implode("\n", $warehouse_options); ?>
      <!-- <option value="Pending">Pending</option>
      <option value="Success">Received</option>
      <option value="Blocked">Sent to Supplier</option> -->
    </select></div>
    
    <div class="col-auto col-sm-5 mb-3">
      <form>
        <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
          <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
        </div>
      </form>
    </div>
  </div>
  <div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
      <thead class="bg-200">
        <tr>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="inbound_no">Inbound no.</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="po_no">P.O no.</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="warehouse">Warehouse</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="supplier">Supplier</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="date">Date Received</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="receiver">Received by</th>
        </tr>
      </thead>
      <tbody class="list" id="table-purchase-body">
        <?php 
        // Convert the IDs to a comma-separated string for the WHERE IN clause
        $imploded_warehouse_ids = implode(",", $user_warehouse_ids);

        $inbound_sql = "SELECT il.*, u.user_fname, u.user_lname, w.warehouse_name, s.supplier_name
                        FROM inbound_logs il
                        LEFT JOIN users u ON u.hashed_id = il.user_id
                        LEFT JOIN warehouse w ON w.hashed_id = il.warehouse
                        LEFT JOIN supplier s ON s.hashed_id = il.supplier
                        WHERE il.warehouse IN ('$imploded_warehouse_ids')
                        ORDER BY il.id DESC";
        $inbound_res = $conn->query($inbound_sql);
        if($inbound_res->num_rows>0){
          while($row=$inbound_res->fetch_assoc()){
            $inbound_id = $row['id'];
            $inbound_sales_invoice = $row['sales_invoice'];
            $inbound_date = $row['date_received'];
            $inbound_supplier = $row['supplier_name'];
            $inbound_receiver = $row['user_fname'] . " " . $row['user_lname'];
            $inbound_warehouse = $row['warehouse_name'];
            $inbound_po = $row['po_id'];
        ?>
        <tr class="btn-reveal-trigger">
          <td class="align-middle white-space-nowrap inbound_no"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal"><?php echo $inbound_sales_invoice;?></a></td>
          <td class="align-middle white-space-nowrap po_no"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO#<?php echo $inbound_po;?></a></td>
          <td class="align-middle white-space-nowrap warehouse"><?php echo $inbound_warehouse;?></td>
          <td class="align-middle white-space-nowrap supplier"><?php echo $inbound_supplier;?></td>
          <td class="align-middle white-space-nowrap date"><?php echo $inbound_date; ?></td>
          <td class="align-middle white-space-nowrap receiver"><?php echo $inbound_receiver;?></td>
        </tr>
        <?php 
          }
        } else {
          ?>
        <tr class="text-center">
          <td class="py-6" colspan="6"><h4> No Data yet</h4></td>
        </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>


<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <!-- Embed the PDF using an iframe -->
        <iframe id="pdfViewer" src="" width="100%" height="600px"></iframe>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <!-- <button class="btn btn-primary" type="button">Understood </button> -->
        <a href="../Receive-po/" class="btn btn-primary" type="button">Recieve P.O </a>
      </div>
    </div>
  </div>
</div>

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
            <div class="col-lg-12 mb-3">
              <label class="col-form-label" for="recipient-name">Supplier:</label>
              <select class="form-select js-choice" id="ItemDestination" size="1" required="required" name="supplier" data-options='{"removeItemButton":true,"placeholder":true, "required":true}' required>
                <option value="">Select Supplier...</option>
                <?php 
                $option_supplier_query = "SELECT * FROM supplier ORDER BY supplier_name ASC";
                $option_supplier_res = $conn->query($option_supplier_query);
                if($option_supplier_res->num_rows>0){
                  while($row = $option_supplier_res->fetch_assoc()){
                    $option_supplier_id = $row['hashed_id'];
                    $option_supplier_name = $row['supplier_name'];
                    echo '<option value="' . $option_supplier_id . '">' . $option_supplier_name . '</option>';
                  }
                } else {
                  echo "<option value=''>No supplier found</option>";
                }
                ?>
              </select>
              <div class="invalid-feedback">Please select one</div>
            </div>

            <div class="col-lg-5 mb-3">
              <label class="col-form-label" for="recipient-name">Warehouse:</label>
              <select class="form-select" id="warehouse" required="required" name="warehouse" required>
                <option value="">Select warehouse...</option>
                <<?php echo implode("\n", $warehouse_options); ?>
                <?php ?>
              </select>
              <div class="invalid-feedback">Please select one</div>
            </div>

            <div class="col-lg-3 mb-3">
              <label for="">P.O no</label>
              <input type="number" name="po_id" class="form-control" required>
            </div>

            <div class="col-lg-4 mb-3">
              <label class="form-label" for="datepicker">Received Date</label>
              <input class="form-control datetimepicker" name="received_date" id="datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' required/>
            </div>
            
            <hr>
            
            <div class="col-lg-7 mb-3">
              <label class="col-form-label" for="message-text">Driver:</label>
              <input type="text" name="driver" class="form-control" placeholder="Enter Driver name">
            </div>
            <div class="col-lg-5 mb-3">
              <label  class="col-form-label" for="">Plate no.</label>
              <input type="text" name="plate_num" class="form-control" placeholder="Enter Plate no.">
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
                  <?php echo implode("\n", $warehouse_options); ?>
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

            <div class="col-lg-3 mb-3">
              <label for="">P.O no</label>
              <input type="number" name="po_id" class="form-control" required>
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

<!-- Script to load the PDF dynamically -->
<script>
    // var pdfModal = document.getElementById('pdfModal');
    // pdfModal.addEventListener('show.bs.modal', function (event) {
    //     // Set the PDF URL when the modal is shown
    //     var pdfViewer = document.getElementById('pdfViewer');
    //     pdfViewer.src = "../../HIRC-OFFICIAL-PRICELIST-DEALER (1).pdf";  // Change this to your PDF file path
    // });

    // pdfModal.addEventListener('hidden.bs.modal', function (event) {
    //     // Clear the PDF URL when the modal is hidden
    //     var pdfViewer = document.getElementById('pdfViewer');
    //     pdfViewer.src = "";
    // });
</script>
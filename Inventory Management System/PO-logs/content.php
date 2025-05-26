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
  <div class="card-header bg-warning">
    <h2 class="text-white">Purchased Order Logs</h2>
  </div>
  <div class="card-body overflow-hidden py-6 px-0">
<div id="tableExample4" data-list='{"valueNames":["name","supplier","country","email","payment", "warehouse"]}'>
  <div class="row justify-content-end justify-content-end gx-3 gy-0 px-3">
    <div class="col-auto mb-3">
      <!-- <button class="btn btn-primary py-0 me-auto">Create</button> -->
      <button class="btn btn-primary py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Create</button>
    </div>
    <!-- <div class="col-sm-auto"><select class="form-select form-select-sm mb-3" data-list-filter="country">
        <option selected="" value="">Select country</option>
        <option value="usa">USA</option>
        <option value="canada">Canada</option>
        <option value="uk">UK</option>
      </select></div> -->
    <div class="col-sm-auto"><select class="form-select form-select-sm mb-3" data-list-filter="warehouse">
        <option selected="" value="">All Warehouse</option>
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
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="name">P.O no.</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="warehouse" >Warehouse</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="supplier">Supplier</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="country">Date</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="email">Created by</th>
          <th class="text-900 sort align-middle white-space-nowrap text-end pe-4" data-sort="payment">Status</th>
          
        </tr>
      </thead>
      <tbody class="list" id="table-purchase-body">
        <?php 
        // Quote each ID in the array
        $quoted_warehouse_ids = array_map(function ($id) {
          return "'" . trim($id) . "'";
        }, $user_warehouse_ids);

        // Create a comma-separated string of quoted IDs
        $imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);
        // Create the unique query to fetch orders for the specified warehouses
        $purchased_order_query = "
        SELECT po.*, u.user_fname, u.user_lname, s.supplier_name, wh.warehouse_name
        FROM purchased_order po
        LEFT JOIN users u ON u.hashed_id = po.user_id
        LEFT JOIN supplier s ON s.hashed_id = po.supplier
        LEFT JOIN warehouse wh ON wh.hashed_id = po.warehouse
        WHERE po.warehouse IN ($imploded_warehouse_ids)
        ORDER BY po.id DESC";
        $purchased_order_res = $conn->query($purchased_order_query);
        if($purchased_order_res->num_rows>0){
          while($row=$purchased_order_res->fetch_assoc()){
            $po_id = $row['id'];
            $po_supplier = $row['supplier_name'];
            $date_created = $row['date_order'];
            $by = $row['user_fname'] . " " . $row['user_lname'];
            $from_warehouse = $row['warehouse_name'];
            if($row['status'] == 0){
              $status = '<span class="badge badge rounded-pill badge-subtle-warning">Drafted  <div class="spinner-border" role="status" style="height:10px; width: 10px;"><span class="visually-hidden">Loading...</span></div></span>';
            } elseif($row['status'] == 1){
              $status = '<span class="badge badge rounded-pill badge-subtle-info">Sent to Supplier<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>';
            } elseif($row['status'] == 2) {
              $status = '<span class="badge badge rounded-pill badge-subtle-secondary">Confirmed by Supplier<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>';
            } elseif($row['status'] == 3){
              $status = '<span class="badge badge rounded-pill badge-subtle-primary">In Transit/ Shipped<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>';
            } else {
              $status = '<span class="badge badge rounded-pill badge-subtle-success">Received<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>';
            }
        ?>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap name"><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#pdfModal<?php echo $po_id;?>">PO-<?php echo $po_id;?></a></th>
          <td class="align-middle white-space-nowrap warehouse" ><span class="badge bg-warning"><?php echo $from_warehouse;?></span></td>
          <td class="align-middle white-space-nowrap supplier"><?php echo $po_supplier;?></td>
          <td class="align-middle white-space-nowrap country"><?php echo $date_created;?></td>
          <td class="align-middle white-space-nowrap email"><?php echo $by;?></td>
          <td class="align-middle text-end fs-9 white-space-nowrap payment"><?php echo $status;?></td>
        </tr>
        <?php 
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>


<?php 
$modal_po_query = "SELECT * FROM purchased_order WHERE warehouse IN ($imploded_warehouse_ids)";
$modal_po_res = $conn->query($modal_po_query);
while($row = $modal_po_res->fetch_assoc()){
    $modal_po_id = $row['id'];
    $modal_pdf_blob = $row['pdf'];

    // Encode the binary PDF data as Base64
    $base64_pdf = base64_encode($modal_pdf_blob);
    $pdf_data_url = "data:application/pdf;base64,$base64_pdf";
?>
<div class="modal fade" id="pdfModal<?php echo $modal_po_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <!-- Embed the PDF using an iframe -->
        <iframe id="pdfViewer<?php echo $modal_po_id;?>" src="<?php echo $pdf_data_url; ?>" width="100%" height="600px"></iframe>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <?php 
        if($row['status'] == 0){
          $status = '<a href="../config/receive-po.php?status=1&&po=' . $modal_po_id . '" class="btn btn-info requires-confirmation" type="button">Sent to supplier</a>';
        } elseif($row['status'] == 1){
          $status = '<a href="../config/receive-po.php?status=2&&po=' . $modal_po_id . '" class="btn btn-secondary requires-confirmation" type="button">Confirmed by supplier</a>';
        } elseif($row['status'] == 2) {
          $status = '<a href="../config/receive-po.php?status=3&&po=' . $modal_po_id . '" class="btn btn-primary requires-confirmation" type="button">In Transit/ Shipped</a>';
        } elseif($row['status'] == 3){
          $status = '<a href="../config/receive-po.php?status=4&&po=' . $modal_po_id . '" class="btn btn-success requires-confirmation" type="button">Received</a>';
        } else {
          $status = '';
        }
        echo $status;
        ?>
      </div>
    </div>
  </div>
</div>
<?php 
}
?>



<!-- create po modal -->
<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <form action="set_session.php" method="POST">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Select Warehouse </h4>
        </div>
        <div class="p-4 pb-0 mb-3">
          <div class="row">
            <div class="col-12">
              <label for="">Warehouse</label>
              <select name="warehouse" id="warehouse" class="form-select">
                <option value=""></option>
                <?php 
                // Loop through each ID and display differently for the first item
                foreach ($user_warehouse_ids as $id) {
                  // Trim any extra whitespace
                  $id = trim($id);
                  $warehouse_info_query = "SELECT * FROM warehouse WHERE hashed_id = '$id'";
                  $warehouse_info_result = $conn->query($warehouse_info_query);
                  if($warehouse_info_result->num_rows>0){
                      // Check if it's the first item
                      $row=$warehouse_info_result->fetch_assoc();
                      $tab_warehouse_name = $row['warehouse_name'];
                      echo '<option value="' . $id . '">' . $tab_warehouse_name . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-12 mb-3">
              <label class="form-label" for="datepicker">Date Ordered</label>
              <input class="form-control datetimepicker" name="date_order" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' required/>
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="btn-submit-modal" type="submit">Next </button>
      </div>
    </div>
  </div>
  </form>
</div>



<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const submitBtn = document.getElementById('btn-submit-modal');
    const warehouseSelect = document.getElementById('warehouse');
    const dateInput = document.querySelector('input[name="date_order"]');

    // Hide submit button initially
    submitBtn.style.display = 'none';

    function toggleSubmitButton() {
      const warehouseFilled = warehouseSelect.value.trim() !== '';
      const dateFilled = dateInput.value.trim() !== '';
      submitBtn.style.display = (warehouseFilled && dateFilled) ? 'inline-block' : 'none';
    }

    warehouseSelect.addEventListener('change', toggleSubmitButton);
    dateInput.addEventListener('input', toggleSubmitButton);

    // If using a date picker like flatpickr, wait for its change
    dateInput.addEventListener('change', toggleSubmitButton);
  });
</script>

<script>
// Wait for the page to load
document.addEventListener('DOMContentLoaded', function() {
    // Get all anchor tags with class 'requires-confirmation'
    const links = document.querySelectorAll('.requires-confirmation');

    links.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Stop the default link click

            const href = this.getAttribute('href'); // Get the link

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to proceed?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href; // Redirect if confirmed
                }
            });
        });
    });
});
</script>

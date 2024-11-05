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
        // Convert the IDs to a comma-separated string for the WHERE IN clause
        $imploded_warehouse_ids = implode(",", $user_warehouse_ids);
        // Create the unique query to fetch orders for the specified warehouses
        $purchased_order_query = "
        SELECT po.*, u.user_fname, u.user_lname, s.supplier_name ,wh.warehouse_name
        FROM purchased_order po 
        LEFT JOIN users u ON u.id = po.user_id 
        LEFT JOIN supplier s ON s.id = po.supplier 
        LEFT JOIN warehouse wh ON wh.id = po.warehouse
        WHERE po.warehouse IN ($imploded_warehouse_ids) 
        ORDER BY po.id DESC";
        $purchased_order_res = $conn->query($purchased_order_query);
        if($purchased_order_res->num_rows>-0){
          while($row=$purchased_order_res->fetch_assoc()){
            $po_id = $row['id'];
            $po_supplier = $row['supplier_name'];
            $date_created = $row['date_order'];
            $by = $row['user_fname'] . " " . $row['user_lname'];
            $from_warehouse = $row['warehouse_name'];
            if($row['status'] == 0){
              $status = '<span class="badge badge rounded-pill badge-subtle-warning">Pending  <div class="spinner-border" role="status" style="height:10px; width: 10px;"><span class="visually-hidden">Loading...</span></div></span>';
            } elseif($row['status'] == 1){
              $status = '<span class="badge badge rounded-pill badge-subtle-success">Sent to Supplier<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>';
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


<!-- pdf modal -->
<?php 
$modal_po_query = "SELECT * FROM purchased_order WHERE warehouse IN ($imploded_warehouse_ids)";
$modal_po_res = $conn->query($modal_po_query);
while($row = $modal_po_res->fetch_assoc()){
  $modal_po_id = $row['id'];
  $modal_pdf = $row['pdf'];
?>
<div class="modal fade" id="pdfModal<?php echo $modal_po_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        
        <!-- Embed the PDF using an iframe -->
        <iframe id="pdfViewer" src="../../PDFs/<?php echo $modal_pdf;?>" width="100%" height="600px"></iframe>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <!-- <button class="btn btn-primary" type="button">Understood </button> -->
        <a href="../Receive-po/" class="btn btn-primary" type="button">Recieve P.O </a>
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
        <div class="p-4 pb-0">
          <label for="">Warehouse</label>
          <select name="warehouse" id="warehouse" class="form-select">
            <option value=""></option>
            <?php 
            // Loop through each ID and display differently for the first item
            foreach ($user_warehouse_ids as $id) {
              // Trim any extra whitespace
              $id = trim($id);
              $warehouse_info_query = "SELECT * FROM warehouse WHERE id = '$id'";
              $warehouse_info_result = mysqli_query($conn, $warehouse_info_query);
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
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Next </button>
      </div>
    </div>
  </div>
  </form>
</div>




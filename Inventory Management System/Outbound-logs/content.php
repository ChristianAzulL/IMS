<?php 
// Unset the session variable if it exists
if (isset($_SESSION['outbound_id'])) {
    unset($_SESSION['outbound_id']);
}
?>

<div class="card">
  <div class="card-body overflow-hidden py-6 px-0">
    <div id="tableExample4" data-list='{"valueNames":["outbound_no","po_no","supplier","date","receiver","warehouse"]}'>
      <div class="row">
        <div class="col-12 ps-5 mb-3">
          <h4>OUTBOUND LOGS</h4>
        </div>
      </div>
      <!-- Buttons and Filter Section -->
      <div class="row justify-content-end gx-3 gy-0 px-3">
        

        <div class="col-sm-auto">
          <select class="form-select form-select-sm mb-3" data-list-filter="warehouse">
            <option selected="" value="">Select Warehouse</option>
            <?php echo implode("\n", $warehouse_options); ?>
          </select>
        </div>

        <div class="col-auto col-sm-5 mb-3">
          <form>
            <div class="input-group">
              <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
              <div class="input-group-text bg-transparent">
                <span class="fa fa-search fs-10 text-600"></span>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Table Section -->
      <div class="table-responsive scrollbar">
        <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
          <thead class="bg-200">
            <tr>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="outbound_no">Outbound no.</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="warehouse">Warehouse</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="date">Date Received</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="receiver">Received by</th>
            </tr>
          </thead>
          <tbody class="list" id="table-purchase-body">
            <?php 
            // Prepare warehouse IDs for SQL query
            $quoted_warehouse_ids = array_map(function ($id) {
              return "'" . trim($id) . "'";
            }, $user_warehouse_ids);
            $imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);

            // SQL Query to fetch outbound logs
            $outbound_sql = "SELECT ol.*, u.user_fname, u.user_lname, w.warehouse_name
                            FROM outbound_logs ol
                            LEFT JOIN users u ON u.hashed_id = ol.user_id
                            LEFT JOIN warehouse w ON w.hashed_id = ol.warehouse
                            WHERE ol.warehouse IN ($imploded_warehouse_ids)
                            ORDER BY ol.id DESC";

            $outbound_res = $conn->query($outbound_sql);

            // Display outbound logs or a 'No Data' message
            if ($outbound_res->num_rows > 0) {
              while ($row = $outbound_res->fetch_assoc()) {
                $outbound_id = $row['hashed_id'];
                $outbound_warehouse = $row['warehouse_name'];
                $outbound_date = $row['date_sent'];
                $outbound_receiver = $row['customer_fullname'];
            ?>
            <tr class="btn-reveal-trigger">
              <td class="align-middle white-space-nowrap outbound_no">
                <a href="../../app/e-commerce/customer-details.html" type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">
                  <?php echo $outbound_id; ?>
                </a>
              </td>
              <td class="align-middle white-space-nowrap warehouse">
                <?php echo $outbound_warehouse; ?>
              </td>
              <td class="align-middle white-space-nowrap date">
                <?php echo $outbound_date; ?>
              </td>
              <td class="align-middle white-space-nowrap receiver">
                <?php echo $outbound_receiver; ?>
              </td>
            </tr>
            <?php 
              }
            } else {
            ?>
            <tr class="text-center">
              <td class="py-6" colspan="6">
                <h4>No Data yet</h4>
              </td>
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

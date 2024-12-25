<?php 
// Unset the session variable if it exists
if (isset($_SESSION['Stock_id'])) {
    unset($_SESSION['Stock_id']);
}
?>

<div class="card">
  <div class="card-body overflow-hidden py-6 px-0">
    <div id="tableExample4" data-list='{"valueNames":["Stock_no","po_no","supplier","date","receiver","warehouse"]}'>
      <div class="row">
        <div class="col-12 ps-5 mb-3">
          <h4>Stock LOGS</h4>
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
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="Stock_no">Details</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="receiver">Fulfillment Status</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="warehouse">From</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="receiver">Sent By</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="date">Date Sent</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="date">Sender Remarks</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="receiver">To</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="receiver">Date Received</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="receiver">Received By</th>
              <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="date">Receiver Remarks</th>
            </tr>
          </thead>
          <tbody class="list" id="table-purchase-body">
            <?php 
            // Prepare warehouse IDs for SQL query
            $quoted_warehouse_ids = array_map(fn($id) => "'" . trim($id) . "'", $user_warehouse_ids);
            $imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);

            // SQL Query to fetch Stock logs with joins for related data
            $Stock_sql = "
              SELECT 
                st.*, 
                fw.warehouse_name AS from_warehouse_name, 
                tw.warehouse_name AS to_warehouse_name, 
                CONCAT(fu.user_fname, ' ', fu.user_lname) AS from_fullname, 
                CONCAT(ru.user_fname, ' ', ru.user_lname) AS receiver_fullname
              FROM 
                stock_transfer st
              LEFT JOIN warehouse fw ON st.from_warehouse = fw.hashed_id
              LEFT JOIN warehouse tw ON st.to_warehouse = tw.hashed_id
              LEFT JOIN users fu ON st.from_userid = fu.hashed_id
              LEFT JOIN users ru ON st.received_userid = ru.hashed_id
              WHERE 
                st.from_warehouse IN ($imploded_warehouse_ids) 
                OR st.to_warehouse IN ($imploded_warehouse_ids)
              ORDER BY st.id DESC";

            $Stock_res = $conn->query($Stock_sql);

            if ($Stock_res->num_rows > 0) {
              while ($row = $Stock_res->fetch_assoc()) {
                $transfer_id = $row['id'];
                $batch_codes = [];

                // Fetch batch codes for the transfer
                $transfer_contents_sql = "
                  SELECT s.batch_code 
                  FROM stock_transfer_content tc
                  LEFT JOIN stocks s ON tc.unique_barcode = s.unique_barcode
                  WHERE tc.st_id = '$transfer_id'
                  ORDER BY s.batch_code DESC";

                $content_res = $conn->query($transfer_contents_sql);
                while ($content_row = $content_res->fetch_assoc()) {
                  $batch_codes[] = $content_row['batch_code'];
                }

                $imploded_batch_codes = implode(", ", $batch_codes);
                $truncatedText = strlen($imploded_batch_codes) > 50 ? substr($imploded_batch_codes, 0, 50) . "..." : $imploded_batch_codes;

                $status_badge = match ($row['status']) {
                  "PENDING" => '<span class="badge bg-primary">Pending</span>',
                  "ENROUTE" => '<span class="badge bg-warning">Enroute</span>',
                  "RECEIVED" => '<span class="badge bg-success">Received</span>',
                  default => '<span class="badge bg-danger">Failed</span>',
                };
            ?>
            <tr class="btn-reveal-trigger">
              <td class="align-middle white-space-nowrap Stock_no">
                <a href="../../app/e-commerce/customer-details.html" type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">
                  <?php echo $truncatedText; ?>
                </a>
              </td>
              <td class="align-middle white-space-nowrap warehouse"><?php echo $status_badge; ?></td>
              <td class="align-middle white-space-nowrap date"><?php echo $row['from_warehouse_name']; ?></td>
              <td class="align-middle white-space-nowrap receiver"><?php echo $row['from_fullname']; ?></td>
              <td class="align-middle white-space-nowrap receiver"><?php echo $row['date_out']; ?></td>
              <td class="align-middle white-space-nowrap receiver"><?php echo $row['remarks_sender']; ?></td>
              <td class="align-middle white-space-nowrap receiver"><?php echo $row['to_warehouse_name']; ?></td>
              <td class="align-middle white-space-nowrap receiver"><?php echo $row['date_received']; ?></td>
              <td class="align-middle white-space-nowrap receiver"><?php echo $row['receiver_fullname']; ?></td>
              <td class="align-middle white-space-nowrap receiver"><?php echo $row['remarks_receiver']; ?></td>
            </tr>
            <?php 
              }
            } else {
            ?>
            <tr class="text-center">
              <td class="py-6" colspan="10">
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

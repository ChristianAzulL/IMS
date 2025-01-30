<?php 
// Unset the session variable if it exists
if (isset($_SESSION['outbound_id'])) {
    unset($_SESSION['outbound_id']);
}

// Get total count for pagination
$count_sql = "SELECT COUNT(*) as total FROM outbound_logs";
$count_res = $conn->query($count_sql);
$total_rows = $count_res->fetch_assoc()['total'];
$limit = 10; // Number of records per page
$total_pages = ceil($total_rows / $limit);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$outbound_sql = "SELECT ol.*, u.user_fname, u.user_lname, w.warehouse_name, ol.status
                 FROM outbound_logs ol
                 LEFT JOIN users u ON u.hashed_id = ol.user_id
                 LEFT JOIN warehouse w ON w.hashed_id = ol.warehouse
                 ORDER BY ol.id DESC
                 LIMIT $limit OFFSET $offset";
$outbound_res = $conn->query($outbound_sql);
?>

<div class="card">
  <div class="card-body overflow-hidden py-6 px-0">
    <div class="row justify-content-between gx-3 gy-0 px-3">
      <div class="col-auto mb-3">
        <button class="btn btn-primary py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Create</button>
        <button class="btn btn-warning py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#csv-modal"><span class="fas fa-file-csv"></span> Upload CSV</button>
      </div>
      <div class="col-sm-auto">
        <select class="form-select form-select-sm mb-3" id="warehouseFilter">
          <option selected value="">Select Warehouse</option>
          <?php echo implode("\n", $warehouse_options); ?>
        </select>
      </div>
      <div class="col-auto col-sm-5 mb-3">
        <input id="search" class="form-control form-control-sm shadow-none" type="search" placeholder="Search..." aria-label="search">
      </div>
    </div>

    <div class="table-responsive scrollbar">
      <table class="table table-sm table-striped fs-10 mb-0" id="sortableTable">
        <thead class="bg-200">
          <tr>
            <th class="text-900 sort" data-sort="outbound_no">Outbound no.</th>
            <th class="text-900 sort" data-sort="outbound_status">Fulfillment Status</th>
            <th class="text-900 sort" data-sort="warehouse">Warehouse</th>
            <th class="text-900 sort" data-sort="date">Date Received</th>
            <th class="text-900 sort" data-sort="receiver">Received by</th>
          </tr>
        </thead>
        <tbody id="table-body">
          <?php while ($row = $outbound_res->fetch_assoc()) { 
            $outbound_id = $row['hashed_id'];
            $outbound_warehouse = $row['warehouse_name'];
            $outbound_date = $row['date_sent'];
            $outbound_receiver = $row['customer_fullname'];
            if ($row['status'] == 0) {
              $outbound_status = '<span class="badge rounded-pill badge-subtle-success">Outbounded</span>';
            } elseif ($row['status'] == 1) {
              $outbound_status = '<span class="badge rounded-pill badge-subtle-success">Outbounded</span><span class="badge rounded-pill badge-subtle-danger">-1</span>';
            } else {
              $outbound_status = '<span class="badge rounded-pill badge-subtle-danger">Returned</span>';
            }
          ?>
          <tr>
            <td class="outbound_no">
              <a type="button" data-bs-toggle="modal" data-bs-target="#view-modal" target-id="<?php echo $outbound_id;?>">
                <?php echo $outbound_id; ?>
              </a>
            </td>
            <td class="outbound_status"><?php echo $outbound_status; ?></td>
            <td class="warehouse"><?php echo $outbound_warehouse; ?></td>
            <td class="date"><?php echo $outbound_date; ?></td>
            <td class="receiver"><?php echo $outbound_receiver; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination Section -->
    <nav>
      <ul class="pagination justify-content-center mt-3" id="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
          <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
            <a class="page-link" href="javascript:void(0);" onclick="changePage(<?php echo $i; ?>)"><?php echo $i; ?></a>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</div>

<!-- Modal for Viewing Content -->
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

<script>
// Live search functionality
document.getElementById("search").addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    document.querySelectorAll("#table-body tr").forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});

// Warehouse filter functionality
document.getElementById("warehouseFilter").addEventListener("change", function () {
    let filterValue = this.value.toLowerCase();
    document.querySelectorAll("#table-body tr").forEach(row => {
        row.style.display = row.querySelector(".warehouse").innerText.toLowerCase().includes(filterValue) ? "" : "none";
    });
});

// Pagination function
function changePage(page) {
    // Get the current filter values and search text
    let warehouseFilter = document.getElementById('warehouseFilter').value;
    let searchText = document.getElementById('search').value;

    // Send an AJAX request to fetch the data for the selected page
    let url = `outbound_logs.php?page=${page}&warehouse=${warehouseFilter}&search=${searchText}`;

    // Load the new content into the table and pagination
    fetch(url)
        .then(response => response.text())
        .then(data => {
            // Replace the table and pagination
            let tableBody = document.querySelector("#table-body");
            let pagination = document.querySelector("#pagination");
            let tableContent = data.split('<!-- table-body -->')[1].split('<!-- pagination -->')[0];
            let paginationContent = data.split('<!-- table-body -->')[1].split('<!-- pagination -->')[1];

            tableBody.innerHTML = tableContent;
            pagination.innerHTML = paginationContent;
        });
}

// Load content into modal on click
$("#sortableTable").on("click", "a[data-bs-toggle='modal']", function() {
    var targetId = $(this).attr("target-id"); // Get unique key
    $("#target-id").load("form-content.php?id=" + targetId); // Load content
});
</script>

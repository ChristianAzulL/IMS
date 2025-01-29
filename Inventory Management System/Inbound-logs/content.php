<?php
// Unset session variable
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

$inbound_sql = "SELECT il.*, u.user_fname, u.user_lname, w.warehouse_name, s.supplier_name 
                FROM inbound_logs il
                LEFT JOIN users u ON u.hashed_id = il.user_id
                LEFT JOIN warehouse w ON w.hashed_id = il.warehouse
                LEFT JOIN supplier s ON s.hashed_id = il.supplier
                ORDER BY il.id DESC 
                LIMIT $limit OFFSET $offset";
$inbound_res = $conn->query($inbound_sql);
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
                        <th class="text-900 sort" data-sort="inbound_no">Inbound no.</th>
                        <th class="text-900 sort" data-sort="po_no">P.O no.</th>
                        <th class="text-900 sort" data-sort="warehouse">Warehouse</th>
                        <th class="text-900 sort" data-sort="supplier">Supplier</th>
                        <th class="text-900 sort" data-sort="date">Date Received</th>
                        <th class="text-900 sort" data-sort="receiver">Received by</th>
                    </tr>
                </thead>
                <tbody id="table-body">
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
        <nav>
            <ul class="pagination justify-content-center mt-3">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>


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
                <?php echo implode("\n", $warehouse_options); ?>
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


<script>
// Sorting functionality
const getCellValue = (row, index) => row.cells[index].innerText;
const comparer = (idx, asc) => (a, b) => ((v1, v2) => v1 !== "" && v2 !== "" && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2))(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

document.querySelectorAll("th.sort").forEach(th => th.addEventListener("click", () => {
    const table = th.closest("table");
    Array.from(table.querySelectorAll("tbody tr"))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.querySelector("tbody").appendChild(tr));
}));

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

$(document).ready(function() {
    // Load content into modal on click
    $("#sortableTable").on("click", "a[data-bs-toggle='modal']", function() {
        var targetId = $(this).attr("target-id"); // Get unique key
        $("#target-id").load("form-content.php?id=" + targetId); // Load content
    });
});
</script>
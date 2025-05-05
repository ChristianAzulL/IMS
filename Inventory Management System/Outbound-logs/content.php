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
// Quote each ID in the array
$quoted_warehouse_ids = array_map(function ($id) {
  return "'" . trim($id) . "'";
}, $user_warehouse_ids);

// Create a comma-separated string of quoted IDs
$imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);
$outbound_sql = "SELECT ol.*, u.user_fname, u.user_lname, w.warehouse_name, ol.status, ol.order_line_id, ol.order_num
                 FROM outbound_logs ol
                 LEFT JOIN users u ON u.hashed_id = ol.user_id
                 LEFT JOIN warehouse w ON w.hashed_id = ol.warehouse
                 WHERE ol.warehouse IN ($imploded_warehouse_ids)
                 ORDER BY ol.id DESC";
$outbound_res = $conn->query($outbound_sql);
?>
<div class="card">
    <div class="card-body overflow-hidden py-6 px-0">
        <div class="row justify-content-between gx-3 gy-0 px-3">
        <div id="tableExample3" data-list='{"valueNames":["outbound_no","outbound_status","warehouse","date","receiver"],"page":5,"pagination":true}'>
  <div class="row justify-content-end g-0">
  <div class="col-sm-auto"><select class="form-select form-select-sm mb-3" data-list-filter="warehouse">
        <option selected="" value="">Select warehouse</option>
        <?php echo implode("\n", $warehouse_options); ?>
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
    <table class="table table-bordered table-striped fs-10 mb-0">
      <thead class="bg-200">
      <tr>
            <th class="text-900 sort" data-sort="outbound_no">Outbound no.</th>
            <th class="text-900 sort" data-sort="outbound_status">Fulfillment Status</th>
            <th class="text-900 sort text-end" data-sort="outbound_status">Order #</th>
            <th class="text-900 sort text-end" data-sort="outbound_status">Order Line ID</th>
            <th class="text-900 sort" data-sort="warehouse">Warehouse</th>
            <th class="text-900 sort" data-sort="date">Date Received</th>
            <th class="text-900 sort" data-sort="receiver">Client</th>
          </tr>
      </thead>
      <tbody class="list">
      <?php while ($row = $outbound_res->fetch_assoc()) { 
            $outbound_id = $row['hashed_id'];
            $outbound_warehouse = $row['warehouse_name'];
            $outbound_date = $row['date_sent'];
            $outbound_receiver = $row['customer_fullname'];
            $order_no = $row['order_num'];
            $order_line = $row['order_line_id'];
            if ($row['status'] == 0) {
              $outbound_status = '<span class="badge rounded-pill badge-subtle-success">Paid</span>';
            } elseif ($row['status'] == 1) {
              $outbound_status = '<span class="badge rounded-pill badge-subtle-success">Paid w/ return</span><span class="badge rounded-pill badge-subtle-danger">-1</span>';
            } elseif($row['status'] == 2) {
              $outbound_status = '<span class="badge rounded-pill badge-subtle-danger">Returned</span>';
            } elseif($row['status'] == 3){
              $outbound_status = '<span class="badge rounded-pill badge-subtle-danger">Void Requested</span>';
            } elseif($row['status'] == 4){
              $outbound_status = '<span class="badge rounded-pill badge-subtle-primary">Voided</span>';
            } elseif($row['status'] == 5) {
              $outbound_status = '<span class="badge rounded-pill badge-subtle-danger">Void Rejected</span>';
            } elseif($row['status'] == 6){
              $outbound_status = '<span class="badge rounded-pill badge-subtle-info">Outbounded</span>';
            }
          ?>
          <tr>
            <td class="outbound_no">
              <a type="button" data-bs-toggle="modal" data-bs-target="#view-modal" target-id="<?php echo $outbound_id;?>">
                <?php echo $outbound_id; ?>
              </a>
            </td>
            <td class="outbound_status"><?php echo $outbound_status; ?></td>
            <td class="outbound_status text-end"><?php echo $order_no; ?></td>
            <td class="outbound_status text-end"><?php echo $order_line; ?></td>
            <td class="warehouse"><?php echo $outbound_warehouse; ?></td>
            <td class="date"><?php echo $outbound_date; ?></td>
            <td class="receiver"><?php echo $outbound_receiver; ?></td>
          </tr>
          <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
    <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
  </div>
</div>
        </div>
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
// Load content into modal on click
$(document).on("click", "a[data-bs-toggle='modal']", function() {
    var targetId = $(this).attr("target-id"); // Get unique key
    $("#target-id").load("form-content.php?id=" + targetId); // Load content
});

$(document).on('submit', '.void-form', function(e) {
    e.preventDefault(); // Stop default submission
    const $form = $(this);
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to submit this form?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseText || 'Something went wrong.',
                        icon: 'error'
                    });
                }
            });
        }
    });
});


$(document).on('submit', '.void-decision', function(e) {
    e.preventDefault(); // Prevent default form submission
    const $decisionForm = $(this);

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to submit this form?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'Cancel'
    }).then((confirmation) => {
        if (confirmation.isConfirmed) {
            $.ajax({
                url: $decisionForm.attr('action'),
                type: $decisionForm.attr('method'),
                data: $decisionForm.serialize(),
                success: function(serverResponse) {
                    Swal.fire({
                        title: 'Success!',
                        text: serverResponse,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(errorResponse) {
                    Swal.fire({
                        title: 'Error!',
                        text: errorResponse.responseText || 'Something went wrong.',
                        icon: 'error'
                    });
                }
            });
        }
    });
});

$(document).on("click", ".paid_btn", function () {
    const outboundId = $(this).data("targetid");

    Swal.fire({
        title: 'Mark as Paid?',
        text: "Are you sure you want to mark this as paid?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, mark as paid'
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform AJAX call to PHP
            $.get("../config/paid_outbound.php", { name: outboundId })
                .done(function (data) {
                    Swal.fire('Success!', 'The record has been marked as paid.', 'success');
                    // Optional: disable button or update status visually
                    // $(this).prop("disabled", true);
                    window.location.href = window.location.href;
                })
                .fail(function () {
                    Swal.fire('Error!', 'There was a problem processing your request.', 'error');
                });
        }
    });
});
</script>

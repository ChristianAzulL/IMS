<div class="card">
    <div class="card-body overflow-hidden">
        <div class="row align-items-center">
            <div class="col-lg-12">
              <div id="tableExample3" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                <div class="row justify-content-end g-0">
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
                        <th class="text-900">#</th>
                        <th class="text-900 sort" data-sort="name">Supplier Name</th>
                        <th class="text-900 sort" data-sort="status">Fulfillment Status</th>
                        <th class="text-900 sort" data-sort="email">From Warehouse</th>
                        <th class="text-900 sort" data-sort="date">Date</th>
                        <th class="text-900 sort" data-sort="age">Staff</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php 
                        // Quote each ID in the array
                        $quoted_warehouse_ids = array_map(function ($id) {
                            return "'" . trim($id) . "'";
                        }, $user_warehouse_ids);
                
                        // Create a comma-separated string of quoted IDs
                        $imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);
                        $sql = "SELECT s.supplier_name, w.warehouse_name, r.date, u.user_fname, u.user_lname, r.id, r.status
                                FROM rts_logs r
                                LEFT JOIN supplier s ON s.hashed_id = r.supplier
                                LEFT JOIN warehouse w ON w.hashed_id = r.warehouse
                                LEFT JOIN users u ON u.hashed_id = r.user_id
                                WHERE r.warehouse IN ($imploded_warehouse_ids)
                                ORDER BY r.date DESC
                                ";
                        $rezult = $conn->query($sql);
                        if($rezult->num_rows>0){
                            $number = 0;
                            while($row=$rezult->fetch_assoc()){
                                $supplier_name = $row['supplier_name'];
                                $rts_from = $row['warehouse_name'];
                                $rts_date = $row['date'];
                                $rts_staff = $row['user_fname'] . " " . $row['user_lname'];
                                if($row['status'] == 0){
                                    $rts_status = '<span class="badge rounded-pill badge-subtle-warning">Pending</span>';
                                } elseif($row['status'] == 1){
                                    $rts_status = '<span class="badge rounded-pill badge-subtle-success">Replaced</span>';
                                } else {
                                    $rts_status = '<span class="badge rounded-pill badge-subtle-success">Refunded</span>';
                                }
                                $number ++;
                        ?>
                        <tr>
                        <td><a type="button" data-bs-toggle="modal" data-bs-target="#view-modal" target-id="<?php echo $row['id']; ?>"><?php echo $number;?></a></td>
                        <td class="name"><?php echo $supplier_name;?></td>
                        <td class="status"><?php echo $rts_status;?></td>
                        <td class="email"><?php echo $rts_from;?></td>
                        <td class="date"><?php echo $rts_date;?></td>
                        <td class="age"><?php echo $rts_staff;?></td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="7" class="p-6 text-center fs-1"><b>No Data yet!</b></td>
                        </tr>
                        <?php
                        }
                        ?>
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
</div>

<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Add a new illustration </h4>
        </div>
        <div id="preview"></div> this is where I want to load the content of preview.php?id=clicked target-id
        <!-- <div class="p-4 pb-0">
          <form>
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">Recipient:</label>
              <input class="form-control" id="recipient-name" type="text" />
            </div>
            <div class="mb-3">
              <label class="col-form-label" for="message-text">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div> -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="button">Understood </button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $('#view-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var targetId = button.attr('target-id'); 
        if (targetId) {
            $('#preview').html('<p>Loading...</p>'); 
            $.ajax({
                url: 'preview.php',
                type: 'GET',
                data: { id: targetId },
                success: function(response) {
                    $('#preview').html(response);
                },
                error: function() {
                    $('#preview').html('<p class="text-danger">Error loading content.</p>');
                }
            });
        }
    });
});
</script>
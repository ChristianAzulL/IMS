<div class="card">
    <div class="card-body overflow-hidden">
        <div class="row">
            <div class="col-12 mb-4">
                <h2><b>Return Logs</b></h2>
            </div>
        </div>
        <div id="tableExample3" data-list='{"valueNames":["description","brand","category","amount","barcode","orn","warehouse","staff"],"page":5,"pagination":true}'>
            
            <!-- Search Bar -->
            <div class="row justify-content-end g-0">
                <div class="col-sm-auto mb-3 me-2">
                    <select class="form-select form-select-sm mb-3" data-list-filter="brand">
                        <option selected="" value="">Select brand</option>
                        <?php 
                        $brand_sql = "SELECT brand_name FROM brand ORDER BY brand_name ASC";
                        $brand_res = $conn->query($brand_sql);
                        if($brand_res->num_rows>0){
                            while($row=$brand_res->fetch_assoc()){
                                echo '<option value="'.$row['brand_name'].'">'.$row['brand_name'].'</option>';
                            }
                        } else {
                            echo '<option value="">Please add data</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-auto mb-3 me-2">
                    <select class="form-select form-select-sm mb-3" data-list-filter="category">
                        <option selected="" value="">Select category</option>
                        <?php 
                        $category_sql = "SELECT category_name FROM category ORDER BY category_name ASC";
                        $category_res = $conn->query($category_sql);
                        if($category_res->num_rows>0){
                            while($row=$category_res->fetch_assoc()){
                                echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
                            }
                        } else {
                            echo '<option value="">Please add data</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-auto mb-3 me-2">
                    <select class="form-select form-select-sm mb-3" data-list-filter="warehouse">
                        <option selected="" value="">Select warehouse</option>
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
            
            <!-- Table -->
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-900 sort">#</th>
                            <th class="text-900 sort" data-sort="description">Description</th>
                            <th class="text-900 sort" data-sort="brand">Brand</th>
                            <th class="text-900 sort text-end" data-sort="category">Category</th>
                            <th class="text-900 sort text-end" data-sort="amount">Amount Refunded</th>
                            <th class="text-900 sort text-end" data-sort="barcode">Barcode</th>
                            <th class="text-900 sort" data-sort="orn" style="width: 200px;">Outbound Reference no.</th>
                            <th class="text-900 sort" data-sort="date" style="width: 200px;">Return Date</th>
                            <th class="text-900 sort" data-sort="warehouse">Warehouse</th>
                            <th class="text-900 sort" data-sort="staff" style="width: 250px;">Staff</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php 
                        $number = 1;
                        // Quote each ID in the array
                        $quoted_warehouse_ids = array_map(function ($id) {
                            return "'" . trim($id) . "'";
                        }, $user_warehouse_ids);
                
                        // Create a comma-separated string of quoted IDs
                        $imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);
                        $sql = "SELECT 
                                        r.unique_barcode,
                                        r.amount,
                                        r.date,
                                        r.id AS return_id,
                                        s.outbound_id,
                                        p.description,
                                        b.brand_name,
                                        c.category_name,
                                        w.warehouse_name,
                                        u.user_fname,
                                        u.user_lname,
                                        u.pfp
                                    FROM `returns` r 
                                    LEFT JOIN stocks s ON s.unique_barcode = r.unique_barcode
                                    LEFT JOIN product p ON p.hashed_id = s.product_id
                                    LEFT JOIN brand b ON b.hashed_id = p.brand
                                    LEFT JOIN category c ON c.hashed_id = p.category
                                    LEFT JOIN users u ON u.hashed_id = r.user_id
                                    LEFT JOIN warehouse w ON w.hashed_id = r.warehouse
                                    WHERE r.warehouse IN ($imploded_warehouse_ids)
                                    ORDER BY r.id DESC";
                        $result = $conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                                $return_id = $row['return_id'];
                                $barcode = $row['unique_barcode'];
                                $amount = $row['amount'];
                                $rdate = $row['date'];
                                $outbound_id = $row['outbound_id'];
                                $description = $row['description'];
                                $brand = $row['brand_name'];
                                $category = $row['category_name'];
                                $rwarehouse = $row['warehouse_name'];
                                $author = $row['user_fname'] . " " . $row['user_lname'];
                                if(empty($row['pfp'])){
                                    $author_pfp = "../../assets/img/def_pfp.png" ;
                                } else {
                                    $author_pfp = "../../assets/" . $row['pfp'] ;
                                }
                                
                        ?>
                        <tr>
                            <td class="text-end"><a href="#" target-id="<?php echo $return_id;?>" type="button" data-bs-toggle="modal" data-bs-target="#view-modal"><?php echo $number;?></a></td>
                            <td class="description"><?php echo $description;?></td>
                            <td class="brand"><?php echo $brand;?></td>
                            <td class="category"><?php echo $category;?></td>
                            <td class="amount text-end"><?php echo $amount;?></td>
                            <td class="barcode text-end"><?php echo $barcode;?></td>
                            <td class="orn"><span class="badge rounded-pill bg-primary"><?php echo $outbound_id;?></span></td>
                            <td class="date"><?php echo $rdate;?></td>
                            <td class="warehouse"><?php echo $rwarehouse;?></td>
                            <td class="staff"><img class="img rounded-circle" src="<?php echo $author_pfp;?>" height="30" alt=""> <?php echo $author;?></td>
                        </tr>
                        
                        <?php
                        $number ++; 
                            }
                        } else {
                        ?>
                        <tr>
                            <td class="py-6 text-center fs-3" colspan="9"><b>No Data</b></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev">
                    <span class="fas fa-chevron-left"></span>
                </button>
                <ul class="pagination mb-0"></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next">
                    <span class="fas fa-chevron-right"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Proofs </h4>
        </div>
        <div class="p-4 pb-0">
          <div id="preview-proof"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="button">Understood </button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    // Delegate click event for dynamic elements
    $(document).on('click', 'a[target-id]', function(e) {
        e.preventDefault(); // prevent default anchor behavior
        const targetId = $(this).attr('target-id');

        // Show loading state (optional)
        $('#preview-proof').html('<div class="text-center py-3">Loading...</div>');

        // Load content into the modal
        loadPreview(targetId); // Load content dynamically
    });

    // Function to load preview content dynamically
    function loadPreview(targetId) {
    $.ajax({
        url: 'preview.php',
        type: 'GET',
        data: { id: targetId },
        success: function(response) {
        $('#preview-proof').html(response);
        initSwiper(); // ✅ Re-initialize Swiper after new content is loaded
        },
        error: function() {
        $('#preview-proof').html('<p class="text-danger">Error loading content.</p>');
        }
    });
    }
});

// Make sure Swiper is initialized with Zoom
let swiperInstance;

function initSwiper() {
  if (swiperInstance) {
    swiperInstance.destroy(true, true); // Clean up
  }

  swiperInstance = new Swiper('.theme-slider', {
    spaceBetween: 5,
    loop: true,
    zoom: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
}

</script>

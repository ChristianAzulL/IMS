<?php 

if(!isset($_SESSION['warehouse_for_transfer'])){
?>
    <button class="btn btn-primary d-none" id="tobetriggered" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Launch demo modal</button>
    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <form action="local_config.php" method="POST">
                    <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                        <!-- Remove the close button to further prevent user from closing the modal -->
                        <!-- <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body p-0">
                        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                            <h4 class="mb-1" id="modalExampleDemoLabel">Select Warehouse</h4>
                        </div>
                        <div class="p-4 pb-0">
                            <select class="form-select" id="warehouse" required="required" name="warehouse" required>
                                <option value="">Select warehouse...</option>
                                <?php echo implode("\n", $warehouse_options); ?>
                                <?php ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" disabled>Close</button>
                        <button class="btn btn-primary" type="submit">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Trigger the hidden button programmatically
            document.getElementById("tobetriggered").click();
        });
    </script>
<?php
} else {
    $warehouse_for_transfer = $_SESSION['warehouse_for_transfer'];

    $warehouse_sql = "SELECT hashed_id FROM warehouse WHERE warehouse_name = '$warehouse_for_transfer' LIMIT 1";
    $res = $conn->query($warehouse_sql);
    if($res->num_rows>0){
        $row = $res->fetch_assoc();
        $warehouse_for_transfer = $row['hashed_id'];
    }
?>

<div class="card" data-list='{"valueNames":["desc","barcode","brand","cat","qty","trans"]}'>
    <div class="card-body overflow-hidden py-6 px-2">
      <h5>SELECT PRODUCTS TO BE TRANSFERED</h5>
      <div class="row d-flex align-items-center justify-content-end my-3">
        <div class="col-auto text-end">
            <a href="local_config.php?change_warehouse=true" class="btn btn-warning">Change Warehouse</a>
        </div>
        <div class="col-auto col-sm-5">
        <form>
            <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
            <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
            </div>
        </form>
        </div>
      </div>
    <div class="card shadow-none">
  <div class="card-body p-0 pb-3">
    <div class="d-flex align-items-center justify-content-end my-3">
      <div id="bulk-select-replace-element"><button class="btn btn-falcon-success btn-sm" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">New</span></button></div>
      <div class="d-none ms-3" id="bulk-select-actions">
        <div class="d-flex">
          <form action="../Supplier-selection/index.php" method="POST">
            <pre id="selectedRows" hidden></pre>
            <button class="btn btn-falcon-danger btn-sm ms-2" type="submit">Next</button>
          </form>
          
          <!-- <a href="../Supplier-selection/" class="btn btn-falcon-danger btn-sm ms-2">Apply</a> -->
        </div>
        
      </div>
      
    </div>
    <div class="table-responsive scrollbar">
      <table class="table mb-0">
        <thead class="bg-200">
          <tr>
            <th class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" id="bulk-select-example" type="checkbox" data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' /></div>
            </th>
            <th width="50"></th>
            <th class="text-black dark__text-white align-middle sort" data-sort="desc">Description</th>
            <th class="text-black dark__text-white align-middle sort" data-sort="batch_code">Batch Code</th>
            <th class="text-black dark__text-white align-middle sort" data-sort="desc">Parent Barcode</th>
            <th class="text-black dark__text-white align-middle sort" data-sort="barcode">Brand </th>
            <th class="text-black dark__text-white align-middle sort" data-sort="cat">Category</th>
          </tr>
        </thead>
        <tbody id="bulk-select-body" class="list">
          <?php 
          $product_list_query = "
            SELECT stocks.*, product.description, product.product_img,category.category_name, brand.brand_name
            FROM stocks
            LEFT JOIN product ON product.hashed_id = stocks.product_id 
            LEFT JOIN category ON category.hashed_id = product.category
            LEFT JOIN brand ON brand.hashed_id = product.brand
            WHERE stocks.warehouse = '$warehouse_for_transfer' AND stocks.item_status = 0
            ORDER BY stocks.batch_code DESC
          ";
          $product_list_res = $conn->query($product_list_query);
          if($product_list_res->num_rows > 0) {
            while($row = $product_list_res->fetch_assoc()) {
              $product_id = $row['id'];
              $product_img = $row['product_img'];
              $product_category = $row['category_name'];
              $product_brand = $row['brand_name'];
              $product_des = $row['description'];
              $product_pbarcode = $row['unique_barcode'];
              $product_date = $row['date'];
              $batch_code = $row['batch_code'];
              

              

          ?>
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="form-check mb-0">
                <input class="form-check-input" type="checkbox" id="checkbox-1" data-bulk-select-row="{<input type='checkbox' name='unique_barcode[]' value='<?php echo $product_pbarcode; ?>' checked=''>}" />
              </div>
            </td>
            <td>
              <img class="img img-fluid m-0" src="../../assets/img/<?php echo basename($product_img); ?>" alt="" >
            </td>
            <th class="align-middle desc"><?php echo $product_des; ?></th>
            <td class="align-middle batch_code"><?php echo $batch_code;?></td>
            <th class="align-middle barcode"><?php echo $product_pbarcode; ?></th>
            <td class="align-middle brand"><?php echo $product_brand; ?></td>
            <td class="align-middle cat"><?php echo $product_category; ?></td>
          </tr>
          <?php 
            }
          } else {
          ?>
            <tr>
              <td colspan="8" class="py-6 px-6 text-center cat brand"><h2>No Data</h2></td>
            </tr>
          <?php
          }
          ?>

        </tbody>
      </table>
      <!-- <p class="mt-3 mb-2">Click the button to get selected rows</p> -->
      <button id="btn_to_trigger" class="btn btn-warning" data-selected-rows="data-selected-rows" hidden>Get Selected Rows</button>
      <!-- <pre id="selectedRows"></pre> -->
    </div>
  </div>
</div>
    </div>
</div>

<script>
      document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const btnToTrigger = document.getElementById('btn_to_trigger');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    btnToTrigger.click();
                }
            });
        });

        // Trigger button click every 1 second
        setInterval(function() {
            btnToTrigger.click();
        }, 1000);
    });
</script>
<?php
}
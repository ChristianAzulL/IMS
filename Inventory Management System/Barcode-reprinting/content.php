<div class="card">
    <div class="card-body overflow-hidden py-6 px-2">
      <h5>SELECT PRODUCTS FOR BARCODE REPRINTING</h5>
    <div class="card shadow-none">
  <div id="tableExample" class="card-body p-0 pb-3"  data-list='{"valueNames":["desc","barcode","unique","brand","cat","qty","trans"],"page":5,"pagination":true}'>
  <div class="row justify-content-end g-0">
    <div class="col-auto col-sm-5 mb-3">
      <form>
        <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
          <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
        </div>
      </form>
    </div>
  </div>
    <div class="d-flex align-items-center justify-content-end my-3">
      <div id="bulk-select-replace-element"><button class="btn btn-falcon-success btn-sm" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">New</span></button></div>
      <div class="d-none ms-3" id="bulk-select-actions">
        <div class="d-flex">
          <form action="../Barcode-reprint-2/index.php" method="POST">
            <pre id="selectedRows" hidden></pre>
            <button class="btn btn-falcon-danger btn-sm ms-2" type="submit">Next</button>
          </form>
          <!-- <a href="../Supplier-selection/" class="btn btn-falcon-danger btn-sm ms-2">Apply</a> -->
        </div>
      </div>
    </div>
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped fs-10 mb-0">
        <thead class="bg-200">
          <tr>
            <th class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" id="bulk-select-example" type="checkbox" data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' /></div>
            </th>
            <th width="50"></th>
            <th class="text-black dark__text-white align-middle sort" data-sort="desc">Description</th>
            <th class="text-black dark__text-white align-middle sort" data-sort="barcode">Parent Barcode</th>
            <th class="text-black dark__text-white align-middle sort" data-sort="unique">Unique Barcode</th>
            <th class="text-black dark__text-white align-middle sort" data-sort="brand">Brand </th>
            <th class="text-black dark__text-white align-middle sort" data-sort="cat">Category</th>
          </tr>
        </thead>
        <tbody id="bulk-select-body" class="list">
          <?php 
          $product_list_query = "
            SELECT stocks.*, product.description, category.category_name, brand.brand_name
            FROM stocks
            LEFT JOIN product ON product.hashed_id = stocks.product_id
            LEFT JOIN category ON category.hashed_id = product.category
            LEFT JOIN brand ON brand.hashed_id = product.brand
            ORDER BY product.id DESC
          ";
          $product_list_res = $conn->query($product_list_query);
          if($product_list_res->num_rows > 0) {
            while($row = $product_list_res->fetch_assoc()) {
              $product_id = $row['hashed_id'];
              $product_img = $row['product_img'] ?? 'def_img.png';
              $product_category = $row['category_name'];
              $product_brand = $row['brand_name'];
              $product_des = $row['description'];
              $product_pbarcode = $row['parent_barcode'];
              $product_unique_barcode = $row['unique_barcode'];
              $product_date = $row['date'];
              
    



              

          ?>
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="form-check mb-0">
                <input class="form-check-input" type="checkbox" id="checkbox-1" data-bulk-select-row="{<input type='checkbox' name='product_id[]' value='<?php echo $product_id; ?>' checked=''><input type='checkbox' name='product_image[]' value='<?php echo basename($product_img)?>' checked=''><input type='checkbox' name='product_desc[]' value='<?php echo $product_des;?>' checked=''><input type='checkbox' name='parent_barcode[]' value='<?php echo $product_unique_barcode; ?>' checked=''><input type='checkbox' name='brand[]' value='<?php echo $product_brand; ?>' checked=''><input type='checkbox' name='category[]' value='<?php echo $product_category; ?>' checked=''><input type='checkbox' name='qty[]' value='<?php echo $current_stock; ?>' checked=''><input type='checkbox' name='trans_day[]' value='<?php echo $avg_daily; ?>' checked=''><input type='checkbox' name='trans_month[]' value='<?php echo $avg_monthly; ?>' checked=''><input type='checkbox' name='trans_year[]' value='<?php echo $avg_yearly;?>' checked=''>}" />
              </div>
            </td>
            <td>
              <img class="img img-fluid m-0" src="../../assets/img/<?php echo basename($product_img); ?>" alt="" >
            </td>
            <th class="align-middle desc"><?php echo $product_des; ?></th>
            <th class="align-middle barcode"><?php echo $product_pbarcode; ?></th>
            <th class="align-middle unique"><?php echo $product_unique_barcode;?></th>
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
    <div class="row align-items-center mt-3">
    <div class="pagination d-none"></div>
    <div class="col">
      <p class="mb-0 fs-10">
        <span class="d-none d-sm-inline-block" data-list-info="data-list-info"></span>
        <span class="d-none d-sm-inline-block"> &mdash;</span>
        <a class="fw-semi-bold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </p>
    </div>
    <div class="col-auto d-flex"><button class="btn btn-sm btn-primary" type="button" data-list-pagination="prev"><span>Previous</span></button><button class="btn btn-sm btn-primary px-4 ms-2" type="button" data-list-pagination="next"><span>Next</span></button></div>
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
<div class="row" id="tableExample4" data-list='{"valueNames":["desc","cat","brand","barcode","by", "date"]}'>
  <div class="col-lg-12">
    <h4>Reprint Barcode</h4>
  </div>

  <div class="col-lg-12 text-end px-3">
    <button class="btn btn-primary py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#create-modal">Create</button>
  </div>

  <!-- Filters Section -->
  <div class="col-lg-12 py-3">
    <div class="row justify-content-end gx-3 gy-0 px-3">
      <div class="col-sm-auto">
        <select class="form-select form-select-sm mb-3" data-list-filter="cat">
          <option selected="No Data" value="">Select category</option>
          <?php 
            $category_selection = "SELECT * FROM category ORDER BY category_name ASC";
            $category_result = $conn->query($category_selection);
            if ($category_result->num_rows > 0) {
              while ($row = $category_result->fetch_assoc()) {
                echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
              }
            } else {
              echo '<option value="">No category found</option>';
            }
          ?>
        </select>
      </div>

      <div class="col-sm-auto">
        <select class="form-select form-select-sm mb-3" data-list-filter="brand">
          <option selected="No Data" value="">Select brand</option>
          <?php 
            $brand_selection = "SELECT * FROM brand ORDER BY brand_name ASC";
            $brand_result = $conn->query($brand_selection);
            if ($brand_result->num_rows > 0) {
              while ($row = $brand_result->fetch_assoc()) {
                echo '<option value="' . $row['brand_name'] . '">' . $row['brand_name'] . '</option>';
              }
            } else {
              echo '<option value="">No brand found</option>';
            }
          ?>
        </select>
      </div>

      <div class="col-auto col-sm-5 mb-3">
        <form>
          <div class="input-group">
            <input class="form-control form-control-sm shadow-none search" id="seach-item" type="search" placeholder="Search..." aria-label="search" />
            <div class="input-group-text bg-transparent">
              <span class="fa fa-search fs-10 text-600"></span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Product List Table -->
  <div class="col-lg-12" id="initially-hidden" style="display: none;">
    <div class="card">
      <div class="card-body overflow-hidden">
        <div class="table-responsive">
          <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
            <thead class="bg-200">
              <tr>
                <th style="width: 10px;"></th>
                <th data-sort="desc"><small>Description</small></th>
                <th data-sort="cat"><small>Category</small></th>
                <th data-sort="brand"><small>Brand</small></th>
                <th data-sort="barcode"><small>Parent Barcode</small></th>
                <th data-sort="date"><small>Batch</small></th>
              </tr>
            </thead>
            <tbody class="list" id="table-purchase-body">
              <?php 
                $product_list_query = "
                  SELECT stocks.*, product.description, product.parent_barcode, category.category_name, brand.brand_name
                  FROM stocks
                  LEFT JOIN product ON product.hashed_id = stocks.product_id 
                  LEFT JOIN category ON category.hashed_id = product.category
                  LEFT JOIN brand ON brand.hashed_id = product.brand
                  ORDER BY product.id DESC
                ";
                $product_list_res = $conn->query($product_list_query);
                if ($product_list_res->num_rows > 0) {
                  while ($row = $product_list_res->fetch_assoc()) {
                    $product_id = $row['id'];
                    $product_category = $row['category_name'];
                    $product_brand = $row['brand_name'];
                    $product_des = $row['description'];
                    $product_pbarcode = $row['unique_barcode'];
                    $product_date = $row['batch_code'];
                    $product_img = empty($row['product_img']) ? "def_img.png" : $row['product_img'];
              ?>
                    <tr>
                      <td class="p-0 m-0" style="height:10px;">
                        <img class="img img-fluid m-0" src="../../assets/img/<?php echo $product_img; ?>" alt="" height="10">
                      </td>
                      <td class="desc"><small><a href="../config/download-barcode-pdf.php?barcode=<?php echo $product_pbarcode;?>"><span class="fas fa-file-download"></span> <?php echo $product_des; ?></a></small></td>
                      <td class="cat"><small><?php echo $product_category; ?></small></td>
                      <td class="brand"><small><?php echo $product_brand; ?></small></td>
                      <td class="barcode"><small><?php echo $product_pbarcode; ?></small></td>
                      <td class="date"><small><?php echo $product_date; ?></small></td>
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
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <form action="../config/add-product.php" method="POST" enctype="multipart/form-data">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content position-relative">
        <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
          <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3">
          <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
            <h4 class="mb-1" id="modalExampleDemoLabel">Add a new product</h4>
          </div>
          <div class="row bg-body-tertiary">
            <div class="col-lg-7 mb-3">
              <label for="product_description">Product Description</label>
              <input type="text" class="form-control" name="product_description" id="product_description">
            </div>
            <div class="col-lg-5 mb-3">
              <label for="product_image">Upload Product Image</label>
              <input type="file" class="form-control" name="product_image" id="product_image">
            </div>
            <div class="col-lg-4 mb-3">
              <label for="category">Category</label>
              <select class="form-select" name="category" id="category">
                <option value="">Select Category</option>
                <?php 
                  $category_selection = "SELECT * FROM category ORDER BY category_name ASC";
                  $category_result = $conn->query($category_selection);
                  if ($category_result->num_rows > 0) {
                    while ($row = $category_result->fetch_assoc()) {
                      echo '<option value="' . $row['hashed_id'] . '">' . $row['category_name'] . '</option>';
                    }
                  } else {
                    echo '<option value="">No category found</option>';
                  }
                ?>
              </select>
            </div>
            <div class="col-lg-4 mb-3">
              <label for="brand">Brand</label>
              <select class="form-select" name="brand" id="brand">
                <?php 
                  $brand_selection = "SELECT * FROM brand ORDER BY brand_name ASC";
                  $brand_result = $conn->query($brand_selection);
                  if ($brand_result->num_rows > 0) {
                    while ($row = $brand_result->fetch_assoc()) {
                      echo '<option value="' . $row['hashed_id'] . '">' . $row['brand_name'] . '</option>';
                    }
                  } else {
                    echo '<option value="">No brand found</option>';
                  }
                ?>
              </select>
            </div>
            <div class="col-lg-4 mb-3">
              <label for="parent_barcode">Parent Barcode</label>
              <input type="text" class="form-control" name="parent_barcode" id="parent_barcode" placeholder="Enter barcode">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Submit</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- JavaScript -->
<script>
  $(document).ready(function() {
    // Initially hide the div
    $('#initially-hidden').hide();

    // Event listener for input field
    $('#seach-item').on('input', function() {
      var searchTerm = $(this).val();

      // Show or hide based on search term length
      if (searchTerm.length > 2) {
        $('#initially-hidden').show(); // Show the div
      } else {
        $('#initially-hidden').hide(); // Hide the div
      }
    });
  });
</script>

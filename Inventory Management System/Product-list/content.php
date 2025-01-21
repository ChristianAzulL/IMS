<div class="row" id="tableExample4" data-list='{"valueNames":["desc","cat","brand","barcode","by", "date"]}'>
  <div class="col-lg-12">
    <h4>Product list</h4>
  </div>

  <div class="col-lg-12 text-end px-3">
    <button class="btn btn-primary py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#create-modal">Create</button>
  </div>

  <div class="col-lg-12 py-3">
    <div class="row justify-content-end gx-3 gy-0 px-3">
      <div class="col-sm-auto">
        <select class="form-select form-select-sm mb-3" data-list-filter="cat">
          <option selected="No Data" value="">Select category</option>
          <?php 
          $category_selection = "SELECT * FROM category ORDER BY category_name ASC";
          $category_result = $conn->query($category_selection);
          if($category_result->num_rows > 0) {
            while($row = $category_result->fetch_assoc()) {
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
          if($brand_result->num_rows > 0) {
            while($row = $brand_result->fetch_assoc()) {
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
            <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
            <div class="input-group-text bg-transparent">
              <span class="fa fa-search fs-10 text-600"></span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-12">
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
                <th data-sort="by"><small>Created by</small></th>
                <th data-sort="date"><small>Date</small></th>
                <th style="width:30px;"></th>
              </tr>
            </thead>

            <tbody class="list" id="table-purchase-body">
              <?php 
              $product_list_query = "
                SELECT product.*, users.user_fname, users.user_lname, category.category_name, brand.brand_name
                FROM product 
                LEFT JOIN users ON users.hashed_id = product.user_id 
                LEFT JOIN category ON category.hashed_id = product.category
                LEFT JOIN brand ON brand.hashed_id = product.brand
                ORDER BY product.id DESC
              ";
              $product_list_res = $conn->query($product_list_query);
              if($product_list_res->num_rows > 0) {
                while($row = $product_list_res->fetch_assoc()) {
                  $product_id = $row['id'];
                  if(empty($row['product_img']) || !isset($row['product_img'])){
                    $product_img = 'def_img.png';
                  } else {
                    $product_img = $row['product_img'];
                  }
                  
                  $product_category = $row['category_name'];
                  $product_brand = $row['brand_name'];
                  $product_des = $row['description'];
                  $product_pbarcode = $row['parent_barcode'];
                  $product_date = $row['date'];
                  $product_publisher = $row['user_fname'] . " " . $row['user_lname'];
              ?>
                <tr>
                  <td class="p-0 m-0" style="height:10px;">
                    <img class="img img-fluid m-0" src="../../assets/img/<?php echo $product_img; ?>" alt="" height="10">
                  </td>
                  <td class="desc"><small><?php echo $product_des; ?></small></td>
                  <td class="cat"><small><?php echo $product_category; ?></small></td>
                  <td class="brand"><small><?php echo $product_brand; ?></small></td>
                  <td class="barcode"><small><?php echo $product_pbarcode; ?></small></td>
                  <td class="by"><small><?php echo $product_publisher; ?></small></td>
                  <td class="date"><small><?php echo $product_date; ?></small></td>
                  <td>
                    <button class="btn btn-transparent py-0" type="button" target-id="<?php echo $product_id;?>" data-bs-toggle="modal" data-bs-target="#edit-modal" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information">
                      <span class="far fa-edit m-0 p-0"></span>
                    </button>
                  </td>
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
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-3">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Add a new product</h4>
        </div>
        <div class="row bg-body-tertiary">
          <div class="col-lg-7 mb-3">
            <label for="">Product Description</label>
            <input type="text" class="form-control" name="product_description">
          </div>
          <div class="col-lg-5 mb-3">
            <label for="">Upload Product Image</label>
            <input type="file" class="form-control" name="product_image" id="">
          </div>
          <div class="col-lg-4 mb-3">
            <label for="">Category</label>
            <select class="form-select" name="category" id="">
              <option value="">Select Category</option>
              <?php 
              $category_selection = "SELECT * FROM category ORDER BY category_name ASC";
              $category_result = $conn->query($category_selection);
              if($category_result->num_rows > 0) {
                while($row = $category_result->fetch_assoc()) {
                  echo '<option value="' . $row['hashed_id'] . '">' . $row['category_name'] . '</option>';
                }
              } else {
                echo '<option value="">No category found</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-lg-4 mb-3">
            <label for="">Brand</label>
            <select class="form-select" name="brand" id="">
              <?php 
              $brand_selection = "SELECT * FROM brand ORDER BY brand_name ASC";
              $brand_result = $conn->query($brand_selection);
              if($brand_result->num_rows > 0) {
                while($row = $brand_result->fetch_assoc()) {
                  echo '<option value="' . $row['hashed_id'] . '">' . $row['brand_name'] . '</option>';
                }
              } else {
                echo '<option value="">No brand found</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-lg-4 mb-3">
            <label for="">Parent Barcode</label>
            <input type="text" class="form-control" name="parent_barcode" placeholder="enter barcode">
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


<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
    <form action="../config/edit-product.php" method="POST">
      <div class="modal-content position-relative">
        <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
          <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <div id="edit-content"></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Submit </button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).on('click', 'button[data-bs-target="#edit-modal"]', function () {
    const targetId = $(this).attr('target-id');
    const editContentDiv = $('#edit-content');
    
    editContentDiv.html('<p>Loading...</p>');

    $.get(`edit-content.php?product_id=${targetId}`, function (data) {
      editContentDiv.html(data);
    }).fail(function () {
      editContentDiv.html('<p>Error loading content.</p>');
    });
  });
</script>
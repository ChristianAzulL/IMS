<?php 
  if(strpos($access, "stock")!==false || $user_position_name === "Administrator"){
  ?>
  <!-- All Products Section -->
  <div class="col-lg-12">
    <div class="card mb-3">
      <!-- Card Header -->
      <div class="card-header position-relative">
          <div class="row">
              <div class="col-4">
                  <h5 class="mb-0 mt-1">All Products</h5>
              </div>
              <div class="col-8 text-end">
                  <div>
                      Total Products: <span id="totalItems">0</span>
                      | Matched Products: <span id="matchedItems">0</span>
                  </div>
              </div>
          </div>
      </div>
      <!-- Search and Filter Section -->
      <div class="card-body pt-0 pt-md-3">
      <div class="row g-3 align-items-center">
          <!-- Filter Button for Smaller Screens -->
          <div class="col-auto d-xl-none">
          <button class="btn btn-sm p-0 btn-link position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
              <span class="fas fa-filter fs-9 text-700"></span>
          </button>
          </div>
          <!-- Search Bar -->
          <div class="col">
          <form class="position-relative">
              <input class="form-control form-control-sm search-input lh-1 rounded-2 ps-4" id="searchInput" type="search" placeholder="Search..." aria-label="Search" />
              <div class="position-absolute top-50 start-0 translate-middle-y ms-2">
              <span class="fas fa-search text-400 fs-10"></span>
              </div>
          </form>
          </div>
          <!-- Sorting and View Options -->
          <div class="col position-sm-relative position-absolute top-0 end-0 me-3 me-sm-0 p-0">
          <div class="row g-0 g-md-3 justify-content-end">
              <!-- Sort By Dropdown -->
              <div class="col-auto row gx-2">
              <form class="row gx-2">
                  <div class="col-auto d-none d-lg-block"><small class="fw-semi-bold">warehouse:</small></div>
                  <div class="col-auto">
                  <!-- Warehouse Select -->
                      <select name="warehouse" id="warehouse" class="form-select form-select-sm">
                          <!-- <option value="">All Warehouses</option> -->
                          <?php 
                          foreach ($user_warehouse_ids as $id) {
                              $id = trim($id);
                              $warehouse_info_query = "SELECT * FROM warehouse WHERE hashed_id = '$id'";
                              $warehouse_info_result = mysqli_query($conn, $warehouse_info_query);
                              if ($warehouse_info_result->num_rows > 0) {
                                  $row = $warehouse_info_result->fetch_assoc();
                                  $tab_warehouse_name = $row['warehouse_name'];
                                  echo '<option value="' . $id . '">' . $tab_warehouse_name . '</option>';
                              }
                          }
                          ?>
                      </select>
                  </div>
              </form>
              </div>
          </div>
          </div>
      </div>
      </div>
  </div>
  <div id="listBody">
  
  </div>
  <!-- Pagination Section -->
  <div class="card">
      <div class="card-body">
      <div class="row g-3 flex-center justify-content-md-between">
          <!-- Items Per Page Dropdown -->
          <div class="col-auto">
          <form class="row gx-2" hidden>
              <div class="col-auto"><small>Show:</small></div>
              <div class="col-auto">
              <select class="form-select form-select-sm" aria-label="Show courses">
                  <option selected="selected" value="9">9</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
              </select>
              </div>
          </form>
          </div>
          <!-- Pagination Controls -->
          <div class="col-auto" id="pagination">
          
          </div>
      </div>
      </div>
  </div>
  </div>
</div>
  </div>

  

  <script>

    $(document).ready(function() {
        let targetId, offset = 0;

        $(document).on("click", "[data-bs-toggle='modal']", function() {
            targetId = $(this).attr("target-id");
            offset = 0; // Reset offset on modal open
            let modalContent = $("#modal-1-display");

            modalContent.html(`
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Unique Barcode</th>
                                <th>Status</th>
                                <th>Capital</th>
                                <th>Sold Amount</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>
                    </table>
                </div>
                <div class="text-center my-3">
                    <button id="load-more-btn" class="btn btn-primary d-none">Go to Inventory page to load more</button>
                </div>
            `);

            loadMoreData(); // Load initial data

            $("#load-more-btn").click(function() {
                loadMoreData();
            });
        });

        function loadMoreData() {
            $("#load-more-btn").prop("disabled", true).text("Loading...");
            
            $.ajax({
                url: "modal-display-1.php",
                type: "GET",
                data: { target_id: targetId, offset: offset },
                dataType: "json",
                success: function(response) {
                    $("#table-body").append(response.html);
                    offset += 100;

                    if (response.has_more) {
                        $("#load-more-btn").removeClass("d-none").prop("disabled", false).text("Go to Inventory Page to load more");
                    } else {
                        $("#load-more-btn").addClass("d-none");
                    }
                },
                error: function() {
                    $("#load-more-btn").text("Error! Try Again").prop("disabled", false);
                }
            });
        }
    });


let currentPage = 1;
let limit = 9;



// Function to format date to 'Month Day, Year' (e.g., January 1, 2022)
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', options);
}

function loadData() {
    const search = $('#searchInput').val();
    const warehouse = $('#warehouse').val(); // Get selected warehouse
    const offset = (currentPage - 1) * limit;

    $.getJSON('../config/getStockListData.php', { limit, offset, search, warehouse }, function (response) {
        if (response.error) {
            console.error(response.error);
            return;
        }

        const listBody = $('#listBody');
        listBody.empty();

        if (response.data.length === 0) {
            listBody.append('<div class="text-center py-5">No results found.</div>');
        } else {
            response.data.forEach((item) => {
                listBody.append(`
                    <article class="card mb-3 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <!-- Product Image -->
                                <div class="col-md-4 col-lg-3">
                                    <div class="hoverbox h-md-100">
                                        <a class="text-decoration-none" href="${item.product_img || '#'}" data-gallery="attachment-bg">
                                            <img class="h-100 w-100 object-fit-cover" 
                                            src="../../assets/img/${item.product_img || 'def_img.png'}" 
                                            alt="${item.product_name || 'No Image'}" />
                                        </a>
                                    </div>
                                </div>
                                <!-- Product Details -->
                                <div class="col-md-8 col-lg-9 p-x1">
                                    <div class="row g-0 h-100">
                                        <!-- Description -->
                                        <div class="col-lg-8 col-xxl-9 d-flex flex-column pe-x1">
                                            <div class="d-flex gap-2 flex-wrap mb-3">
                                                <span class="badge rounded-pill badge-subtle-success">
                                                    <span class="fas fa-object-group me-1"></span>
                                                    <span>${item.category}</span>
                                                </span>
                                                <span class="badge rounded-pill badge-subtle-info">
                                                    <span class="fas fa-warehouse me-1"></span>
                                                    <span>${item.wh}</span>
                                                </span>
                                            </div>
                                            <h5 class="fs-9"><a href="#">${item.brand}</a></h5>
                                            <h4 class="mt-3 mt-sm-0 fs-9 fs-lg-8">
                                                <a class="text-900" href="#">${item.product_name}</a>
                                            </h4>
                                            <div class="flex-1 d-flex align-items-end fw-semi-bold fs-10">
                                                <span class="me-1 text-900">${formatDate(item.created_date) || 'N/A'}</span>
                                                <span class="me-2 text-secondary">| Latest Delivery Date</span>
                                            </div>
                                        </div>
                                        <!-- Quantity -->
                                        <div class="col-lg-4 col-xxl-3 mt-4 mt-lg-0">
                                            <div class="h-100 rounded border-lg border-1 d-flex flex-lg-column justify-content-between p-lg-3">
                                                <div class="mb-lg-4 mt-auto mt-lg-0">
                                                    <h4 class="mb-1 lh-1 fs-7 text-warning d-flex align-items-end">${item.quantity || 0}</h4>
                                                    <p class="mb-0 fs-11 text-800">Total Available Quantity</p>
                                                </div>
                                                <div class="mt-3 d-flex flex-lg-column gap-2">
                                                    <button class="btn btn-md btn-primary fs-10" 
                                                            type="button" 
                                                            data-bs-toggle="collapse" 
                                                            data-bs-target="#item${item.product_id}-${item.warehouse}" 
                                                            aria-expanded="false" 
                                                            aria-controls="item${item.product_id}"
                                                            data-wh="${item.warehouse}"> <!-- Added data-wh attribute -->
                                                        <span class="fas fa-info-circle"></span>
                                                        <span class="ms-1 d-none d-lg-inline">View details</span>
                                                    </button>
                                                    <a class="btn btn-md btn-primary fs-10" 
                                                            href="../Product-list/?update=${item.key_product}"> <!-- Added data-wh attribute -->
                                                        <span class="fas fa-pen-square"></span>
                                                        <span class="ms-1 d-none d-lg-inline">Edit product details</span>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="item${item.product_id}-${item.warehouse}"></div>
                    </article>
                `);
            });
        }

        $('#totalItems').text(response.total);
        $('#matchedItems').text(response.data.length);
        updatePagination(response.total);
    });
}

function updatePagination(total) {
    const totalPages = Math.ceil(total / limit);
    const pagination = $('#pagination');
    pagination.empty();

    if (currentPage > 1) {
        pagination.append(`<button class="btn btn-sm btn-secondary me-1" onclick="changePage(${currentPage - 1})">Previous</button>`);
    }

    for (let i = Math.max(1, currentPage - 1); i <= Math.min(totalPages, currentPage + 1); i++) {
        pagination.append(`<button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'} me-1" onclick="changePage(${i})">${i}</button>`);
    }

    if (currentPage < totalPages) {
        pagination.append(`<button class="btn btn-sm btn-secondary" onclick="changePage(${currentPage + 1})">Next</button>`);
    }
}

function changePage(page) {
    currentPage = page;
    loadData();
}

$('#searchInput, #warehouse').on('input change', function () {
    currentPage = 1;
    loadData();
});

$(document).ready(function () {
    loadData();

    // Event delegation for dynamically created buttons
    $(document).on('click', '.btn[data-bs-toggle="collapse"]', function () {
        const itemId = $(this).data('bs-target').replace('#item', ''); // Extract the item ID
        const targetDiv = $(this).data('bs-target'); // Target collapse div ID
        const warehouse = $(this).data('wh'); // Get the warehouse value from the button

        // Check if the content has already been loaded
        if ($(targetDiv).is(':empty')) {
            // Fetch item details and pass both itemId and warehouse (wh) parameters
            $.get(`../Inventory-stock/item_details.php?id=${itemId}&wh=${warehouse}`, function (response) {
                $(targetDiv).html(response); // Load the response into the collapse div
            }).fail(function () {
                $(targetDiv).html('<div class="text-danger p-3">Failed to load item details.</div>');
            });
        }
    });
});



</script>
  <?php 
  }
  ?>

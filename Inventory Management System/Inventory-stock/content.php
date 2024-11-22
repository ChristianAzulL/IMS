<!-- Main Container -->
<div class="col-xxl-10 col-xl-9">
  <!-- Courses Section Card -->
  <div class="card mb-3">
    <!-- Card Header -->
    <div class="card-header position-relative">
        <div class="row">
            <div class="col-4">
                <h5 class="mb-0 mt-1">All Courses</h5>
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
                        <option value="4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a">Warehouse Sample 2</option>
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

<div class="modal fade" id="product-details-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Add a new illustration </h4>
        </div>
        <div class="p-4 pb-0">
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
    let currentPage = 1;
let limit = 9;

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
                                            src="${item.product_img || '../../assets/img/def_img.png'}" 
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
                                                    <span class="fas fa-crown me-1"></span>
                                                    <span>${item.category}</span>
                                                </span>
                                            </div>
                                            <h5 class="fs-9"><a href="#">${item.brand}</a></h5>
                                            <h4 class="mt-3 mt-sm-0 fs-9 fs-lg-8">
                                                <a class="text-900" href="#">${item.product_name}</a>
                                            </h4>
                                            <div class="flex-1 d-flex align-items-end fw-semi-bold fs-10">
                                                <span class="me-1 text-900">${item.created_date || 'N/A'}</span>
                                                <span class="me-2 text-secondary">| ${item.created_by || 'Unknown'}</span>
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
                                                    <button class="btn btn-md btn-primary fs-10" type="button" data-bs-toggle="collapse" data-bs-target="#${item.id}" aria-expanded="false" aria-controls="collapseExample">
                                                        <span class="fas fa-cart-plus"></span>
                                                        <span class="ms-1 d-none d-lg-inline">View details</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="${item.id}">
                            <div class="table-responsive">
                                <table class="table table-bordered-solid">
                                    <thead>
                                        <th>
                                            <b>
                                                <small>
                                                    BATCH CODE
                                                </small>
                                            </b>
                                        </th>
                                        <th>
                                            <b>
                                                <small>
                                                    PRICE/ CAPITAL
                                                </small>
                                            </b>
                                        </th>
                                        <th>
                                            <b>
                                                <small>
                                                    QUANTITY 
                                                </small>
                                            </b>
                                        </th>
                                        <th>
                                            <b>
                                                <small>
                                                    SUPPLIER
                                                </small>
                                            </b>
                                        </th>
                                        <th>
                                            <b>
                                                <small>
                                                    DATE ADDED
                                                </small>
                                            </b>
                                        </th>
                                    </thead>
                                    <tbody id="product${item.id}">
                                        SELECT 
                                            s.batch_code, 
                                            s.capital, 
                                            s.date, 
                                            COUNT(*) AS batch_qty,
                                            sup.supplier_name
                                        FROM stocks s
                                        LEFT JOIN supplier sup ON s.supplier = sup.hashed_id
                                        WHERE s.product_id = ?
                                        GROUP BY s.batch_code, s.price, sup.supplier_name
                                        ORDER BY s.date DESC

                                        <td>batch_code</td>
                                        <td>capital</td>
                                        <td>batch_qty</td>
                                        <td>supplier_name</td>
                                        <td>date</td>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
});
</script>
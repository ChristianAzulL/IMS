<div class="row">
  <!-- Weekly Sales Card -->
  <div class="col-lg-6 mb-3">
    <div class="card h-md-100 ecommerce-card-min-width">
      <div class="card-header pb-0">
        <h6 class="mb-0 mt-2 d-flex align-items-center">
          Weekly Sales
          <span class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Calculated according to last week's sales">
            <span class="far fa-question-circle" data-fa-transform="shrink-1"></span>
          </span>
        </h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-end">
        <div class="row">
          <div class="col">
            <p id="weekly-sales-amount" class="font-sans-serif lh-1 mb-1 fs-5">Loading...</p>
            <span class="badge badge-subtle-success rounded-pill fs-11">+3.5%</span>
          </div>
          <div class="col-auto ps-0">
            <div class="echart-bar-weekly-sales h-100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Total Order Card -->
  <div class="col-lg-6 mb-3">
    <div class="card h-md-100">
      <div class="card-header pb-0">
        <!-- Card Title -->
        <h6 class="mb-0 mt-2">Total Order <small>(all time)</small></h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-end">
        <div class="row justify-content-between">
          <!-- Order Count and Growth -->
          <div class="col-auto align-self-end">
            <div class="fs-5 fw-normal font-sans-serif text-700 lh-1 mb-1">58.4K</div>
            <span class="badge rounded-pill fs-11 bg-200 text-primary">
              <span class="fas fa-caret-up me-1"></span>13.6%
            </span>
          </div>
          <!-- Line Chart for Order Trends -->
          <div class="col-auto ps-0 mt-n4">
            <div class="echart-default-total-order" 
                 data-echarts='{"tooltip":{"trigger":"axis","formatter":"{b0} : {c0}"},"xAxis":{"data":["Week 4","Week 5","Week 6","Week 7"]},"series":[{"type":"line","data":[20,40,100,120],"smooth":true,"lineStyle":{"width":3}}],"grid":{"bottom":"2%","top":"2%","right":"10px","left":"10px"}}' 
                 data-echart-responsive="true">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Compare Capital and Sales Card -->
  <div class="col-lg-7 mb-3 p-0">
    <div class="card">
      <div class="card-body">
        <!-- Description and Toggle Buttons -->
        <p class="text-muted mb-3">Compare the capital and sales for each month</p>
        
        <!-- Main Chart Container -->
        <div class="me-0" id="salesCapital" style="min-height: 300px;" data-echart-responsive="true"></div>
      </div>
    </div>
  </div>

  <!-- Best Selling Products Table -->
  <div class="col-lg-5 mb-3">
    <div class="card h-lg-100 overflow-hidden">
      <div class="card-body p-0">
        <!-- Table for Product Data -->
        <div class="table-responsive scrollbar">
          <table class="table table-dashboard mb-0 table-borderless fs-10 border-200">
            <thead class="bg-body-tertiary">
              <tr>
                <th class="text-900">Fast Moving Products</th>
                <th class="text-900 text-end">Released</th>
                <th class="text-900 pe-x1 text-end" style="width: 8rem">(pcs)</th>
              </tr>
            </thead>
            <tbody>
              <!-- Sample Product Row -->
              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative">
                    <img class="rounded-1 border border-200" src="assets/img/products/12.png" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold">
                        <a class="text-1100 stretched-link" href="#!">Acer Charger</a>
                      </h6>
                      <p class="fw-semi-bold mb-0 text-500">Landing</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-end fw-semi-bold">311</td>
                <td class="align-middle pe-x1">
                  <div class="d-flex align-items-center">
                    <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px;" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar rounded-pill" style="width: 39%;"></div>
                    </div>
                  </div>
                </td>
              </tr>
              <!-- Add similar rows here -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer bg-body-tertiary py-2">
        <div class="row flex-between-center">
          <div class="col-auto">
            <!-- Dropdown for Time Range -->
            <select class="form-select form-select-sm">
              <option>Last 7 days</option>
              <option>Last Month</option>
              <option>Last Year</option>
            </select>
          </div>
          <div class="col-auto">
            <!-- Button to View All -->
            <a class="btn btn-sm btn-falcon-default" href="#!">View All</a>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="col-lg-12">
  <div class="col-xxl-14 col-xl-12 col-12">
    <!-- Courses Section Card -->
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

<?php 
include "message.php";
?>
<script src="../assets/js/salesCapital.js"></script>
<script>
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
<script>
  // Initialize ECharts instance for Capital vs Sales
  var chart = echarts.init(document.getElementById('main'));

  // Chart Configuration
  var option = {
    tooltip: {
      trigger: 'axis',
      axisPointer: { type: 'shadow' } // Highlight bars on hover
    },
    grid: {
      left: '3%',
      right: '4%',
      bottom: '3%',
      top: '10%',
      containLabel: true // Ensure chart fits within container
    },
    xAxis: {
      type: 'category',
      data: ['January', 'February', 'March', 'April', 'May', 'June'] // X-axis labels
    },
    yAxis: {
      type: 'value' // Y-axis is numerical
    },
    series: [
      {
        name: 'Capital', // Series 1: Capital
        type: 'bar',
        itemStyle: { color: '#0d6efd' },
        data: [5000, 7000, 8000, 6000, 7000, 7500] // Monthly data
      },
      {
        name: 'Sales', // Series 2: Sales
        type: 'bar',
        itemStyle: { color: '#198754' },
        data: [8000, 9000, 9500, 8500, 9000, 10000] // Monthly data
      }
    ]
  };

  // Apply chart configuration
  chart.setOption(option);

  // Toggle visibility of Capital and Sales series
  var seriesVisibility = { Capital: true, Sales: true };

  function toggleSeries(seriesName) {
    seriesVisibility[seriesName] = !seriesVisibility[seriesName];

    // Update series data to hide or show based on visibility
    var newSeries = option.series.map(series => ({
      ...series,
      data: series.name === seriesName && !seriesVisibility[seriesName] ? [] : series.data
    }));

    chart.setOption({ series: newSeries });
    // Update button styles
    document.querySelector(`.badge[data-series="${seriesName}"]`).classList.toggle('bg-secondary');
  }

  document.addEventListener("DOMContentLoaded", function () {
    fetch("weekly_sales.php")
      .then(response => response.json())
      .then(data => {
        const weeklySales = data.weekly_sales ?? 0;
        document.getElementById("weekly-sales-amount").textContent = `₱${weeklySales.toLocaleString()}`;
      })
      .catch(error => console.error("Error fetching weekly sales:", error));
  });

</script>
<script>
  $(document).ready(function() {
    // Trigger the click event on the button with the id "prototype-message"
    $('#prototype-message').click();
  });
</script>

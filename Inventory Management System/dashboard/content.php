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
            <p class="font-sans-serif lh-1 mb-1 fs-5">$47K</p>
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
        <h6 class="mb-0 mt-2">Total Order <small>(all time)</small></h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-end">
        <div class="row justify-content-between">
          <div class="col-auto align-self-end">
            <div class="fs-5 fw-normal font-sans-serif text-700 lh-1 mb-1">58.4K</div>
            <span class="badge rounded-pill fs-11 bg-200 text-primary">
              <span class="fas fa-caret-up me-1"></span>13.6%
            </span>
          </div>
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
  <div class="col-lg-6 mb-3">
    <div class="card">
      <div class="card-body">
        <p class="text-muted mb-3">Compare the capital and sales for each month</p>
        <div class="mb-3 text-center">
          <span class="badge bg-primary" data-series="Capital" onclick="toggleSeries('Capital')">Capital</span>
          <span class="badge bg-success" data-series="Sales" onclick="toggleSeries('Sales')">Sales</span>
        </div>
        <div id="main" style="min-height: 300px;" data-echart-responsive="true"></div>
      </div>
    </div>
  </div>

  <!-- Best Selling Products Table -->
  <div class="col-lg-6 mb-3">
    <div class="card h-lg-100 overflow-hidden">
      <div class="card-body p-0">
        <div class="table-responsive scrollbar">
          <table class="table table-dashboard mb-0 table-borderless fs-10 border-200">
            <thead class="bg-body-tertiary">
              <tr>
                <th class="text-900">Fast Moving Products</th>
                <th class="text-900 text-end">Released</th>
                <th class="text-900 pe-x1 text-end" style="width: 8rem">(pcs))</th>
              </tr>
            </thead>
            <tbody>
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

              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative">
                    <img class="rounded-1 border border-200" src="assets/img/products/12.png" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold">
                        <a class="text-1100 stretched-link" href="#!">Asus Charger</a>
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

              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative">
                    <img class="rounded-1 border border-200" src="assets/img/products/12.png" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold">
                        <a class="text-1100 stretched-link" href="#!">ROG Charger</a>
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

              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative">
                    <img class="rounded-1 border border-200" src="assets/img/products/12.png" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold">
                        <a class="text-1100 stretched-link" href="#!">Charger A</a>
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

              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative">
                    <img class="rounded-1 border border-200" src="assets/img/products/12.png" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold">
                        <a class="text-1100 stretched-link" href="#!">Charger B</a>
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

              
              
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer bg-body-tertiary py-2">
        <div class="row flex-between-center">
          <div class="col-auto">
            <select class="form-select form-select-sm">
              <option>Last 7 days</option>
              <option>Last Month</option>
              <option>Last Year</option>
            </select>
          </div>
          <div class="col-auto">
            <a class="btn btn-sm btn-falcon-default" href="#!">View All</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <?php 
          $first = true;

          foreach ($user_warehouse_ids as $id) {
            $id = trim($id);
            $warehouse_info_query = "SELECT * FROM warehouse WHERE hashed_id = '$id'";
            $warehouse_info_result = mysqli_query($conn, $warehouse_info_query);
            if($warehouse_info_result->num_rows>0){
              $row=$warehouse_info_result->fetch_assoc();
              $tab_warehouse_name = $row['warehouse_name'];
              if ($first) {
                echo '<li class="nav-item"><a class="nav-link active" id="tab' . $id . '" data-bs-toggle="tab" href="#tab-wh' . $id . '" role="tab" aria-controls="tab-wh' . $id . '" aria-selected="true">' . $tab_warehouse_name . '</a></li>';
                $first = false;
              } else {
                echo '<li class="nav-item"><a class="nav-link" id="tab' . $id . '" data-bs-toggle="tab" href="#tab-wh' . $id . '" role="tab" aria-controls="tab-wh' . $id . '" aria-selected="false">' . $tab_warehouse_name . '</a></li>';
              }
            }

          }
          ?>
        </ul>
        <div class="tab-content border border-top-0 p-3" id="myTabContent">
          <?php 
          $first = true;
          foreach ($user_warehouse_ids as $id) {
            $id = trim($id);
            if($first){
            ?>
            <div class="tab-pane fade show active" id="tab-wh<?php echo $id;?>" role="tabpanel" aria-labelledby="home-tab">

            </div>
            <?php
            $first = false;
            } else {
            ?>
            <div class="tab-pane fade" id="tab-wh<?php echo $id;?>" role="tabpanel" aria-labelledby="home-tab">
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead class="table-dark">
                    <tr>
                      <th><small>Product Description</small></th>
                      <th><small>Keyword</small></th>
                      <th><small>Barcode</small></th>
                      <th><small>Qty</small></th>
                      <th><small>Brand</small></th>
                      <th><small>Category</small></th>
                      <th><small>Transaction</small></th>
                      <!-- <th><small></small></th>
                      <th><small></small></th>
                      <th><small></small></th> -->
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $stock_query = "SELECT 
                                          COUNT(s.id) AS qty, 
                                          p.description, 
                                          p.parent_barcode AS Barcode, 
                                          b.brand_name, 
                                          c.category_name
                                      FROM stocks s
                                      LEFT JOIN product p ON p.id = s.product_id
                                      LEFT JOIN brand b ON b.hashed_id = p.brand
                                      LEFT JOIN category c ON c.hashed_id = p.category
                                      WHERE s.warehouse = '$id'
                                      GROUP BY s.product_id
                                      ORDER BY s.id DESC";

                      $result = mysqli_query($conn, $stock_query); // Assuming $conn is your connection.

                      while ($row = mysqli_fetch_assoc($result)) {
                          $description = $row['description'];
                          $barcode = $row['Barcode']; // Column alias
                          $qty = $row['qty'];
                          $brand_name = $row['brand_name'];
                          $category_name = $row['category_name'];
                      ?>
                          <tr>
                              <td><small><?php echo htmlspecialchars($description); ?></small></td>
                              <td><small><?php echo htmlspecialchars($barcode); ?></small></td>
                              <td><small><?php echo htmlspecialchars($qty); ?></small></td>
                              <td><small><?php echo htmlspecialchars($brand_name); ?></small></td>
                              <td><small><?php echo htmlspecialchars($category_name); ?></small></td>
                              <td><small>leave it be</small></td>
                          </tr>
                      <?php } ?>
                  </tbody>

                </table>
              </div>
            </div>
            <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var chart = echarts.init(document.getElementById('main'));

  var option = {
    tooltip: {
      trigger: 'axis',
      axisPointer: { type: 'shadow' }
    },
    grid: {
      left: '3%',
      right: '4%',
      bottom: '3%',
      top: '10%',
      containLabel: true
    },
    xAxis: {
      type: 'category',
      data: ['January', 'February', 'March', 'April', 'May', 'June']
    },
    yAxis: {
      type: 'value'
    },
    series: [
      {
        name: 'Capital',
        type: 'bar',
        itemStyle: { color: '#0d6efd' },
        data: [5000, 7000, 8000, 6000, 7000, 7500]
      },
      {
        name: 'Sales',
        type: 'bar',
        itemStyle: { color: '#198754' },
        data: [8000, 9000, 9500, 8500, 9000, 10000]
      }
    ]
  };

  chart.setOption(option);

  var seriesVisibility = { Capital: true, Sales: true };

  function toggleSeries(seriesName) {
    seriesVisibility[seriesName] = !seriesVisibility[seriesName];

    var newSeries = option.series.map(series => ({
      ...series,
      data: series.name === seriesName && !seriesVisibility[seriesName] ? [] : series.data
    }));

    chart.setOption({ series: newSeries });
    document.querySelector(`.badge[data-series="${seriesName}"]`).classList.toggle('bg-secondary');
  }
</script>

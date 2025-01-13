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
</div>
<script src="../assets/js/salesCapital.js"></script>
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
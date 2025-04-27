<div class="card py-3 mb-3">
  <div class="card-body py-3">
    <div class="row">
        <div class="col-8 col-md-6 mb-3">
            <label class="form-label" for="timepicker2">Select Date Range</label>
            <input class="form-control datetimepicker" name="date_between" id="timepicker2" type="text" placeholder="dd/mm/yy to dd/mm/yy" data-options='{"mode":"range","dateFormat":"d/m/y","disableMobile":false}' />
        </div>
        <div class="col-6 mb-3">
          <h6 id="dateLabel">${date}</h6> <!-- <-- ADD id="dateLabel" -->
        </div>
    </div>

    <div class="row g-0">

      <!-- Orders -->
      <div class="col-6 col-md-6 border-200 border-bottom border-end pb-4">
        <h6 class="pb-1 text-700">Outbound</h6>
        <p id="outboundQty" class="font-sans-serif lh-1 mb-1 fs-7">number_format(${outbound_qty})</p> <!-- id="outboundQty" -->
        <div class="d-flex align-items-center">
          <h6 class="fs-10 text-500 mb-0">qty</h6>
        </div>
      </div>

      <!-- Items Sold -->
      <div class="col-6 col-md-6 border-200 border-bottom border-end-md pb-4 ps-3">
        <h6 class="pb-1 text-700">Inbound</h6>
        <p id="inboundQty" class="font-sans-serif lh-1 mb-1 fs-7">number_format(${inbound_qty})</p> <!-- id="inboundQty" -->
        <div class="d-flex align-items-center">
          <h6 class="fs-10 text-500 mb-0">qty</h6>
        </div>
      </div>

      <!-- Gross Sale -->
      <div class="col-6 col-md-6 border-200 border-bottom border-bottom-md-0 border-end-md pt-4 pb-md-0 ps-3 ps-md-0">
        <h6 class="pb-1 text-700">Outbound ₱</h6>
        <p id="outboundSales" class="font-sans-serif lh-1 mb-1 fs-7">₱ 100.26</p> <!-- id="outboundSales" -->
      </div>

      <!-- Shipping -->
      <div class="col-6 col-md-6 border-200 border-bottom-md-0 border-end pt-4 pb-md-0 ps-md-3">
        <h6 class="pb-1 text-700">Inbound ₱</h6>
        <p id="inboundCost" class="font-sans-serif lh-1 mb-1 fs-7">₱ 365.53</p> <!-- id="inboundCost" -->
      </div>

    </div>
  </div>
</div>



<script>
function numberFormat(num) {
    return num.toLocaleString();
}
function currencyFormat(num) {
    return "₱ " + num.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

document.addEventListener("DOMContentLoaded", function() {
    const dateInput = document.getElementById("timepicker2");

    function fetchData(date_between = null) {
        let bodyData = date_between ? "date_between=" + encodeURIComponent(date_between) : "";

        fetch("test.php?wh=<?php echo $dashboard_wh;?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: bodyData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("dateLabel").innerText = data.date;
            document.getElementById("outboundQty").innerText = numberFormat(data.outbound_qty);
            document.getElementById("inboundQty").innerText = numberFormat(data.inbound_qty);
            document.getElementById("outboundSales").innerText = currencyFormat(data.outbound_sales);
            document.getElementById("inboundCost").innerText = currencyFormat(data.inbound_cost);
        })
        .catch(error => {
            console.error("Error fetching data:", error);
        });
    }

    // 🔥 Fetch today's data immediately when page loads
    fetchData();

    // 🔥 Then listen if user selects a date range
    dateInput.addEventListener("change", function() {
        fetchData(this.value);
    });
});

</script>

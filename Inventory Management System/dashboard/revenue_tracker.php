<div class="col-8">
    <h6 class="mb-0 mt-2 d-flex align-items-center" id="rev_labelDate">${date}</h6>
</div>

<div class="col-4">
    <label class="form-label" for="rev_dateGross">Select Date Range</label>
    <input class="form-control datetimepicker" name="rev_dateGross" id="rev_dateGross" type="text" placeholder="dd/mm/yy to dd/mm/yy" data-options='{"mode":"range","dateFormat":"d/m/y","disableMobile":true}' />
</div>

<div class="col-4">
    <div class="card h-md-100 ecommerce-card-min-width">
        <div class="card-header pb-0">
            <h6 class="mb-0 mt-2 d-flex align-items-center">Total Sales</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-end">
            <div class="row">
                <div class="col">
                    <p class="font-sans-serif lh-1 mb-1 fs-7" id="rev_totalSales">₱</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-4">
    <div class="card h-md-100 ecommerce-card-min-width">
        <div class="card-header pb-0">
            <h6 class="mb-0 mt-2 d-flex align-items-center">Cost of Good Sold</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-end">
            <div class="row">
                <div class="col">
                    <p class="font-sans-serif lh-1 mb-1 fs-7" id="rev_goodSold">₱</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-4">
    <div class="card h-md-100 ecommerce-card-min-width">
        <div class="card-header pb-0">
            <h6 class="mb-0 mt-2 d-flex align-items-center">Net Income</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-end">
            <div class="row">
                <div class="col">
                    <p class="font-sans-serif lh-1 mb-1 fs-7" id="rev_netIncome">₱</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function rev_numberFormat(num) {
        return num.toLocaleString();
    }

    function rev_currencyFormat(num) {
        return "₱ " + num.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const rev_dateInput = document.getElementById("rev_dateGross");

        function rev_fetchData(rev_dateGross = null) {
            let rev_bodyData = rev_dateGross ? "rev_dateGross=" + encodeURIComponent(rev_dateGross) : "";

            fetch("revenue_backend.php?wh=<?php echo $dashboard_wh;?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: rev_bodyData
            })
            .then(response => response.json())
            .then(rev_data => {
                document.getElementById("rev_labelDate").innerText = rev_data.date_selected;
                document.getElementById("rev_totalSales").innerText = rev_numberFormat(rev_data.total_sales);
                document.getElementById("rev_goodSold").innerText = rev_numberFormat(rev_data.good_sold);
                document.getElementById("rev_netIncome").innerText = rev_currencyFormat(rev_data.net_income);
            })
            .catch(rev_error => {
                console.error("Error fetching data:", rev_error);
            });
        }

        // Fetch today's data immediately when page loads
        rev_fetchData();

        // Then listen if user selects a date range
        rev_dateInput.addEventListener("change", function() {
            rev_fetchData(this.value);
        });
    });
</script>

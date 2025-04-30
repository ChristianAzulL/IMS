<div class="card">
    <div class="card-header">
        <h3>Forecasting</h3>
    </div>
    <div class="card-body overflow-hidden">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row g-2">
                <div class="col-lg-3">
                    <label for="year">Year</label>
                    <select class="form-select" name="year" id="year"required>
                        <option value=""></option>
                        <?php
                        $startYear = 2018;
                        $currentYear = date("Y");
                        for ($year = $startYear; $year <= $currentYear; $year++) {
                            echo "<option value=\"$year\">$year</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label for="csv_file">Upload CSV</label>
                    <input type="file" class="form-control" name="csv_file" id="csv_file" accept=".csv" required>
                </div>
                <div class="col-lg-auto">
                    <button class="btn btn-primary mt-4" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
$product_query = "SELECT p.*"
?>
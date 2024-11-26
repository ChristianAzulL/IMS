<div class="card">
    <div class="card-body bg-body-tertiary overflow-hidden p-lg-6">
        <div class="tab-content row">
            <div class="col-4 mb-3">
                <label for="">Filter by Barcode /Keyword</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-2 mb-3">
                <label class="form-label" for="datepicker">Start Date</label>
                <input class="form-control datetimepicker" id="datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' />
            </div>
            <div class="col-2 mb-3">
                <label class="form-label" for="datepicker">End Date</label>
                <input class="form-control datetimepicker" id="datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' />
            </div>
            <div class="col-4 mb-3">
                <label for="">Staff Name</label>
                <select class="form-select js-choice" multiple="multiple" size="1" name="organizerMultiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                    <option value="">Select staff...</option>
                    <option>Juan Dela Cruz</option>
                    <option>John Doe</option>
                    <option>Melissa Hopkins</option>
                    <option>Mike Tyson</option>
                </select>
            </div>
            <div class="col-4 mb-3">
                <label for="">Warehouse</label>
                <select class="form-select" name="" id="">
                    <?php echo implode("\n", $warehouse_options); ?>
                </select>
            </div>
            <div class="col-3 pt-4">
                <div class="form-check mt-1"><input class="form-check-input" id="flexCheckDefault" type="checkbox" value="" /><label class="form-check-label" for="flexCheckDefault">Group by Item</label></div>
            </div>
            <div class="col-4 mb-3 pt-4">
                <button class="btn btn-primary mt-1">Generate Report</button>
            </div>
        </div>
    </div>
</div>
<form action="outbound-process.php" id="myForm" method="POST">
    <div class="row">
        <div class="col-6">
            <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode" required>
        </div>
        <div class="col-4">
            <input type="number" name="selling_price" class="form-control" placeholder="Selling Price" step="0.01" required>
        </div>
        <div class="col-2">
            <button class="btn btn-info" id="btn-submit" type="submit">Submit</button>
        </div>
    </div>
</form>

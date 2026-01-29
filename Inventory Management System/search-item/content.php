<div class="card">
    <div class="card-body overflow-hidden">
        <form action="index.php" method="POST">
            <div class="row">
                <div class="col-6">
                    <label for="search">Input Barcode: </label>
                    <input type="text" name="barcode" class="form-control" <?php if(isset($_POST['barcode'])){ echo "value=' . $_POST['barcode'] . '";}?>>            
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary" hidden>Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
if(isset($_POST['barcode'])){
?>
<div class="card">
    <div class="card-body overflow-hidden">
        
    </div>
</div>
<?php
}
?>
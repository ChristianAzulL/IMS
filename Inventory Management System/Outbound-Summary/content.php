<div class="card">
    <div class="card-header text-center">
        <h2>Outbound Summary</h2>
    </div>
    <div class="card-body">
        <form action="../Outbound-Summary/index.php" method="POST">
        <div class="row">
            <div class="col-8">
                <label for="organizerMultiple">Warehouse</label>
                <select class="form-select" name="warehouses" required>
                    <option value="">Select warehouse</option>
                    <?php 
                    $warehouses_query = "SELECT * FROM warehouse";
                    $warehouse_res = $conn->query($warehouses_query);
                    if($warehouse_res->num_rows>0){
                        while($row=$warehouse_res->fetch_assoc()){
                            echo '<option value="' . $row['hashed_id'] . '">' . $row['warehouse_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-4 pt-4">
                <button class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
        </form>

        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selected_Warehouse = $_POST['warehouses'];
        ?>
        <div class="text-center">
            <!-- <p>
                NOTE: This is a demonstration
            </p> -->
            <br>
            <a class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="download-local.php?warehouse_id=<?php echo $selected_Warehouse;?>"><span class="fas fa-file-alt text-primary" data-fa-transform="grow-4"></span><span class="ms-2">Download</span></a>
            
        </div>
        <?php
        }
        ?>
    </div>
</div>
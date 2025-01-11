<?php 
if(isset($_GET['prod'])){
$unique_barcode = $_GET['prod'];
$product_query = "SELECT 
                        p.product_img, 
                        p.description, 
                        b.brand_name, 
                        c.category_name, 
                        il.location_name, 
                        sup.supplier_name, 
                        w.warehouse_name, 
                        w.hashed_id,
                        u.user_fname, 
                        u.user_lname, 
                        s.capital, 
                        s.price, 
                        s.batch_code, 
                        s.parent_barcode,
                        s.date,
                        s.outbound_id,
                        sup.local_international
                    FROM stocks s
                    LEFT JOIN product p ON p.hashed_id = s.product_id
                    LEFT JOIN brand b ON b.hashed_id = p.brand
                    LEFT JOIN category c ON c.hashed_id = p.category
                    LEFT JOIN item_location il ON il.id = s.item_location
                    LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
                    LEFT JOIN users u ON u.hashed_id = s.user_id
                    LEFT JOIN supplier sup ON sup.hashed_id = s.supplier
                    WHERE s.unique_barcode = '$unique_barcode' 
                    LIMIT 1
                    ";
$result = $conn->query($product_query);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        if(!empty($row['product_img']) && isset($row['product_img'])){
            $product_image = basename($row['product_img']);    
        } else {
            $product_image = "def_img.png";
        }
        $product_description = $row['description'];
        $product_brand = $row['brand_name'];
        $product_category = $row['category_name'];
        $item_location = $row['location_name'];
        $supplier_name = $row['supplier_name'];
        $warehouse_name = $row['warehouse_name'];
        $added_by = $row['user_fname'] . " " . $row['user_lname'];
        $capital = $row['capital'];
        $sold_amount = $row['price'];
        $batch_code = $row['batch_code'];
        $parent_barcode = $row['parent_barcode'];
        $warehouse_hashed_id = $row['hashed_id'];
        $delivery_date = $row['date'];
        $local_international = $row['local_international'];
        if($local_international === "Local"){
            $local_international = '<span class="badge rounded-pill badge-subtle-primary">Local</span>';
        } else {
            $local_international = '<span class="badge rounded-pill badge-subtle-danger">International</span>';
        }

        if(!empty($item_location)){
            $item_location = $row['location_name'] . '<span class="badge rounded-pill badge-subtle-success"><span class="far fa-check-circle"></span></span>';
        } else {
            $item_location = 'For SKU <span class="badge rounded-pill badge-subtle-danger"><span class="far fa-window-close"></span></span>';
        }
        ?>
            <div class="row">
                <div class="col-auto">
                <?php
                $delivery_date2 = $row['date'];

                function formatDateDifference($delivery_date2) {
                    $startDate = new DateTime($delivery_date2); // Parse the datetime string
                    $endDate = new DateTime(); // Current date and time
                    $interval = $startDate->diff($endDate);

                    if ($interval->y > 0) {
                        return $interval->y . " year" . ($interval->y > 1 ? "s" : "") . 
                            ($interval->m > 0 ? " " . $interval->m . " month" . ($interval->m > 1 ? "s" : "") : "") .
                            ($interval->d > 0 ? " " . $interval->d . " day" . ($interval->d > 1 ? "s" : "") : "");
                    } elseif ($interval->m > 0) {
                        return $interval->m . " month" . ($interval->m > 1 ? "s" : "") . 
                            ($interval->d > 0 ? " " . $interval->d . " day" . ($interval->d > 1 ? "s" : "") : "");
                    } else {
                        return $interval->d . " day" . ($interval->d > 1 ? "s" : "");
                    }
                }

                function getBadgeClass($delivery_date2) {
                    $startDate = new DateTime($delivery_date2);
                    $endDate = new DateTime();
                    $interval = $startDate->diff($endDate);

                    if ($interval->m >= 3 || $interval->y > 0) {
                        return "bg-danger";
                    } elseif ($interval->m >= 1) {
                        return "bg-warning";
                    } else {
                        return "bg-primary";
                    }
                }

                $badgeClass = getBadgeClass($delivery_date2);
                $formattedDateDifference = formatDateDifference($delivery_date2);

                echo '<button class="btn btn-primary d-none" id="liveToastBtn" type="button">Show </button>
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
                <div class="toast fade" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header ' . $badgeClass . ' text-white"><strong class="me-auto">IMS</strong>
                    <div data-bs-theme="dark"><button class="btn-close" type="button" data-bs-dismiss="toast" aria-label="Close"></button></div>
                    </div>
                    <div class="toast-body">This item has been on the inventory for ' . $formattedDateDifference . '</div>
                </div>
                </div>';
                ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-end my-3">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#change-location-modal">Change item location</button>
                </div>
            </div>
            <article class="card mb-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Product Image -->
                        <div class="col-md-4 col-lg-3">
                            <div class="hoverbox h-md-100">
                                <a class="text-decoration-none" href="../../assets/img/<?php echo $product_image;?>" data-gallery="attachment-bg">
                                    <img class="h-100 w-100 object-fit-cover" 
                                    src="../../assets/img/<?php echo $product_image;?>" 
                                    alt="No Image" />
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
                                            <span><?php echo $product_category;?></span>
                                        </span>
                                        <span class="badge rounded-pill badge-subtle-info">
                                            <span class="fas fa-warehouse me-1"></span>
                                            <span><?php echo $warehouse_name;?></span>
                                        </span>
                                    </div>
                                    <h5 class="fs-9"><a href="#"><?php echo $product_brand;?></a></h5>
                                    <h4 class="mt-3 mt-sm-0 fs-9 fs-lg-8">
                                        <a class="text-900" href="#"><?php echo $product_description;?></a>
                                    </h4>
                                    <div class="flex-1 d-flex align-items-end fw-semi-bold fs-10">
                                        <span class="me-1 text-900"><?php echo $delivery_date;?></span>
                                        <span class="me-2 text-secondary">| Delivery Date</span>
                                        <span class="me-2 text-secondary">| Added by: <?php echo $added_by;?></span>
                                    </div>
                                </div>
                                <!-- Quantity -->
                                <div class="col-lg-4 col-xxl-3 mt-4 mt-lg-0">
                                    <div class="h-100 rounded border-lg border-1 d-flex flex-lg-column justify-content-between p-lg-3">
                                        <div class="mb-lg-4 mt-auto mt-lg-0">
                                            <table class="table table-sm mb-3">
                                                <?php 
                                                $outbount_id = $row['outbound_id'];
                                                if(!empty($outbount_id)){
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th class="mb-1 lh-1 text-warning align-end">Capital</th>
                                                        <th class="mb-1 lh-1 text-success align-end">Sold for</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="mb-1 lh-1 fs-7 text-warning align-end"><?php echo $capital;?></td>
                                                        <td class="mb-1 lh-1 fs-7 text-success align-end"><?php echo $sold_amount;?></td>
                                                    </tr>
                                                </tbody>
                                                <?php
                                                } else {
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th class="mb-1 lh-1 fs-7 text-warning align-end">Capital</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="mb-1 lh-1 fs-7 text-warning align-end"><?php echo $capital;?></td>
                                                    </tr>
                                                </tbody>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                            
                                        </div>
                                        <div class="mt-3 d-flex flex-lg-column gap-2">
                                            <table class="table table-sm">
                                                <tr>
                                                    <th>Supplier:</th>
                                                    <td><?php echo $supplier_name . " " . $local_international;?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Location</th>
                                                    <td><?php echo $item_location;?></td>
                                                </tr>
                                                <tr>
                                                    <th>Batch</th>
                                                    <td><?php echo $batch_code;?></td>
                                                </tr>
                                                <tr>
                                                    <th>Barcode</th>
                                                    <td><?php echo $unique_barcode;?></td>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-sm-4 px-md-8 px-lg-6 px-xxl-8">
                    <div class="row my-3">
                        <div class="col-lg-12 text-center">
                            <h3>Product History</h3>
                        </div>
                    </div>
                    <div class="timeline-vertical">
                        <div class="timeline-item timeline-item-start">
                            <div class="timeline-icon icon-item icon-item-lg text-primary border-300">
                                <span class="fs-8 fas fa-mobile"></span>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 timeline-item-time">
                                    <div>
                                        <p class="fs-10 mb-0 fw-semi-bold"><?php echo $delivery_date2;?></p>
                                        <!-- <p class="fs-11 text-600">24 September</p> -->
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="timeline-item-content">
                                        <div class="timeline-item-card">
                                            <h5 class="mb-2">Inbound</h5>
                                            <p class="fs-10 mb-0">Item has been successfully inbounded.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $first = false;
                        $timeline_query = "SELECT 
                                                u.user_fname, 
                                                u.user_lname, 
                                                st.title, 
                                                st.action, 
                                                st.date
                                            FROM stock_timeline st
                                            LEFT JOIN users u ON u.hashed_id = st.user_id
                                            WHERE st.unique_barcode = '$unique_barcode'
                                            ORDER BY st.date ASC";
                        $result = $conn->query($timeline_query);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                                $did_by = $row['user_fname'] . " " . $row['user_lname'];
                                $title = $row['title'];
                                $action = $row['action'];
                                $action_date = $row['date'];
                                if($first === true){
                                ?>
                                <div class="timeline-item timeline-item-start">
                                    <div class="timeline-icon icon-item icon-item-lg text-primary border-300">
                                        <span class="fs-8 fas fa-mobile"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 timeline-item-time">
                                            <div>
                                                <p class="fs-10 mb-0 fw-semi-bold"><?php echo $action_date;?></p>
                                                <!-- <p class="fs-11 text-600">24 September</p> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="timeline-item-content">
                                                <div class="timeline-item-card">
                                                    <h5 class="mb-2"><?php echo $title;?></h5>
                                                    <p class="fs-10 mb-0"><?php echo $action;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $first = false;
                                } else {
                                ?>
                                <div class="timeline-item timeline-item-end">
                                    <div class="timeline-icon icon-item icon-item-lg text-primary border-300">
                                        <span class="fs-8 fas fa-fire"></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 timeline-item-time">
                                            <div>
                                                <p class="fs-10 mb-0 fw-semi-bold"><?php echo $action_date;?></p>
                                                <!-- <p class="fs-11 text-600">03 April</p> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="timeline-item-content">
                                                <div class="timeline-item-card">
                                                    <h5 class="mb-2"><?php echo $title;?></h5>
                                                    <p class="fs-10 mb-0"><?php echo $action;?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $first = true;
                                }
                                
                            }
                        } else {
                            echo "<h1>Nothing yet!</h1>";
                        }
                        ?>
                    </div>
                </div>
            </article>

            <div class="modal fade" id="change-location-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                    <div class="modal-content position-relative p-3">
                        <form action="sample.php" method="POST">
                        <!-- Close Button -->
                        <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                            <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body p-0">
                            <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                                <h4 class="mb-1" id="modalExampleDemoLabel">Change Item Location</h4>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="item_location">Select item location</label>
                                    <select class="form-select" id="item_location" name="item_location" id="" required>
                                        <?php 
                                        $item_location_query = "SELECT * FROM item_location WHERE warehouse = '$warehouse_hashed_id' ORDER BY location_name ASC";
                                        $item_res = $conn->query($item_location_query);

                                        if ($item_res->num_rows > 0) {
                                            while ($row = $item_res->fetch_assoc()) {
                                                $location_id = $row['id'];
                                                $location_name = $row['location_name'];
                                                if($item_location === $location_name){
                                                    echo '<option selected>' . $location_name . '</option>';
                                                } else {
                                                    echo '<option value="' . $location_id . '" >' . $location_name . '</option>';   
                                                }    
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Understood</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php
    }
}
?>
<script>
    // Wait until the entire page (including images and assets) is fully loaded
    window.onload = function() {
        // Find the button by its ID
        const button = document.getElementById("liveToastBtn");
        
        // Trigger a click event on the button
        button.click();
    };
</script>
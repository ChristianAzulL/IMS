<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body px-sm-4 px-md-8 px-lg-6 px-xxl-8">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h1>Audit Trail</h1>
                    </div>
                </div>
                <div class="timeline-vertical">
                    <?php 
                    $start = true; // Flag to track timeline item position

                    // SQL query to fetch logs and user information
                    $sql = "SELECT
                                l.*,
                                u.user_fname,
                                u.user_lname,
                                u.pfp
                            FROM logs l
                            LEFT JOIN users u ON u.hashed_id = l.user_id
                            ORDER BY l.date DESC";

                    $res = $conn->query($sql);

                    // Check if the query returned any results
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            // Extract user and log details
                            $doer = $row['user_fname'] . " " . $row['user_lname'];
                            $doer_pfp = empty($row['pfp']) ? "../../assets/img/def_pfp.png" : $row['pfp'];
                            $doer_fname = $row['user_fname'];
                            $doer_lname = $row['user_lname'];
                            $log_title = $row['title'];
                            $log_action = $row['action'];
                            $log_date = $row['date'];

                            // Format date
                            $log_date_obj = new DateTime($log_date);
                            $log_year = $log_date_obj->format('Y');
                            $log_day_month = $log_date_obj->format('d F');

                            // Output timeline item
                            if ($start) {
                                ?>
                                <div class="timeline-item timeline-item-start">
                                    <div class="timeline-icon icon-item icon-item-lg text-primary border-300"></div>
                                    <div class="row">
                                        <div class="col-lg-6 timeline-item-time">
                                            <div>
                                                <p class="fs-10 mb-0 fw-semi-bold"><?php echo $log_year; ?></p>
                                                <p class="fs-11 text-600"><?php echo $log_day_month; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="timeline-item-content">
                                                <div class="timeline-item-card">
                                                    <div class="row">
                                                        <div class="col-3 mb-3">
                                                            <img src="<?php echo $doer_pfp; ?>" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                        <div class="col-9 mb-3 border-start">
                                                            <h4 class="mb-0 mt-2"><strong><?php echo $doer_lname; ?></strong></h4>
                                                            <p><?php echo $doer_fname; ?></p>
                                                        </div>
                                                    </div>
                                                    <h5 class="mb-2"><?php echo $log_title; ?></h5>
                                                    <p class="fs-10 mb-0"><?php echo $log_action; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $start = false; // Switch flag for the next item
                            } else {
                                ?>
                                <div class="timeline-item timeline-item-end">
                                    <div class="timeline-icon icon-item icon-item-lg text-primary border-300"></div>
                                    <div class="row">
                                        <div class="col-lg-6 timeline-item-time">
                                            <div>
                                                <p class="fs-10 mb-0 fw-semi-bold"><?php echo $log_year; ?></p>
                                                <p class="fs-11 text-600"><?php echo $log_day_month; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="timeline-item-content">
                                                <div class="timeline-item-card">
                                                    <div class="row">
                                                        <div class="col-3 mb-3">
                                                            <img src="<?php echo $doer_pfp; ?>" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                        <div class="col-9 mb-3 border-start">
                                                            <h4 class="mb-0 mt-2"><strong><?php echo $doer_lname; ?></strong></h4>
                                                            <p><?php echo $doer_fname; ?></p>
                                                        </div>
                                                    </div>
                                                    <h5 class="mb-2"><?php echo $log_title; ?></h5>
                                                    <p class="fs-10 mb-0"><?php echo $log_action; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $start = true; // Reset flag for the next item
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

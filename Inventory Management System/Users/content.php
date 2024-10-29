<div class="row py-6 px-1">
    <div class="col-lg-12 mb-3">
        <h4>User Employee Accounts</h4>
    </div>
    
    <div class="col-lg-12">
        <div id="tableExample3" data-list='{"valueNames":["name","positio","status","warehouse","email","bday","address"],"page":5,"pagination":true}'>

            <!-- Search form -->
            <div class="row justify-content-end g-0">
                <div class="col-auto col-sm-7 mb-3">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">
                        <span class="fas fa-plus"></span> New
                    </button>
                </div>
                <div class="col-auto col-sm-5 mb-3">
                    <form>
                        <div class="input-group">
                            <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                            <div class="input-group-text bg-transparent">
                                <span class="fa fa-search fs-10 text-600"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-200">
                        <tr>
                            <th style="max-width: 50px;"></th>
                            <th class="text-1000 sort" data-sort="name">Name</th>
                            <th class="text-900 sort" data-sort="position">Position</th>
                            <th class="text-900 sort" data-sort="status">Status</th>
                            <th class="text-1000 sort" data-sort="warehouse" style="max-width: 150px;">Warehouse Access</th>
                            <th class="text-900 sort" data-sort="email">Email</th>
                            <th class="text-900 sort" data-sort="bday">Birth Date</th>
                            <th class="text-900 sort" data-sort="address" hidden>Address</th>
                            <th class="text-900 sort" ></th>
                        </tr>
                    </thead>
                    <tbody class="list bg-light">
                        <?php
                        $user_Query = "SELECT u.*, up.position_name
                                        FROM users u
                                        LEFT JOIN user_position up ON up.id = u.user_position
                                        ORDER BY u.id DESC";
                        $user_res = $conn->query($user_Query);
                        if($user_res->num_rows>0){
                            while($row = $user_res ->fetch_Assoc()){
                                $employee_fullname = $row['user_fname'] . " " . $row['user_lname'];
                                $employee_pfp = $row['pfp'];
                                $employee_pos = $row['position_name'];
                                $employee_email = $row['email'];
                                $employee_bday = date("F j, Y", strtotime($row['birth_date']));
                                $employee_address = $row['address'];
                                if($row['status'] == 0){
                                    $employee_Account_status = '<span class="badge bg-danger">Disabled</span>';
                                } else {
                                    $employee_Account_status = '<span class="badge bg-success">Activated</span>';
                                }
                                // Explode the warehouse_access values into an array
                                $warehouse_ids = explode(',', $row['warehouse_access']);

                                // Initialize an array to store warehouse names
                                $warehouse_names = [];

                                // Loop through each warehouse ID and query the warehouse table
                                foreach ($warehouse_ids as $id) {
                                    // Prepare the SQL statement
                                    $sql = "SELECT warehouse_name FROM warehouse WHERE id = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("i", $id);
                                    $stmt->execute();
                                    $stmt->bind_result($warehouse_name);

                                    // Fetch the result and store the warehouse name
                                    if ($stmt->fetch()) {
                                        $warehouse_names[] = '<span class="badge badge-subtle-secondary">' . $warehouse_name . '</span>';
                                    }

                                    // Close the statement after each loop iteration
                                    $stmt->close();
                                }
                                
                        ?>
                            <tr>
                                <td class="p-2"><img class="img img-fluid img-rounded-circle" src="../../assets/img/def_pfp.png" width="30" alt="pfp"></td>
                                <td class="name"><b><small><b><?php echo $employee_fullname;?></b></small></b></td>
                                <td class="position"><small><?php echo $employee_pos;?></small></td>
                                <td class="status"><?php echo $employee_Account_status;?></td>
                                <td class="warehouse" style="max-width: 150px;"><?php echo implode(' ', $warehouse_names); ?></td>
                                <td class="email"><small><?php echo $employee_email;?></small></td>
                                <td class="bday"><small><?php echo $employee_bday;?></small></td>
                                <td class="address" hidden><small><?php echo $employee_address;?></small></td>
                                <td class="py-1 px-0"><button class="btn btn-danger py-0" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="disable"><small><span class="fas fa-minus"></span></small></button></td>
                            </tr>
                        <?php 
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev">
                    <span class="fas fa-chevron-left"></span>
                </button>
                <ul class="pagination mb-0"></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next">
                    <span class="fas fa-chevron-right"></span>
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="../config/add-employee.php" method="POST">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">New employee form</h4>
                    </div>
                    <div class="row p-4 pb-0">
                        <div class="col-lg-4 mb-3">
                            <label for="">First Name</label>
                            <input type="text" name="fname" class="form-control">
                        </div>
                        <div class="col-lg-4 pb-4 mb-3">
                            <label for="">Middle Name</label>
                            <input type="text" name="mname" class="form-control">
                        </div>
                        <div class="col-lg-4 pb-4 mb-3">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" class="form-control">
                        </div>
                        
                        <div class="col-lg-4">
                            <label for="">E-mail</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" for="datepicker">Birth Date</label>
                            <input class="form-control datetimepicker" name="bday" id="datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' />
                        </div>
                        <div class="col-lg-5">
                            <label for="">Position</label>
                            <select class="form-select js-choice" id="organizerSingle" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}' name="employee_pos" id="employee_pos">
                                <option value="">Select Position...</option>
                                <?php 
                                $position_query = "SELECT id, position_name FROM user_position ORDER BY position_name ASC";
                                $position_result = mysqli_query($conn, $position_query);
                                if($position_result->num_rows>0){
                                    while($position_row = $position_result->fetch_assoc()){
                                        echo "<option value='".$position_row['id']."'>".$position_row['position_name']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="">Warehouse Access</label>
                            <div class="row">
                                <?php 
                                $warehouse_query = "SELECT id, warehouse_name FROM warehouse ORDER by warehouse_name ASC";
                                $warehouse_result = $conn->query($warehouse_query);
                                if($warehouse_result->num_rows>0){
                                    while($row = $warehouse_result -> fetch_Assoc()){
                                ?>
                                <div class="col-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="warehouses[]" id="flexSwitchCheckDefault" type="checkbox" value="<?php echo $row['id'];?>"/>
                                        <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo $row['warehouse_name'];?></label>
                                    </div>
                                </div>
                                <?php 
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

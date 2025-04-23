<?php
$repeat = "SELECT * FROM user_position";
$result = mysqli_query($conn, $repeat);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $account_position_id = $row['id'];
        $account_position_name = $row['position_name'];
        $account_position_access = $row['access'];
?>
<!-- Modal -->
<div class="modal fade" id="edit-modal_<?php echo $account_position_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="../config/update-position.php" id="update_access" method="POST">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Update <?php echo $account_position_name;?></h4>
                    </div>
                    <div class="row p-4 pb-0 mb-3">
                        <input type="text" name="position_name" value="<?php echo $account_position_name;?>" readonly hidden>
                        <input type="text" name="position_id" value="<?php echo $account_position_id;?>" readonly hidden>
                        <div class="col-lg-12 mb-3">
                            <label for="">Dashboard</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="dashboard_outbound" <?php if(strpos($account_position_access, "dashboard_outbound")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Outbound on Dashboard</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="dashboard_inventory" <?php if(strpos($account_position_access, "dashboard_inventory")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Inventory on Dashboard</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Inbounds</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="po_logs" <?php if(strpos($account_position_access, "po_logs")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Purchased Order logs</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="new_po" <?php if(strpos($account_position_access, "new_po")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Create Purchased Order</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="inbound_logs" <?php if(strpos($account_position_access, "inbound_logs")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Inbound logs</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="new_inbound" <?php if(strpos($account_position_access, "new_inbound")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Create and Upload Inbound</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="approve_inbound" <?php if(strpos($account_position_access, "approve_inbound")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Approve Delete</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Inventory Management</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="stock" <?php if(strpos($account_position_access, "stock")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View stock</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Logistics</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="logistics" <?php if(strpos($account_position_access, "logistics")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Logistics Access</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="void" <?php if(strpos($account_position_access, "void")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Approve Voided Transactions</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Stock Transfer</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="stock_transfer" <?php if(strpos($account_position_access, "stock_transfer")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Stock Transfer</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="rack_transfer" <?php if(strpos($account_position_access, "rack_transfer")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Transfer items from rack to another rack</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Product Returns</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="returnproduct" <?php if(strpos($account_position_access, "returnproduct")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Returned Products</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Returns</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="returns" <?php if(strpos($account_position_access, "returns")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Return to Supplier</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Finance</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="finance" <?php if(strpos($account_position_access, "finance")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Access on finance module</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Forecasting</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="forecasting" <?php if(strpos($account_position_access, "forecasting")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and create forecast</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Users</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="users" <?php if(strpos($account_position_access, "users")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View  and create user employee accounts</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">administration</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="audit" <?php if(strpos($account_position_access, "audit")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Audit/ System Logs</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="audit" <?php if(strpos($account_position_access, "reports")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Reports</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="admin_category" <?php if(strpos($account_position_access, "admin_category")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Category</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="admin_brand" <?php if(strpos($account_position_access, "admin_brand")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Brand</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="product_list" <?php if(strpos($account_position_access, "product_list")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Product on Product List</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="admin_warehouse" <?php if(strpos($account_position_access, "admin_warehouse")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Warehouse</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="admin_supplier" <?php if(strpos($account_position_access, "admin_supplier")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Supplier</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="admin_platform" <?php if(strpos($account_position_access, "admin_platform")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Platforms</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="admin_courier" <?php if(strpos($account_position_access, "admin_courier")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Couriers</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="barcode_reprint" <?php if(strpos($account_position_access, "barcode_reprint")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Barcode reprint access</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="admin_accessess" <?php if(strpos($account_position_access, "admin_accessess")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Access Levels(Position Create) Access</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="product_destination" <?php if(strpos($account_position_access, "product_destination")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Item Destination</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="view_capital" <?php if(strpos($account_position_access, "view_capital")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Unit Cost</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="view_profit" <?php if(strpos($account_position_access, "view_profit")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Profit</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="approve_inbound" <?php if(strpos($account_position_access, "approve_inbound")!==false){echo 'checked=""';}?>/>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Approve Inbound Delete & Outbound Void</label>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="update_btnsubmit" type="submit" disabled>Submit</button>
                    <button class="btn btn-primary" id="updateloading_btn" type="button" disabled="" hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php

    }
}
?>
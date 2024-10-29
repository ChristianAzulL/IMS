<div class="row">
    <div class="col-lg-12">
        <h4>brand</h4>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body overflow-hidden">
                <div id="tableExample3" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                    <div class="row justify-content-end g-0">
                        <div class="col-auto col-sm-7 mb-3 text-start">
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
                    <div class="table-responsive scrollbar">
                        <table class="table table-bordered table-striped fs-10 mb-0">
                            <thead class="bg-200">
                                <tr>
                                    <th class="text-900 sort" data-sort="name">brand</th>
                                    <th class="text-900 sort" data-sort="email">Published date</th>
                                    <th class="text-900 sort" data-sort="age">Publish by</th>
                                    <th class="text-900">Actions</th> <!-- Added Actions header -->
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php 
                                $brand_query = "SELECT brand.*, users.user_fname, users.user_lname FROM brand LEFT JOIN users ON users.id = brand.user_id ORDER BY id DESC";
                                $brand_result = mysqli_query($conn, $brand_query);
                                if ($brand_result->num_rows > 0) {
                                    while ($row = $brand_result->fetch_assoc()) {
                                        $brand_name = $row['brand_name'];
                                        $publish_Date = $row['date'];
                                        $by = $row['user_fname'] . " " . $row['user_lname'];
                                ?>
                                <tr>
                                    <td class="name"><?php echo htmlspecialchars($brand_name); ?></td>
                                    <td class="email"><?php echo htmlspecialchars($publish_Date); ?></td>
                                    <td class="age"><?php echo htmlspecialchars($by); ?></td>
                                    <td>
                                        <button class="btn btn-secondary">Edit</button>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
    </div>
</div>

<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="../config/add-brand.php" method="POST">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add a new brand</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="brand-name">brand Name:</label>
                            <input class="form-control" id="brand-name" name="brand_name" type="text" />
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

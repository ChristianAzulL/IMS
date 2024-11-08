<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <form id="myForm" action="csv_process.php" method="POST" enctype="multipart/form-data">
                    <div class="row justify-content-end">
                        <div class="col-auto mb-3">
                            <button class="btn btn-primary" id="submitBTN" type="button">Submit</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table bordered-table">
                            <thead class="table-info">
                                <tr>
                                    <th></th>
                                    <th style="min-width: 300px;">Product Description</th>
                                    <th style="min-width: 200px;">Keyword</th>
                                    <th style="min-width: 130px;">Qty</th>
                                    <th style="min-width: 150px;">Price</th>
                                    <th style="min-width: 200px;">Supplier</th>
                                    <th style="min-width: 200px;">Barcode</th>
                                    <th style="min-width: 200px;">Batch no.</th>
                                    <th style="min-width: 200px;">Brand</th>
                                    <th style="min-width: 200px;">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include "tbody.php";?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('submitBTN').addEventListener('click', function(event) {
    Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save",
        denyButtonText: `Don't save`
    }).then((result) => {
        if (result.isConfirmed) {
            // Show the loading spinner before the request
            const swalInstance = Swal.fire({
                title: 'Saving...',
                text: 'Please wait while we process your request.',
                didOpen: () => {
                    Swal.showLoading(); // Show the loading spinner
                },
                allowOutsideClick: false, // Prevent closing the modal by clicking outside
                showCancelButton: false,
                showConfirmButton: false
            });

            var formData = new FormData(document.getElementById('myForm'));

            fetch('csv_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Close the loading spinner
                swalInstance.close();

                // Handle the response based on status
                if (data.status === 'success') {
                    Swal.fire({
                        title: "Saved!",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        // Redirect to the dashboard after clicking "OK"
                        window.location.href = '../dashboard';
                    });
                } else if (data.status === 'info') {
                    Swal.fire("Info", data.message, "info");
                } else {
                    Swal.fire("Error", "There was an issue saving the data.", "error");
                }
            })
            .catch(error => {
                // Close the loading spinner in case of error
                swalInstance.close();
                Swal.fire("Error", "There was an issue with the request.", "error");
            });
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });
});
</script>
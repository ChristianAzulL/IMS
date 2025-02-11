<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-body overflow-hidden">
                <h5 class="mb-3">Add Product:</h5>
                <form id="import" method="POST">
                    <div class="mb-3">
                        <label for="search_item">Item Name:</label>
                        <input type="text" id="search_item" class="form-control">
                    </div>
                    <div class="scrollbar overflow-auto mb-3" style="max-height: 250px;">
                        <div id="showhere"></div>
                    </div>
                    <button class="btn btn-primary w-100" type="submit" id="btnSubmitImport">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-7">
        <div class="card">
            <form action="">
                <div class="card-body overflow-hidden">
                    <div id="tableExample" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs-10 mb-0">
                                <thead class="table-info">
                                    <tr>
                                        <th class="text-900 sort" data-sort="name">Description</th>
                                        <th class="text-900 sort" data-sort="email">Brand</th>
                                        <th class="text-900 sort" data-sort="age">Category</th>
                                        <th class="text-900 sort" data-sort="age">Parent Barcode</th>
                                        <th class="text-900 sort" data-sort="age">Quantity Ordered</th>
                                        <th class="text-900 sort" data-sort="age">Quantity Received</th>
                                        <th class="text-900 sort" data-sort="age">Unit Price</th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="preview"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-end p-3">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastMessage" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastBody"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    function loadPreview() {
        $("#preview").load("preview.php");
    }
    loadPreview();

    $("#search_item").on("keyup", function() {
        let query = $(this).val();
        if (query.length > 1) {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: { query: query },
                dataType: "json",
                success: function(response) {
                    let output = "<ul class='list-group'>";
                    if (response.length > 0) {
                        response.forEach(function(item) {
                            output += `
                                <li class="list-group-item d-flex align-items-center">
                                    <input class="form-check-input me-2 item-checkbox" name="parent_barcode[]" type="checkbox" value="${item.parent_barcode}" id="chk_${item.parent_barcode}">
                                    <label for="chk_${item.parent_barcode}" class="flex-grow-1">
                                        <strong>${item.description}</strong> - ${item.brand_name} - ${item.category_name}
                                    </label>
                                    <span class="badge bg-primary">${item.parent_barcode}</span>
                                </li>`;
                        });
                    } else {
                        output += "<li class='list-group-item text-muted'>No results found</li>";
                    }
                    output += "</ul>";
                    $("#showhere").html(output);
                }
            });
        } else {
            $("#showhere").html("");
        }
    });

    $("#import").on("submit", function(event) {
        event.preventDefault();
        let selectedBarcodes = $(".item-checkbox:checked").map(function() {
            return this.value;
        }).get();
        
        if (selectedBarcodes.length === 0) {
            alert("Please select at least one product.");
            return;
        }

        $.ajax({
            url: "import.php",
            type: "POST",
            data: { parent_barcodes: selectedBarcodes },
            dataType: "json",
            success: function(response) {
                let toastMessage = $("#toastMessage");
                if (response.status === "success") {
                    toastMessage.removeClass("bg-danger").addClass("bg-success");
                    loadPreview();
                } else {
                    toastMessage.removeClass("bg-success").addClass("bg-danger");
                }
                $("#toastBody").text(response.message);
                new bootstrap.Toast(toastMessage[0]).show();
                $("#import")[0].reset();
                $("#showhere").html("");
            },
            error: function() {
                $("#toastMessage").removeClass("bg-success").addClass("bg-danger");
                $("#toastBody").text("Something went wrong. Please try again.");
                new bootstrap.Toast(document.getElementById("toastMessage")).show();
            }
        });
    });
});
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF in Modal with Bootstrap 5</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Button to trigger the modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pdfModal">
    Open PDF in Modal
</button>

<!-- Modal structure -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"> <!-- Use modal-xl for larger modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Embed the PDF using an iframe -->
        <iframe id="pdfViewer" src="" width="100%" height="600px"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- Script to load the PDF dynamically -->
<script>
    var pdfModal = document.getElementById('pdfModal');
    pdfModal.addEventListener('show.bs.modal', function (event) {
        // Set the PDF URL when the modal is shown
        var pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = "HIRC-OFFICIAL-PRICELIST-DEALER (1).pdf";  // Change this to your PDF file path
    });

    pdfModal.addEventListener('hidden.bs.modal', function (event) {
        // Clear the PDF URL when the modal is hidden
        var pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = "";
    });
</script>

</body>
</html>

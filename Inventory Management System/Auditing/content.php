<div class="row">
    <div class="col-xxl-12">
        <h3>Auditing</h3>
    </div>
    <input type="file" id="csvFile" accept=".csv"><button onclick="refreshPage()">Refresh Page</button>
    <button class="btn btn-primary d-none" type="button" id="viewBtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Launch static backdrop modal</button>
<div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-6" role="document">
    <div class="modal-content border-0">
      <div class="position-absolute top-0 end-0 mt-3 me-3 z-1"><button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 bg-body-tertiary py-3 ps-4 pe-6">
          <h4 class="mb-1" id="staticBackdropLabel">Add a new illustration to the landing page</h4>
          <p class="fs-11 mb-0">Added by <a class="link-600 fw-semi-bold" href="#!">Antony</a></p>
        </div>
        <div class="p-4">
          <div class="row">
            <div class="col-lg-9">
                <div id="preview" style="margin-top: 20px;"></div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
</div>

<script>
    function refreshPage() {
      location.reload();
    }
document.getElementById('csvFile').addEventListener('change', function () {
    const file = this.files[0];
    if (!file || !file.name.toLowerCase().endsWith('.csv')) {
        alert('Please upload a valid CSV file.');
        return;
    }

    const formData = new FormData();
    formData.append('file', file);

    fetch('csv_upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('viewBtn').click();
        document.getElementById('preview').innerHTML = html;
    })
    .catch(error => {
        document.getElementById('preview').innerHTML = 'Error uploading file.';
        console.error('Upload failed:', error);
    });
});
</script>

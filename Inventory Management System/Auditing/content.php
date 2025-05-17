
  <div class="row mb-3">
    <div class="col-12">
      <h3 class="mb-3">Auditing</h3>
    </div>

    <div class="col-12">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item"><a class="nav-link active" id="transact-tab" data-bs-toggle="tab" href="#tab-transact" role="tab" aria-controls="tab-transact" aria-selected="true">Transaction</a></li>
        <li class="nav-item"><a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#tab-pending" role="tab" aria-controls="tab-pending" aria-selected="false">Pending and Unmatched Records</a></li>
        <li class="nav-item"><a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#tab-history" role="tab" aria-controls="tab-history" aria-selected="false">History</a></li>
      </ul>
    </div>

    <div class="col-12">
      <div class="tab-content border border-top-0 p-3" id="myTabContent">
        <div class="tab-pane fade show active" id="tab-transact" role="tabpanel" aria-labelledby="transact-tab">
          <div class="row">
            <div class="col-md-6 col-lg-4 mb-2">
              <input type="file" class="form-control" id="csvFile" accept=".csv">
            </div>


            <div class="col-lg-4 mb-2">
              <button class="btn btn-primary w-100 d-none" type="button" id="viewBtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Launch static backdrop modal
              </button>
            </div>
            <div class="col-lg-12">
              <p class="text-muted small mb-4">
                Please verify each record carefully before submission. Ensure the Order Number, Order Line ID, Warehouse, Client, and Fulfillment Status are accurate and complete.
                Any discrepancies should be resolved prior to finalizing to maintain audit integrity and operational accuracy.
              </p>
              <div id="preview"></div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tab-pending" role="tabpanel" aria-labelledby="pending-tab"></div>
        <div class="tab-pane fade" id="tab-history" role="tabpanel" aria-labelledby="history-tab"></div>
      </div>
    </div>

  </div>

<script>
  document.getElementById('csvFile').addEventListener('change', function () {
    const file = this.files[0];
    const preview = document.getElementById('preview');

    if (!file || !file.name.toLowerCase().endsWith('.csv')) {
      alert('Please upload a valid CSV file.');
      return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
      const text = e.target.result;

      // Split into rows by line breaks (handle different line endings)
      // Filter out empty lines just in case
      const rows = text.split(/\r\n|\n|\r/).filter(row => row.trim() !== '');

      if (rows.length > 5001) {
        Swal.fire({
          icon: 'error',
          title: 'Too Many Rows',
          text: 'CSV file exceeds maximum allowed 5000 rows. Please upload a smaller file.'
        });
        document.getElementById('csvFile').value = '';
        preview.innerHTML = '';
        return;
      }


      // Show spinner while uploading
      preview.innerHTML = `
        <div class="d-flex justify-content-center py-4">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      `;

      const formData = new FormData();
      formData.append('file', file);

      const startTime = performance.now();

      fetch('csv_upload.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(html => {
        const endTime = performance.now();
        const duration = endTime - startTime;
        const delay = duration < 2000 ? 2000 - duration : 0;

        setTimeout(() => {
          preview.innerHTML = html;

          // Reinitialize Sortable
          document.querySelectorAll('[data-sortable="data-sortable"]').forEach(container => {
            new Sortable(container, {
              animation: 150,
              group: 'shared',
              ghostClass: 'sortable-ghost'
            });
          });

          // Show SweetAlert2 notice
          Swal.fire({
            icon: 'info',
            title: 'Notice',
            html: 'Rows highlighted in <span style="color:red;"><b>red</b></span> are data that the system does not know the unit cost.<br>If you choose to save it, it will be saved only to this module for you to see.',
            confirmButtonText: 'OK'
          });

        }, delay);
      })
      .catch(error => {
        preview.innerHTML = 'Error uploading file.';
        console.error('Upload failed:', error);
      });
    };

    reader.readAsText(file);
  });
</script>

<!-- <div class="card">
<div class="card-body overflow-hidden p-lg-6">
    <div class="row align-items-center">
    <div class="col-lg-6"><img class="img-fluid" src="../assets/img/icons/spot-illustrations/21.png" alt="" /></div>
    <div class="col-lg-6 ps-lg-4 my-5 text-center text-lg-start">
        <h3 class="text-primary">Edit me!</h3>
        <p class="lead">Create Something Beautiful.</p><a class="btn btn-falcon-primary" href="../documentation/getting-started.html">Getting started</a>
    </div>
    </div>
</div>
</div> -->
<div class="card">
  <div class="card-body overflow-hidden py-6 px-0">
<div id="tableExample4" data-list='{"valueNames":["name","supplier","country","email","payment"]}'>
  <div class="row justify-content-end justify-content-end gx-3 gy-0 px-3">
    <div class="col-auto mb-3">
      <button class="btn btn-primary py-0 me-auto" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Create</button>
    </div>
    <!-- <div class="col-sm-auto"><select class="form-select form-select-sm mb-3" data-list-filter="country">
        <option selected="" value="">Select country</option>
        <option value="usa">USA</option>
        <option value="canada">Canada</option>
        <option value="uk">UK</option>
      </select></div> -->
    
    <div class="col-auto col-sm-5 mb-3">
      <form>
        <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
          <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
        </div>
      </form>
    </div>
  </div>
  <div class="table-responsive scrollbar">
    <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
      <thead class="bg-200">
        <tr>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="name">Inbound no.</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="name">P.O no.</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="supplier">Supplier</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="country">Date Received</th>
          <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="email">Received by</th>
        </tr>
      </thead>
      <tbody class="list" id="table-purchase-body">
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1009</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td class="align-middle white-space-nowrap email">Jommy Mateo</td>
          
        </tr>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1008</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td class="align-middle white-space-nowrap email">Michael Jackson</td>
          
        </tr>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1007</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td class="align-middle white-space-nowrap email">Jommy Mateo</td>
          
        </tr>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1006</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td class="align-middle white-space-nowrap email">Jommy Mateo</td>
          
        </tr>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1005</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td class="align-middle white-space-nowrap email">Michael Jackson</td>
          
        </tr>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1004</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td class="align-middle white-space-nowrap email">Michael Jackson</td>
          
        </tr>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1003</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td 800ass="align-middle white-space-nowrap email">Jommy Mateo</td>
          
        </tr>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1002</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td class="align-middle white-space-nowrap email">Jommy Mateo</td>
          
        </tr>
        <tr class="btn-reveal-trigger">
          <th class="align-middle white-space-nowrap inbound"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">800-1009</a></th>
          <th class="align-middle white-space-nowrap name"><a href="../../app/e-commerce/customer-details.html"  type="button" data-bs-toggle="modal" data-bs-target="#pdfModal">PO-1001</a></th>
          <td class="align-middle white-space-nowrap supplier">Supplier</td>
          <td class="align-middle white-space-nowrap country">January 1, 2023</td>
          <td class="align-middle white-space-nowrap email">Michael Jackson</td>
          
        </tr>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>


<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <!-- Embed the PDF using an iframe -->
        <iframe id="pdfViewer" src="" width="100%" height="600px"></iframe>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <!-- <button class="btn btn-primary" type="button">Understood </button> -->
        <a href="../Receive-po/" class="btn btn-primary" type="button">Recieve P.O </a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Select Supplier</h4>
        </div>
        <div class="p-4 pb-0">
          <form action="../create-inbound/index.php" method="POST">
          <div class="row">
            <div class="col-lg-12 mb-3">
              <label class="col-form-label" for="recipient-name">Supplier:</label>
              <select class="form-select js-choice" id="ItemDestination" size="1" required="required" name="ItemDestination" data-options='{"removeItemButton":true,"placeholder":true}'>
                <option value="">Select item destination...</option>
                <option>Shelf A</option>
                <option>Shelf B</option>
                <option>Shelf C</option>
                <option>Shelf D</option>
                <option>Shelf E</option>
                <option>Shelf F</option>
              </select>
              <div class="invalid-feedback">Please select one</div>
            </div>

            <div class="col-lg-5 mb-3">
              <label for="">Sales Invoice</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-lg-3 mb-3">
              <label for="">P.O no</label>
              <input type="text" class="form-control">
            </div>

            <div class="col-lg-4 mb-3">
              <label class="form-label" for="datepicker">Received Date</label>
              <input class="form-control datetimepicker" id="datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' />
            </div>
            
            <div class="col-lg-12 mb-3">
              <label class="col-form-label" for="recipient-name">Warehouse:</label>
              <select class="form-select js-choice" id="ItemDestination" size="1" required="required" name="ItemDestination" data-options='{"removeItemButton":true,"placeholder":true}'>
                <option value="">Select item destination...</option>
                <option>Shelf A</option>
                <option>Shelf B</option>
                <option>Shelf C</option>
                <option>Shelf D</option>
                <option>Shelf E</option>
                <option>Shelf F</option>
              </select>
              <div class="invalid-feedback">Please select one</div>
            </div>
            
            <div class="col-lg-7 mb-3">
              <label class="col-form-label" for="message-text">Driver:</label>
              <input type="text" class="form-control" placeholder="Enter Driver name">
            </div>
            <div class="col-lg-5 mb-3">
              <label  class="col-form-label" for="">Plate no.</label>
              <input type="text" class="form-control" placeholder="Enter Plate no.">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Next</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Script to load the PDF dynamically -->
<script>
    var pdfModal = document.getElementById('pdfModal');
    pdfModal.addEventListener('show.bs.modal', function (event) {
        // Set the PDF URL when the modal is shown
        var pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = "../../HIRC-OFFICIAL-PRICELIST-DEALER (1).pdf";  // Change this to your PDF file path
    });

    pdfModal.addEventListener('hidden.bs.modal', function (event) {
        // Clear the PDF URL when the modal is hidden
        var pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = "";
    });
</script>
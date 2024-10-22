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
    <div class="card-body overflow-hidden py-6 px-2">
      <h5>SELECT PRODUCTS</h5>
    <div class="card shadow-none">
  <div class="card-body p-0 pb-3"  data-list='{"valueNames":["desc","barcode","brand","cat","qty","trans"]}'>
    <div class="d-flex align-items-center justify-content-end my-3">
      <div id="bulk-select-replace-element"><button class="btn btn-falcon-success btn-sm" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">New</span></button></div>
      <div class="d-none ms-3" id="bulk-select-actions">
        <div class="d-flex"><select class="form-select form-select-sm" aria-label="Bulk actions">
            <option selected="selected">Bulk actions</option>
            <option value="Delete">Delete</option>
            <option value="Archive">Archive</option>
          </select>
          <!-- <button class="btn btn-falcon-danger btn-sm ms-2" type="button">Apply</button> -->
          <a href="../Supplier-selection/" class="btn btn-falcon-danger btn-sm ms-2">Apply</a>
        </div>
      </div>
    </div>
    <div class="table-responsive scrollbar">
      <table class="table mb-0">
        <thead class="bg-200">
          <tr>
            <th class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" id="bulk-select-example" type="checkbox" data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' /></div>
            </th>
            <th width="50"></th>
            <th class="text-black dark__text-white align-middle sort" data-sort="desc">Description</th>
            <th class="text-black dark__text-white align-middle sort" data-sort="desc">Parent Barcode</th>
            <th class="text-black dark__text-white align-middle sort" data-sort="barcode">Brand </th>
            <th class="text-black dark__text-white align-middle sort" data-sort="cat">Category</th>
            <th class="text-black dark__text-white align-middle white-space-nowrap pe-3 sort" data-sort="qty">Quantity</th>
            <th class="text-black dark__text-white align-middle text-end pe-3 sort" data-sort="trans">Transactions</th>
          </tr>
        </thead>
        <tbody id="bulk-select-body" class="list">
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="checkbox-1" data-bulk-select-row="{&quot;id&quot;:1,&quot;name&quot;:&quot;Kit Harington&quot;,&quot;nationality&quot;:&quot;British&quot;,&quot;gender&quot;:&quot;Male&quot;,&quot;age&quot;:32}" /></div>
            </td>
            <td>
                <img src="../../assets/img/def_img.png" alt="" height="50">
            </td>
            <th class="align-middle desc">Laptop Charger 1</th>
            <th class="align-middle barcode">490000891</th>
            <td class="align-middle brand">British</td>
            <td class="align-middle cat">Male</td>
            <td class="align-middle white-space-nowrap text-end pe-3 qty">32</td>
            <td class="align-middle text-end pe-3 trans">20</td>
          </tr>
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="checkbox-2" data-bulk-select-row="{&quot;id&quot;:2,&quot;name&quot;:&quot;Emilia Clarke&quot;,&quot;nationality&quot;:&quot;British&quot;,&quot;gender&quot;:&quot;Female&quot;,&quot;age&quot;:32}" /></div>
            </td>
            <td>
                <img src="../../assets/img/def_img.png" alt="" height="50">
            </td>
            <th class="align-middle desc">Laptop Charger 2</th>
            <th class="align-middle barcode">490000895</th>
            <td class="align-middle brand">MSI</td>
            <td class="align-middle cat">Female</td>
            <td class="align-middle white-space-nowrap text-end pe-3 qty">32</td>
            <td class="align-middle text-end pe-3 trans">14</td>
          </tr>
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="checkbox-3" data-bulk-select-row="{&quot;id&quot;:3,&quot;name&quot;:&quot;Peter Dinklage&quot;,&quot;nationality&quot;:&quot;American&quot;,&quot;gender&quot;:&quot;Male&quot;,&quot;age&quot;:49}" /></div>
            </td>
            <td>
                <img src="../../assets/img/def_img.png" alt="" height="50">
            </td>
            <th class="align-middle desc">Laptop Charger 3</th>
            <th class="align-middle barcode">490000896</th>
            <td class="align-middle brand">MSI</td>
            <td class="align-middle cat">Male</td>
            <td class="align-middle white-space-nowrap text-end pe-3 qty">49</td>
            <td class="align-middle text-end pe-3 trans">15</td>
          </tr>
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="checkbox-4" data-bulk-select-row="{&quot;id&quot;:4,&quot;name&quot;:&quot;Sean Bean&quot;,&quot;nationality&quot;:&quot;British&quot;,&quot;gender&quot;:&quot;Male&quot;,&quot;age&quot;:59}" /></div>
            </td>
            <td>
                <img src="../../assets/img/def_img.png" alt="" height="50">
            </td>
            <th class="align-middle desc">Laptop Charger 4</th>
            <th class="align-middle barcode">490000897</th>
            <td class="align-middle brand">Acer</td>
            <td class="align-middle cat">Male</td>
            <td class="align-middle white-space-nowrap text-end pe-3 qty">59</td>
            <td class="align-middle text-end pe-3 trans">30</td>
          </tr>
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="checkbox-5" data-bulk-select-row="{&quot;id&quot;:5,&quot;name&quot;:&quot;Maisie Williams&quot;,&quot;nationality&quot;:&quot;British&quot;,&quot;gender&quot;:&quot;Female&quot;,&quot;age&quot;:21}" /></div>
            </td>
            <td>
                <img src="../../assets/img/def_img.png" alt="" height="50">
            </td>
            <th class="align-middle desc">Laptop Charger 5</th>
            <th class="align-middle barcode">490000898</th>
            <td class="align-middle brand">Acer</td>
            <td class="align-middle cat">Female</td>
            <td class="align-middle white-space-nowrap text-end pe-3 qty">21</td>
            <td class="align-middle text-end pe-3 trans">26</td>
          </tr>
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="form-check mb-0"><input class="form-check-input" type="checkbox" id="checkbox-6" data-bulk-select-row="{&quot;id&quot;:6,&quot;name&quot;:&quot;Sophie Turner&quot;,&quot;nationality&quot;:&quot;British&quot;,&quot;gender&quot;:&quot;Female&quot;,&quot;age&quot;:23}" /></div>
            </td>
            <td>
                <img src="../../assets/img/def_img.png" alt="" height="50">
            </td>
            <th class="align-middle desc">Laptop Charger 6</th>
            <th class="align-middle barcode">490000899</th>
            <td class="align-middle brand">Acer</td>
            <td class="align-middle cat">Female</td>
            <td class="align-middle white-space-nowrap text-end pe-3 qty">23</td>
            <td class="align-middle text-end pe-3 trans">70</td>
          </tr>
        </tbody>
      </table>
      <p class="mt-3 mb-2 d-none">Click the button to get selected rows</p><button class="btn btn-warning d-none" data-selected-rows="data-selected-rows">Get Selected Rows</button><pre id="selectedRows"></pre>
    </div>
  </div>
</div>
    </div>
</div>
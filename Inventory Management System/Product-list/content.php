<div class="row"  id="tableExample4" data-list='{"valueNames":["desc","cat","brand","barcode","by", "date"]}'>
    <div class="col-lg-12">
      <h4>Product list</h4>
    </div>
    <div class="col-lg-12 text-end px-3">
      <a href="../create-po/" class="btn btn-primary py-0 me-auto">Create</a>
    </div>
    <div class="col-lg-12 py-3">
        <div class="row justify-content-end justify-content-end gx-3 gy-0 px-3">
        <div class="col-auto mb-3">
      <!-- <button class="btn btn-primary py-0 me-auto">Create</button> -->
      
    </div>
    <div class="col-sm-auto"><select class="form-select form-select-sm mb-3" data-list-filter="cat">
        <option selected="" value="">Select category</option>
        <option value="usa">USA</option>
        <option value="canada">Canada</option>
        <option value="uk">UK</option>
      </select></div>
    <div class="col-sm-auto"><select class="form-select form-select-sm mb-3" data-list-filter="brand">
        <option selected="" value="">Select brand</option>
        <option value="Pending">Pending</option>
        <option value="Success">Received</option>
        <option value="Blocked">Sent to Supplier</option>
      </select></div>
    <div class="col-auto col-sm-5 mb-3">
      <form>
        <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
          <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
        </div>
      </form>
    </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body overflow-hidden">
                <div class="table-responsive">
                  <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
                    <thead class="bg-200">
                      <tr>
                        <th style="width: 10px;"></th>
                        <th data-sort="desc"><small>Description</small></th>
                        <th data-sort="cat"><small>Category</small></th>
                        <th data-sort="brand"><small>Brand</small></th>
                        <th data-sort="barcode"><small>Parent Barcode</small></th>
                        <th data-sort="by"><small>Created by</small></th>
                        <th data-sort="date"><small>Date</small></th>
                        <th style="width:30px;"></th>
                      </tr>
                    </thead>
                    <tbody class="list" id="table-purchase-body">
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Laptop Charger 1</small></td>
                        <td class="cat"><small>Charger</small></td>
                        <td class="brand"><small>Acer</small></td>
                        <td class="barcode"><small>4900891</small></td>
                        <td class="by"><small>Juan Dela Cruz</small></td>
                        <td class="date"><small>January 1, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Gaming Laptop 17.3”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Asus</small></td>
                        <td class="barcode"><small>4900892</small></td>
                        <td class="by"><small>John Doe</small></td>
                        <td class="date"><small>January 2, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Ultrabook 13.3” Slim</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Dell</small></td>
                        <td class="barcode"><small>4900893</small></td>
                        <td class="by"><small>Jane Smith</small></td>
                        <td class="date"><small>January 3, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Convertible Laptop 14”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>HP</small></td>
                        <td class="barcode"><small>4900894</small></td>
                        <td class="by"><small>Mark Evans</small></td>
                        <td class="date"><small>January 4, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Laptop Stand Aluminum</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Logitech</small></td>
                        <td class="barcode"><small>4900895</small></td>
                        <td class="by"><small>Mary Johnson</small></td>
                        <td class="date"><small>January 5, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>USB-C Hub 7-in-1</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Anker</small></td>
                        <td class="barcode"><small>4900896</small></td>
                        <td class="by"><small>Chris Brown</small></td>
                        <td class="date"><small>January 6, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Business Laptop 15.6”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Lenovo</small></td>
                        <td class="barcode"><small>4900897</small></td>
                        <td class="by"><small>Susan Lee</small></td>
                        <td class="date"><small>January 7, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Gaming Mouse RGB</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Razer</small></td>
                        <td class="barcode"><small>4900898</small></td>
                        <td class="by"><small>James Clark</small></td>
                        <td class="date"><small>January 8, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Portable External SSD 1TB</small></td>
                        <td class="cat"><small>Storage</small></td>
                        <td class="brand"><small>Samsung</small></td>
                        <td class="barcode"><small>4900899</small></td>
                        <td class="by"><small>Anna Davis</small></td>
                        <td class="date"><small>January 9, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Laptop Cooling Pad 15”</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Corsair</small></td>
                        <td class="barcode"><small>4900900</small></td>
                        <td class="by"><small>John Harris</small></td>
                        <td class="date"><small>January 10, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Touchscreen Laptop 14”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Microsoft</small></td>
                        <td class="barcode"><small>4900901</small></td>
                        <td class="by"><small>Lisa Martin</small></td>
                        <td class="date"><small>January 11, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Business Laptop Dock</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Dell</small></td>
                        <td class="barcode"><small>4900902</small></td>
                        <td class="by"><small>David Young</small></td>
                        <td class="date"><small>January 12, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Lightweight Laptop 13.5”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Asus</small></td>
                        <td class="barcode"><small>4900903</small></td>
                        <td class="by"><small>Karen White</small></td>
                        <td class="date"><small>January 13, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>USB-A to USB-C Adapter</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Satechi</small></td>
                        <td class="barcode"><small>4900904</small></td>
                        <td class="by"><small>John Walker</small></td>
                        <td class="date"><small>January 14, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Portable Monitor 15.6”</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>AOC</small></td>
                        <td class="barcode"><small>4900905</small></td>
                        <td class="by"><small>Mike Lewis</small></td>
                        <td class="date"><small>January 15, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Thin & Light Laptop 14”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>HP</small></td>
                        <td class="barcode"><small>4900906</small></td>
                        <td class="by"><small>Sarah Adams</small></td>
                        <td class="date"><small>January 16, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Compact Mechanical Keyboard</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Keychron</small></td>
                        <td class="barcode"><small>4900907</small></td>
                        <td class="by"><small>John Perez</small></td>
                        <td class="date"><small>January 17, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Business Laptop 14”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Lenovo</small></td>
                        <td class="barcode"><small>4900908</small></td>
                        <td class="by"><small>Mary Hernandez</small></td>
                        <td class="date"><small>January 18, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Gaming Laptop 15.6”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>MSI</small></td>
                        <td class="barcode"><small>4900909</small></td>
                        <td class="by"><small>James Robinson</small></td>
                        <td class="date"><small>January 19, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>External Hard Drive 2TB</small></td>
                        <td class="cat"><small>Storage</small></td>
                        <td class="brand"><small>WD</small></td>
                        <td class="barcode"><small>4900910</small></td>
                        <td class="by"><small>Mike Thompson</small></td>
                        <td class="date"><small>January 20, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>High-Performance Laptop 15”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Dell</small></td>
                        <td class="barcode"><small>4900911</small></td>
                        <td class="by"><small>Jane Lee</small></td>
                        <td class="date"><small>January 21, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>USB-C to HDMI Adapter</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Belkin</small></td>
                        <td class="barcode"><small>4900912</small></td>
                        <td class="by"><small>Paul King</small></td>
                        <td class="date"><small>January 22, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Gaming Headset 7.1 Surround</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>SteelSeries</small></td>
                        <td class="barcode"><small>4900913</small></td>
                        <td class="by"><small>Chris Wilson</small></td>
                        <td class="date"><small>January 23, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Professional Laptop 13.3”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Apple</small></td>
                        <td class="barcode"><small>4900914</small></td>
                        <td class="by"><small>John Taylor</small></td>
                        <td class="date"><small>January 24, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Convertible Laptop 15”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Lenovo</small></td>
                        <td class="barcode"><small>4900915</small></td>
                        <td class="by"><small>Emily Johnson</small></td>
                        <td class="date"><small>January 25, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Wireless Laptop Mouse</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Logitech</small></td>
                        <td class="barcode"><small>4900916</small></td>
                        <td class="by"><small>David Brown</small></td>
                        <td class="date"><small>January 26, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Ultraportable Laptop 13”</small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>HP</small></td>
                        <td class="barcode"><small>4900917</small></td>
                        <td class="by"><small>Susan Martinez</small></td>
                        <td class="date"><small>January 27, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                      <tr>
                        <td class="p-0 m-0" style="height:10px;">
                            <img class="img img-fluid m-0" src="../../assets/img/def_img.png" alt="" height="10">
                        </td>
                        <td class="desc"><small>Gaming Laptop Cooling Stand</small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Cooler Master</small></td>
                        <td class="barcode"><small>4900918</small></td>
                        <td class="by"><small>Michael Garcia</small></td>
                        <td class="date"><small>January 28, 2024</small></td>
                        <td><button class="btn btn-info py-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit product information"><span class="far fa-edit m-0 p-0"></span></button></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
    </div>
</div>
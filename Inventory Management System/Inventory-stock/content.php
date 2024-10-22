<div class="row"  id="tableExample4" data-list='{"valueNames":["desc","loc","cat","brand","barcode","by", "date"]}'>
    <div class="col-lg-12">
      <h4><b><i>#Warehouse 1</i></b> Stocks</h4>
    </div>
    <div class="col-lg-12 text-end px-3">
      <div class="btn-group">
        <button class="btn dropdown-toggle mb-2 btn-primary" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Warehouse</button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Warehouse 1</a>
          <a class="dropdown-item" href="#">Warehouse 2</a>
          <a class="dropdown-item" href="#">Warehouse 3</a>
        </div>
      </div>
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
                        <th data-sort="desc"><small>Description</small></th>
                        <th data-sort="cat"><small>Category</small></th>
                        <th data-sort="brand"><small>Brand</small></th>
                        <th data-sort="barcode"><small>Parent Barcode</small></th>
                        <th data-sort="loc">Batch</th>
                        <th data-sort="by"><small>Created by</small></th>
                        <th data-sort="date"><small>Date</small></th>
                      </tr>
                    </thead>
                    <tbody class="list" id="table-purchase-body">
                      <tr>
                        <td class="desc"><small><a href="#exampleModalToggle" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle">Laptop Charger 1</a></small></td>
                        <td class="cat"><small>Charger</small></td>
                        <td class="brand"><small>Acer</small></td>
                        <td class="barcode"><small>4900891</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Juan Dela Cruz</small></td>
                        <td class="date"><small>January 1, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Gaming Laptop 17.3”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Asus</small></td>
                        <td class="barcode"><small>4900892</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>John Doe</small></td>
                        <td class="date"><small>January 2, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Ultrabook 13.3” Slim</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Dell</small></td>
                        <td class="barcode"><small>4900893</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Jane Smith</small></td>
                        <td class="date"><small>January 3, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Convertible Laptop 14”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>HP</small></td>
                        <td class="barcode"><small>4900894</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Mark Evans</small></td>
                        <td class="date"><small>January 4, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Laptop Stand Aluminum</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Logitech</small></td>
                        <td class="barcode"><small>4900895</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Mary Johnson</small></td>
                        <td class="date"><small>January 5, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">USB-C Hub 7-in-1</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Anker</small></td>
                        <td class="barcode"><small>4900896</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Chris Brown</small></td>
                        <td class="date"><small>January 6, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Business Laptop 15.6”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Lenovo</small></td>
                        <td class="barcode"><small>4900897</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Susan Lee</small></td>
                        <td class="date"><small>January 7, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Gaming Mouse RGB</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Razer</small></td>
                        <td class="barcode"><small>4900898</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>James Clark</small></td>
                        <td class="date"><small>January 8, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Portable External SSD 1TB</a></small></td>
                        <td class="cat"><small>Storage</small></td>
                        <td class="brand"><small>Samsung</small></td>
                        <td class="barcode"><small>4900899</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Anna Davis</small></td>
                        <td class="date"><small>January 9, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Laptop Cooling Pad 15”</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Corsair</small></td>
                        <td class="barcode"><small>4900900</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>John Harris</small></td>
                        <td class="date"><small>January 10, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Touchscreen Laptop 14”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Microsoft</small></td>
                        <td class="barcode"><small>4900901</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Lisa Martin</small></td>
                        <td class="date"><small>January 11, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Business Laptop Dock</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Dell</small></td>
                        <td class="barcode"><small>4900902</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>David Young</small></td>
                        <td class="date"><small>January 12, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Lightweight Laptop 13.5”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Asus</small></td>
                        <td class="barcode"><small>4900903</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Karen White</small></td>
                        <td class="date"><small>January 13, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">USB-A to USB-C Adapter</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Satechi</small></td>
                        <td class="barcode"><small>4900904</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>John Walker</small></td>
                        <td class="date"><small>January 14, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Portable Monitor 15.6”</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>AOC</small></td>
                        <td class="barcode"><small>4900905</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Mike Lewis</small></td>
                        <td class="date"><small>January 15, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Thin & Light Laptop 14”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>HP</small></td>
                        <td class="barcode"><small>4900906</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Sarah Adams</small></td>
                        <td class="date"><small>January 16, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Compact Mechanical Keyboard</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Keychron</small></td>
                        <td class="barcode"><small>4900907</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>John Perez</small></td>
                        <td class="date"><small>January 17, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Business Laptop 14”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Lenovo</small></td>
                        <td class="barcode"><small>4900908</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Mary Hernandez</small></td>
                        <td class="date"><small>January 18, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Gaming Laptop 15.6”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>MSI</small></td>
                        <td class="barcode"><small>4900909</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>James Robinson</small></td>
                        <td class="date"><small>January 19, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">External Hard Drive 2TB</a></small></td>
                        <td class="cat"><small>Storage</small></td>
                        <td class="brand"><small>WD</small></td>
                        <td class="barcode"><small>4900910</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Mike Thompson</small></td>
                        <td class="date"><small>January 20, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">High-Performance Laptop 15”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Dell</small></td>
                        <td class="barcode"><small>4900911</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Jane Lee</small></td>
                        <td class="date"><small>January 21, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">USB-C to HDMI Adapter</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Belkin</small></td>
                        <td class="barcode"><small>4900912</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Paul King</small></td>
                        <td class="date"><small>January 22, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Gaming Headset 7.1 Surround</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>SteelSeries</small></td>
                        <td class="barcode"><small>4900913</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Chris Wilson</small></td>
                        <td class="date"><small>January 23, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Professional Laptop 13.3”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Apple</small></td>
                        <td class="barcode"><small>4900914</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>John Taylor</small></td>
                        <td class="date"><small>January 24, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Convertible Laptop 15”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>Lenovo</small></td>
                        <td class="barcode"><small>4900915</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Emily Johnson</small></td>
                        <td class="date"><small>January 25, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Wireless Laptop Mouse</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Logitech</small></td>
                        <td class="barcode"><small>4900916</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>David Brown</small></td>
                        <td class="date"><small>January 26, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Ultraportable Laptop 13”</a></small></td>
                        <td class="cat"><small>Laptop</small></td>
                        <td class="brand"><small>HP</small></td>
                        <td class="barcode"><small>4900917</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Susan Martinez</small></td>
                        <td class="date"><small>January 27, 2024</small></td>
                      </tr>
                      <tr>
                        <td class="desc"><small><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">Gaming Laptop Cooling Stand</a></small></td>
                        <td class="cat"><small>Accessory</small></td>
                        <td class="brand"><small>Cooler Master</small></td>
                        <td class="barcode"><small>4900918</small></td>
                        <td class="loc">2</td>
                        <td class="by"><small>Michael Garcia</small></td>
                        <td class="date"><small>January 28, 2024</small></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Select Batch</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th><small>Batch Code</small></th>
                <th><small>Quantity</small></th>
                <th><small>By</small></th>
                <th><small>Date</small></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><small>10059</small></td>
                <td><small>4</small></td>
                <td><small>Juan Dela Cruz</small></td>
                <td><small>January 1, 2024</small></td>
                <td><small><button class="btn btn-info py-0" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"><span class="far fa-eye"></span></button></small></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Select Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="bg-200">
              <tr>
                <th><small>Barcode</small></th>
                <th><small>Item Location</small></th>
                <th><small>Price</small></th>
                <th><small></small></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><small>490001-1</small></td>
                <td><small>Shelf A</small></td>
                <td><small>100.00</small></td>
                <td><small><button class="btn btn-info py-0" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal"><span class="far fa-eye"></span></button></small></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">HIstory of Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="card">
            <div class="card-header bg-body-tertiary">
              <h5 class="mb-0" data-anchor="data-anchor">HIstory of Laptop Charger 1</h5>
            </div>
            <div class="card-body px-sm-4 px-md-8 px-lg-6 px-xxl-8">
              <div class="timeline-zigzag">
                <div class="row timeline-item timeline-item-end">
                  <div class="col-lg-6 timeline-item-content"><span class="bullet"></span>
                    <div class="row g-0 mt-n4">
                      <div class="col timeline-item-text" style="min-height: 250px;">
                        <h3 class="text-primary mt-4 mt-sm-0">2000</h3>
                        <h6 class="mt-2 mb-1 mt-sm-3">1 Ghz pentium and athlon</h6>
                        <p class="fs-10">AMD and intel release chips clocked at 1 GHz. Sony releases the play station 2.</p>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="row timeline-item timeline-item-start">
                  <div class="col-lg-6 timeline-item-content" style="min-height: 250px;"><span class="bullet"></span>
                    <div class="row g-0 mt-n4">
                      <div class="col timeline-item-text">
                        <h3 class="text-primary mt-4 mt-sm-0">2001</h3>
                        <h6 class="mt-2 mb-1 mt-sm-3">Mac OS X/ windows XP</h6>
                        <p class="fs-10">New version of the three major operation systems are released.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row timeline-item timeline-item-end">
                  <div class="col-lg-6 timeline-item-content" style="min-height: 250px;"><span class="bullet"></span>
                    <div class="row g-0 mt-n4">
                      <div class="col timeline-item-text">
                        <h3 class="text-primary mt-4 mt-sm-0">2006</h3>
                        <h6 class="mt-2 mb-1 mt-sm-3">Macbook pro/Intel core 2/wifi</h6>
                        <p class="fs-10">The Macbook pro, their first dual-core intel based mobile computer. Sony and Nintendo release the PS3 and will respectively.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row timeline-item timeline-item-start">
                  <div class="col-lg-6 timeline-item-content" style="min-height: 250px;"><span class="bullet"></span>
                    <div class="row g-0 mt-n4">
                      <div class="col timeline-item-text">
                        <h3 class="text-primary mt-4 mt-sm-0">2007</h3>
                        <h6 class="mt-2 mb-1 mt-sm-3">Iphone/ASUS Eee pc</h6>
                        <p class="fs-10">The first iphone was introduces by Apple. The first ASUS Eee introduces the netbook category of laptops</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row timeline-item timeline-item-end">
                  <div class="col-lg-6 timeline-item-content" style="min-height: 250px;"><span class="bullet"></span>
                    <div class="row g-0 mt-n4">
                      <div class="col timeline-item-text">
                        <h3 class="text-primary mt-4 mt-sm-0">2008</h3>
                        <h6 class="mt-2 mb-1 mt-sm-3">HTC Dream/Google android</h6>
                        <p class="fs-10">The HTC Dream is released- the first commercially available phone to run the newly released android operating system by google.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row timeline-item timeline-item-start">
                  <div class="col-lg-6 timeline-item-content" style="min-height: 250px;"><span class="bullet"></span>
                    <div class="row g-0 mt-n4">
                      <div class="col timeline-item-text">
                        <h3 class="text-primary mt-4 mt-sm-0">2010</h3>
                        <h6 class="mt-2 mb-1 mt-sm-3">Ipad</h6>
                        <p class="fs-10">Apple released the ipad, a tablet computer that bridges the gap between smartphones and laptops.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row timeline-item timeline-item-end">
                  <div class="col-lg-6 timeline-item-content"><span class="bullet"></span>
                    <div class="row g-0 mt-n4">
                      <div class="col timeline-item-text" style="min-height: 250px;">
                        <h3 class="text-primary mt-4 mt-sm-0">2000</h3>
                        <h6 class="mt-2 mb-1 mt-sm-3">1 Ghz pentium and athlon</h6>
                        <p class="fs-10">AMD and intel release chips clocked at 1 GHz. Sony releases the play station 2.</p>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
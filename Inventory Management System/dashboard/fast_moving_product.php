<div class="card h-lg-100 overflow-hidden">
  <div class="card-body p-0">
    <div id="dashboard-wh-preview"></div>
  </div>

  <!-- Card Footer -->
  <div class="card-footer bg-body-tertiary py-2">
    <div class="row flex-between-center">
      <div class="col-auto">
        <select class="form-select form-select-sm" id="dashboard-wh">
          <?php echo implode("\n", $warehouse_options2); ?>
        </select>
      </div>
    </div>
  </div>
</div>

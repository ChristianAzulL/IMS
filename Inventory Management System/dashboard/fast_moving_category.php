<div class="card h-100">
  <?php 
  $data = []; // Will store ['category_name' => ..., 'outbounded' => ...]

  $fast_moving_category_sql = "SELECT * FROM category";
  $fast_moving_category_res = $conn->query($fast_moving_category_sql);

  if($fast_moving_category_res->num_rows > 0){
    while($row = $fast_moving_category_res->fetch_assoc()){
      $category_name = $row['category_name'];
      $category_id = $row['hashed_id'];
      $outbounded = 0;
      if(empty($dashboard_wh)){
        $outbound_check_sql = "
          SELECT COUNT(oc.unique_barcode) AS total_outbound
          FROM outbound_content oc
          LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
          LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode
          LEFT JOIN product p ON p.hashed_id = s.product_id
          WHERE oc.status = 0 
            AND p.category = '$category_id' 
            AND (s.batch_code IS NOT NULL AND s.batch_code != '-')
            AND ol.date_sent >= DATE_FORMAT(NOW(), '%Y-%m-01')
            AND ol.date_sent < DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH)
            AND ol.warehouse IN ($imploded_warehouse_ids)
        ";
      } else {
        $outbound_check_sql = "
          SELECT COUNT(oc.unique_barcode) AS total_outbound
          FROM outbound_content oc
          LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
          LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode
          LEFT JOIN product p ON p.hashed_id = s.product_id
          WHERE oc.status = 0 
            AND p.category = '$category_id' 
            AND (s.batch_code IS NOT NULL AND s.batch_code != '-')
            AND ol.date_sent >= DATE_FORMAT(NOW(), '%Y-%m-01')
            AND ol.date_sent < DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH)
            AND ol.warehouse = '$dashboard_wh'
        ";
      }

      $outbound_check_res = $conn->query($outbound_check_sql);

      if($outbound_check_res && $outbound_check_res->num_rows > 0){
        $outbound_row = $outbound_check_res->fetch_assoc();
        $outbounded = $outbound_row['total_outbound'];
      }

      $data[] = [
        'category_name' => $category_name,
        'outbounded' => $outbounded
      ];
    }
  }

  // Top 10 Fast Moving (highest outbound first)
  $fast_moving = $data;
  usort($fast_moving, function($a, $b) {
    return $b['outbounded'] - $a['outbounded'];
  });
  $top_10_fast = array_slice($fast_moving, 0, 10);

  // Top 10 Slow Moving (lowest outbound first)
  $slow_moving = $data;
  usort($slow_moving, function($a, $b) {
    return $a['outbounded'] - $b['outbounded'];
  });
  $top_10_slow = array_slice($slow_moving, 0, 10);
  ?>

  <div class="card-body">
    <div class="row flex-between-center g-0">
        <div class="col-auto mb-3">
            <h6 class="mb-0">Top 10 Fast Moving (Category)</h6>
        </div>
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table table-hover fs-10">
              <thead>
                <tr>
                  <th>Category</th>
                  <th class="text-end">Outbounded</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($top_10_fast as $row): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                    <td class="text-end"><?php echo number_format($row['outbounded']); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>

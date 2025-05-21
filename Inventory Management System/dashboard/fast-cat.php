<?php 
include "../config/database.php";
include "../config/on_session.php";

// Determine the time of day
$hour = date("H"); // Get the current hour in 24-hour format

if ($hour >= 5 && $hour < 12) {
    $time_name = "Morning";
} elseif ($hour >= 12 && $hour < 17) {
    $time_name = "Afternoon";
} elseif ($hour >= 17 && $hour < 21) {
    $time_name = "Evening";
} else {
    $time_name = "Midnight";
}


$quoted_warehouse_ids = array_map(function ($id) {
    return "'" . trim($id) . "'";
}, $user_warehouse_ids);

// Create a comma-separated string of quoted IDs
$imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);
$dashboard_wh = $_GET['wh'];
?>
<div class="card h-100">
  <?php 
  $data = [];

  $whereWarehouse = "";
  if (empty($dashboard_wh)) {
      $whereWarehouse = "AND ol.warehouse IN ($imploded_warehouse_ids)";
  } else {
      $dashboard_wh = $conn->real_escape_string($dashboard_wh);
      $whereWarehouse = "AND ol.warehouse = '$dashboard_wh'";
  }

  $sql = "
    SELECT 
      c.category_name,
      p.category AS category_id,
      COUNT(DISTINCT oc.unique_barcode) AS total_outbound
    FROM category c
    LEFT JOIN product p ON p.category = c.hashed_id
    LEFT JOIN stocks s ON s.product_id = p.hashed_id
    LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode AND oc.status IN (0, 6)
    LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
    WHERE ol.date_sent >= DATE_FORMAT(NOW(), '%Y-%m-01')
      AND ol.date_sent < DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-01'), INTERVAL 1 MONTH)
      $whereWarehouse
    GROUP BY p.category
  ";

  $res = $conn->query($sql);

  if ($res && $res->num_rows > 0) {
      while ($row = $res->fetch_assoc()) {
          $data[] = [
              'category_name' => $row['category_name'],
              'outbounded' => $row['total_outbound']
          ];
      }
  }

  // Sort and get top 10
  usort($data, function($a, $b) {
      return $b['outbounded'] - $a['outbounded'];
  });
  $top_10_fast = array_slice($data, 0, 10);
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
                    <td><a href="../Category-Product/?type=fast&&cat=<?php echo htmlspecialchars($row['category_name']); ?>&&wh=<?php echo $dashboard_wh;?>"><?php echo htmlspecialchars($row['category_name']); ?></a></td>
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

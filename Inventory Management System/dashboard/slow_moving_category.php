<div class="card h-100">
  <div class="card-body">
    <div class="row flex-between-center g-0">
        <div class="col-auto mb-3">
            <h6 class="mb-0">Top 10 Slow Moving (Category)</h6>
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
                <?php foreach($top_10_slow as $row): ?>
                  <tr>
                    <td><a href="../Category-Product/?type=slow&&cat=<?php echo htmlspecialchars($row['category_name']); ?>"><?php echo htmlspecialchars($row['category_name']); ?></a></td>
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

<?php
session_start();

// Check if session variable exists
if (!isset($_SESSION['stored_data']) || empty($_SESSION['stored_data'])) {
    echo "<p>No data stored in session.</p>";
    exit;
}
?>

<div class="table-responsive scrollbar">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th style="min-width: 175px;">Unique Barcode</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['stored_data'] as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['unique_barcode']) ?></td>
                    <td><?= htmlspecialchars($item['description']) ?></td>
                    <td><?= htmlspecialchars($item['brand_name']) ?></td>
                    <td><?= htmlspecialchars($item['category_name']) ?></td>
                    <td>
                        <button class="btn btn-danger btn-sm delete-session-item" data-barcode="<?= htmlspecialchars($item['unique_barcode']) ?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


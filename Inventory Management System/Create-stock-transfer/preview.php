<?php
session_start(); // Ensure session is started

// Retrieve and decode the scanned items from the session
$existingData = isset($_SESSION['scanned_item']) ? json_decode($_SESSION['scanned_item'], true) : [];

// Check if data exists and is an array
if (!is_array($existingData)) {
    $existingData = []; // Default to an empty array if decoding failed
}

// Group items by parent_barcode and count the quantity for each group
$groupedData = [];

foreach ($existingData as $item) {
    if (is_array($item) && isset($item['parent_barcode'])) {
        $parentBarcode = $item['parent_barcode'];

        // If this parent_barcode has not been grouped yet, initialize it
        if (!isset($groupedData[$parentBarcode])) {
            $groupedData[$parentBarcode] = [
                'item' => $item,  // Store the first item in this group
                'quantity' => 0    // Initialize quantity count
            ];
        }

        // Increment quantity for the current parent_barcode group
        $groupedData[$parentBarcode]['quantity']++;
    }
}

// If no items were found or grouped, show a message and exit
if (empty($groupedData)) {
?>
<table class="table table-bordered bordered-table table-sm table-stripe">
        <thead class="table-info">
            <tr>
                <th>Parent Barcode</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Category</th>
                <th class="text-end">Quantity</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td class="text-center p-6 fs-3" colspan="5"><b>NO BARCODE WERE SCANNED YET!</b></td>
                </tr>
        </tbody>
    </table>
<?php
    exit;
}
?>


<?php if (!empty($groupedData)): ?>
    <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
        <thead class="table-info">
            <tr>
                <th>Parent Barcode</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Category</th>
                <th class="text-end">Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupedData as $parentBarcode => $group): ?>
                <tr>
                    <td><?php echo htmlspecialchars($parentBarcode); ?></td>
                    <td><?php echo htmlspecialchars($group['item']['description'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($group['item']['brand_name'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($group['item']['category_name'] ?? 'N/A'); ?></td>
                    <td class="text-end"><?php echo $group['quantity']; ?></td> <!-- Display quantity -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
<?php endif; ?>
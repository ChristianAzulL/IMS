<?php
// File name
$filename = "product_data.csv";

// Open file for writing
$file = fopen($filename, "w");

// CSV headers
$headers = ["description", "keyword", "qty", "price", "supplier", "barcode", "batch code", "brand", "category", "safety"];
fputcsv($file, $headers);

// Sample data options
$descriptions = ["Red Widget", "Blue Gadget", "Green Tool", "Yellow Device", "Purple Item"];
$keywords = ["widget", "gadget", "tool", "device", "item"];
$suppliers = ["SupplierA", "SupplierB", "SupplierC", "SupplierD"];
$brands = ["BrandX", "BrandY", "BrandZ"];
$categories = ["Electronics", "Household", "Outdoor", "Automotive", "Toys"];
$safetyLevels = ["Low", "Medium", "High", "Critical"];

// Generate 1000 rows of random data
for ($i = 0; $i < 5000; $i++) {
    $description = $descriptions[array_rand($descriptions)];
    $keyword = $keywords[array_rand($keywords)];
    $qty = rand(1, 500);
    $price = number_format(rand(100, 10000) / 100, 2); // e.g., 1.00 - 100.00
    $supplier = $suppliers[array_rand($suppliers)];
    $barcode = str_pad(rand(100000000000, 999999999999), 12, '0', STR_PAD_LEFT); // 12-digit barcode
    $batchCode = "B" . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
    $brand = $brands[array_rand($brands)];
    $category = $categories[array_rand($categories)];
    $safety = $safetyLevels[array_rand($safetyLevels)];

    $row = [$description, $keyword, $qty, $price, $supplier, $barcode, $batchCode, $brand, $category, $safety];
    fputcsv($file, $row);
}

// Close file
fclose($file);

echo "CSV file 'product_data.csv' created successfully.";
?>

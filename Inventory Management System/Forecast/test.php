<?php
include "../config/database.php";
include "../config/on_session.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple CSV Reader</title>
</head>
<body>
    <h2>Upload CSV File</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit">Upload and Display</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csv_file"])) {
    $tmpName = $_FILES["csv_file"]["tmp_name"];
    $fileType = mime_content_type($tmpName);

    // Check if it's a CSV file
    if ($fileType === "text/plain" || $fileType === "text/csv" || pathinfo($_FILES["csv_file"]["name"], PATHINFO_EXTENSION) === "csv") {
        if (($handle = fopen($tmpName, "r")) !== false) {

            echo "<h3>CSV Data:</h3>";
            echo "<table border='1' cellpadding='5' cellspacing='0'>";

            $rowNumber = 0;

            while (($data = fgetcsv($handle)) !== false) {
                // Skip if more than 14 columns
                if (count($data) > 14) {
                    echo "<p style='color: red;'>Error: Only 14 columns allowed. Row skipped.</p>";
                    continue;
                }

                // Assign variables
                $category     = strtoupper($data[0]) ?? '';
                $january      = strtoupper($data[1]) ?? 0;
                $february     = strtoupper($data[2]) ?? 0;
                $march        = strtoupper($data[3]) ?? 0;
                $april        = strtoupper($data[4]) ?? 0;
                $may          = strtoupper($data[5]) ?? 0;
                $june         = strtoupper($data[6]) ?? 0;
                $july         = strtoupper($data[7]) ?? 0;
                $august       = strtoupper($data[8]) ?? 0;
                $september    = strtoupper($data[9]) ?? 0;
                $october      = strtoupper($data[10]) ?? 0;
                $november     = strtoupper($data[11]) ?? 0;
                $december     = strtoupper($data[12]) ?? 0;
                $grand_total  = strtoupper($data[13]) ?? 0;
                if (
                    $january === "JANUARY" &&
                    $february === "FEBRUARY" &&
                    $march === "MARCH" &&
                    $april === "APRIL" &&
                    $may === "MAY" &&
                    $june === "JUNE" &&
                    $july === "JULY" &&
                    $august === "AUGUST" &&
                    $september === "SEPTEMBER" &&
                    $october === "OCTOBER" &&
                    $november === "NOVEMBER" &&
                    $december === "DECEMBER" &&
                    $grand_total === "GRAND TOTAL"
                ) {
                    if(!isset($_SESSION['category_forecast'])){
                        $_SESSION['category_forecast'] = $category;
                    } else {
                        if($_SESSION['category_forecast'] !== $category){
                            $_SESSION['category_forecast'] = $category;
                        }
                    }

                    echo "<tr>
                        <td>$category</td><td>$january</td><td>$february</td><td>$march</td><td>$april</td><td>$may</td><td>$june</td>
                        <td>$july</td><td>$august</td><td>$september</td><td>$october</td><td>$november</td><td>$december</td><td>$grand_total</td>
                    </tr>";
                } else {
                $category_name = $_SESSION['category_forecast'];
                $description = $category;
                $product_search = "
                    SELECT 
                        p.hashed_id AS product_id
                    FROM product p
                    LEFT JOIN category c ON c.hashed_id = p.category
                    WHERE UPPER(p.description) = UPPER('$description')
                    AND UPPER(c.category_name) = UPPER('$category_name')
                    LIMIT 1
                ";

                $search_result = $conn->query($product_search);
                if($search_result->num_rows>0){
                    $row=$search_result->fetch_assoc();
                    $product_id = $row['product_id'];
                } else {
                    $product_id = "";
                }

                if(!empty($product_id)){
                    $stock_query = "SELECT COUNT(unique_barcode) AS qty, `safety` FROM stocks WHERE product_id = '$product_id' AND s.item_status = 0";
                    $stock_result = $conn->query($stock_query);
                    if($stock_result->num_rows>0){
                        $row=$stock_result->fetch_assoc();
                        $available_stocks = $row['qty'];
                        $safety = $row['safety'];
                    }
                } else {
                    $available_stocks = 0;
                    $safety = 0;
                }

                echo "<tr>
                    <td>$description</td>
                    <td>$january</td>
                    <td>$february</td>
                    <td>$march</td>
                    <td>$april</td>
                    <td>$may</td>
                    <td>$june</td>
                    <td>$july</td>
                    <td>$august</td>
                    <td>$september</td>
                    <td>$october</td>
                    <td>$november</td>
                    <td>$december</td>
                    <td>$grand_total</td>
                    <td>$available_stocks</td>
                    <td>$safety</td>
                </tr>";
                }


                $rowNumber++;
            }

            echo "</table>";
            fclose($handle);
        } else {
            echo "<p>Could not open the file.</p>";
        }
    } else {
        echo "<p style='color: red;'>Invalid file type. Please upload a CSV file.</p>";
    }
}
?>

</body>
</html>

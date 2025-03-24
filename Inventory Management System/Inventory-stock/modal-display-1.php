<table>
    <thead>
        <tr>
            <th>Unique Barcode</th>
            <th>Status</th>
            <th>Capital</th>
            <th>Sold Amount</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
<?php
include "../config/database.php";

if(isset($_GET['target_id'])){
    $batch_code = $_GET['target_id'];

    $query = "SELECT s.unique_barcode, s.item_status, il.location_name, s.capital, ol.sold_price FROM stocks s LEFT JOIN item_location il ON il.id = s.item_location LEFT JOIN outbound_content ol ON ol.unique_barcode = s.unique_barcode WHERE s.batch_code = '$batch_code' ORDER BY s.barcode_extension ASC LIMIT 100";
    $res = $conn->query($query);
    if($res->num_rows>0){
        while($row=$res->fetch_assoc()){

            if(empty($row['location_name'])){
                $location_name = '<span class="badge rounded-pill badge-subtle-warning">For SKU</span>';
            } else {
                $location_name = '<span class="badge rounded-pill badge-subtle-primary">' . $row['location_name'] . '</span>';
            }
            if($row['item_status'] == 0) {
                $item_status = '<span class="badge rounded-pill bg-success">Available</span>';
            } elseif($row['item_status'] == 1) {
                $item_status = '<span class="badge rounded-pill bg-danger">Sold</span>';
            } elseif($row['item_status'] == 2) {
                $item_status = '<span class="badge rounded-pill bg-primary">Enroute</span>';
            } elseif($row['item_status'] == 3) {
                $item_status = '<span class="badge rounded-pill bg-warning">For Enroute</span>';
            } else {
                $item_status = '<span class="badge rounded-pill bg-warning">Returned</span>';
            }
            // Display product details for the current batch code
            echo "
                <tr>
                    <td class='barcode'><a href='../Product-info/?prod=" . htmlspecialchars($row['unique_barcode']) . "'><small>LPO " . htmlspecialchars($row['unique_barcode']) . "</small></a></td>
                    <td class='status text-center'>" . $item_status . "</td>
                    <td class='capital text-end'><small>" . htmlspecialchars($row['capital']) . "</small></td>
                    <td class='sold'><small>" . $row['sold_price'] . "</small></td>
                    <td class='location'><small>" . $location_name . "</small></td>
                </tr>
            ";
        }
    }
}
?>
</tbody>
</table>
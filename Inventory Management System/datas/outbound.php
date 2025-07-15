<?php 
include "../config/database.php";

// Second query: Using prepared statements and handling result
$query = "
    SELECT p.description, b.brand_name, c.category_name, s.parent_barcode, 
            oc.quantity_before, oc.quantity_after, COUNT(s.parent_barcode) AS quantity, 
            s.capital, oc.sold_price
    FROM outbound_content oc
    LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode
    LEFT JOIN product p ON p.hashed_id = s.product_id
    LEFT JOIN brand b ON b.hashed_id = p.brand
    LEFT JOIN category c ON c.hashed_id = p.category";
    
$stmt2 = $conn->prepare($query);
$stmt2->bind_param("s", $outbound_id);
$stmt2->execute();
$res = $stmt2->get_result();

$count = 1;
$total = 0;
$total_profit = 0;
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $productDescription = $row['description'];
        $brandName = $row['brand_name'];
        $categoryName = $row['category_name'];
        $parentBarcode = $row['parent_barcode'];
        $quantityBefore = $row['quantity_before'];
        $quantityAfter = $row['quantity_after'];
        $quantity = $row['quantity'];
        $productCapital = $row['capital'];
        $soldPrice = $row['sold_price'];
        $sub_Total = $quantity * $soldPrice;
        $profit = $soldPrice - $productCapital;
        $sub_profit = $profit * $quantity;
        ?>
            
        <tr>
            <td class="fs-10" style="width: 550px;"><?php echo $count;?></td>
            <td class="fs-10"><?php echo $productDescription;?></td>
            <td class="fs-10"><?php echo $brandName;?></td>
            <td class="fs-10"><?php echo $categoryName;?></td>
            <td class="fs-11">
                <?php 
                echo $parentBarcode . "<br>";
                $last_query = "SELECT unique_barcode FROM outbound_content WHERE hashed_id = '$outbound_id'";
                $last_res = $conn->query($last_query);
                if($last_res->num_rows>0){
                    while($row=$last_res->fetch_assoc()){
                        $unique_bc = $row['unique_barcode'];
                        echo $unique_bc . ", ";
                    }
                }
                ?>
            </td>
            <td class="text-end fs-10" style="width: 250px;"><?php echo $quantityBefore;?></td>
            <td class="text-end fs-10" style="width: 250px;"><?php echo $quantity;?></td>
            <td class="text-end fs-10" style="width: 250px;"><?php echo $quantityAfter;?></td>
            <?php 
            if(strpos($access, "view_capital")!==false || $user_position_name === "Administrator" || $user_position_name === "administrator"){
            ?>
            <td class="text-end fs-10" style="width: 250px;">₱ <?php echo number_format($productCapital, 2);?></td>
            <?php 
            } 
            ?>
            <td class="text-end fs-10" style="width: 250px;">₱ <?php echo number_format($soldPrice, 2);?></td>
            <?php 
            if(strpos($access, "view_profit")!==false || $user_position_name === "Administrator" || $user_position_name === "administrator"){
            ?>
            <td class="text-end fs-10" style="width: 250px;">₱ <?php echo number_format($sub_profit, 2);?></td>
            <?php 
            }
            ?>
            <td class="text-end fs-10" style="width: 250px;">₱ <?php echo number_format($sub_Total, 2);?></td>
        </tr>
        
                <?php
        $count++;
        $total += $sub_Total;
        $total_profit += $sub_profit;
    }
}
?>
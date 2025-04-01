<?php
include "database.php";
include "on_session.php";

if (isset($_GET['id']) && isset($_GET['from'])) {
    $identification = $_GET['id'];
    $type = $_GET['from'];

    switch ($type) {
        case "category":
            $case = "category SET current_status = 1 WHERE hashed_id";
            // Your code for handling category case
            break;

        case "brand":
            $case = "brand SET current_status = 1 WHERE hashed_id";
            // Your code for handling product case
            break;

        case "product_list":
            $case = "product SET current_status = 1 WHERE hashed_id";
            // Your code for handling product case
            break;

        case "warehouse":
            $case = "warehouse SET current_status = 1 WHERE hashed_id";
            // Your code for handling product case
            break;
    
        case "supplier":
            $case = "supplier SET current_status = 1 WHERE hashed_id";
            // Your code for handling product case
            break;

        case "platform":
            $case = "logistic_partner SET current_status = 1 WHERE hashed_id";
            // Your code for handling product case
            break;

        case "courier":
            $case = "courier SET current_status = 1 WHERE hashed_id";
            // Your code for handling product case
            break;

        case "access_level":
            $case = "user_position SET current_status = 1 WHERE hashed_id";
            // Your code for handling product case
            break;

        case "item-destination":
            $case = "item_location SET current_status = 1 WHERE hashed_id";
            // Your code for handling product case
            break;
        default:
            // Default case if no match
            break;
    }


}
?>

<?php
session_start();

if (isset($_SESSION['po_list']) && !empty($_SESSION['po_list'])) {
    foreach ($_SESSION['po_list'] as $item) {
        echo "<tr>";
        echo "<td class='name'>" . htmlspecialchars($item['description']) . "</td>";
        echo "<td class='email'>" . htmlspecialchars($item['brand']) . "</td>";
        echo "<td class='age'>" . htmlspecialchars($item['category']) . "</td>";
        echo "<td class='age'><input type='text' name='barcode' value='" . htmlspecialchars($item['barcode']) . "' hidden> " . htmlspecialchars($item['barcode']) . "</td>";
        echo "<td class='age text-end'>" . htmlspecialchars($item['qty']) . "</td>";

        // Conditional input field based on qty value
        if ($item['qty'] == 0) {
            echo "<td class='age'><input type='number' class='form-control' min='0'></td>";
        } else {
            echo "<td class='age'><input type='number' class='form-control' max='" . htmlspecialchars($item['qty']) . "'></td>";
        }
        echo "<td class='age'><input type='number' class='form-control''></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No products found.</td></tr>";
}
?>

<?php
require_once 'database.php';

// Fetch product data from the database
$sql = "SELECT product_name, category, manufacturing_date, image FROM products";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Encode the product data as JSON
echo json_encode($products);

// Close the database connection
$conn->close();
?>

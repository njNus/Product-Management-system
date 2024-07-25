<?php
// add_product.php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $productName = $_POST['product_name'];
    $category = $_POST['category'];
    $manufacturingDate = $_POST['manufacturing_date'];
    $image = $_FILES['image']['name'];
    $imageTmpPath = $_FILES['image']['tmp_name'];

    // Move the uploaded image to a designated directory
    $uploadDir = 'uploads/';
    $imagePath = $uploadDir . basename($image);
    move_uploaded_file($imageTmpPath, $imagePath);

    // Prepare the SQL INSERT statement
    $sql = "INSERT INTO products (product_name, category, manufacturing_date, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $productName, $category, $manufacturingDate, $imagePath);

    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!-- HTML form goes here -->
<!-- add_product.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Product Management System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="add_product.php">Add Product</a>
        </nav>
    </header>

    <main>
        <h2><center>Add Product</center></h2>
        <form id="product-form" method="post" action="add_product.php" enctype="multipart/form-data">
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="product_name" required>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>

            <label for="manufacturing-date">Manufacturing Date:</label>
            <input type="date" id="manufacturing-date" name="manufacturing_date" required>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/png" required>

            <input type="submit" value="Add Product">
        </form>
    </main>

    <script src="form_validation.js"></script>
</body>
</html>

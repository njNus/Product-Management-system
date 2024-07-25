<?php
require_once 'database.php';

// Fetch product data from the database
$sql = "SELECT product_name, category, image FROM products";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management System</title>
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
        <section class="product-slider">
            <h2>Featured Products</h2>
            <div class="slider-container">
                <div class="slider">
                    <?php foreach ($products as $product) : ?>
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>">
                    <?php endforeach; ?>
                </div>
                <div class="slider-controls">
                    <button class="prev-btn">&lt;</button>
                    <button class="next-btn">&gt;</button>
                </div>
            </div>
        </section>
    </main>

    <script src="slider.js"></script>
</body>
</html>
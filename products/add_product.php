<?php include('../db.php'); ?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Shop Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Shop Management System</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="view_products.php">Products</a></li>
            <li><a href="../customers/view_customers.php">Customers</a></li>
            <li><a href="../sales/view_sales.php">Sales</a></li>
            <li><a href="../search.php">Search</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Add New Product</h2>
            
            <form method="POST" action="">
                <label>Product Name</label>
                <input type="text" name="product_name" placeholder="Enter product name" required>
                
                <label>Category</label>
                <input type="text" name="category" placeholder="Enter category" required>
                
                <label>Price</label>
                <input type="number" step="0.01" name="price" placeholder="Enter price" required>
                
                <label>Stock Quantity</label>
                <input type="number" name="stock" placeholder="Enter stock quantity" required>
                
                <input type="submit" name="add" value="Add Product" class="btn">
                <a href="view_products.php" class="btn">Back</a>
            </form>

            <?php
            if (isset($_POST['add'])) {
                $name = trim($_POST['product_name']);
                $cat = trim($_POST['category']);
                $price = $_POST['price'];
                $stock = $_POST['stock'];

                if ($price <= 0 || $stock < 0) {
                    echo "<p style='margin-top: 15px;'>Invalid price or stock!</p>";
                } else {
                    $sql = "INSERT INTO products (product_name, category, price, stock) 
                            VALUES ('$name', '$cat', '$price', '$stock')";
                    if (mysqli_query($conn, $sql)) {
                        echo "<p style='margin-top: 15px;'>Product Added Successfully!</p>";
                    } else {
                        echo "<p style='margin-top: 15px;'>Error: " . mysqli_error($conn) . "</p>";
                    }
                }
            }
            ?>
        </div>
    </div>
    
    <footer>
        Made by Chand Raj - 2312360 - Section 5G
    </footer>
</body>
</html>

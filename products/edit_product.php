<?php include('../db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Shop Management System</title>
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
            <h2>Edit Product</h2>
            
            <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE product_id=$id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>

            <form method="POST" action="">
                <label>Product Name</label>
                <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required>
                
                <label>Category</label>
                <input type="text" name="category" value="<?php echo $row['category']; ?>" required>
                
                <label>Price</label>
                <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required>
                
                <label>Stock Quantity</label>
                <input type="number" name="stock" value="<?php echo $row['stock']; ?>" required>
                
                <input type="submit" name="update" value="Update Product" class="btn">
                <a href="view_products.php" class="btn">Back</a>
            </form>

            <?php
            if (isset($_POST['update'])) {
                $name = trim($_POST['product_name']);
                $cat = trim($_POST['category']);
                $price = $_POST['price'];
                $stock = $_POST['stock'];

                if ($price <= 0 || $stock < 0) {
                    echo "<p style='margin-top: 15px;'>Invalid price or stock!</p>";
                } else {
                    $update = "UPDATE products SET product_name='$name', category='$cat', price='$price', stock='$stock' 
                            WHERE product_id=$id";
                    if (mysqli_query($conn, $update)) {
                        echo "<p style='margin-top: 15px;'>Product Updated Successfully!</p>";
                        echo "<meta http-equiv='refresh' content='1.5;url=view_products.php'>";
                    } else {
                        echo "<p style='margin-top: 15px;'>Update Failed!</p>";
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

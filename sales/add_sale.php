<?php 
include('../db.php');


if (isset($_POST['sell'])) {
    $customer_id = intval($_POST['customer_id']);
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    $check = mysqli_query($conn, "SELECT price, stock, product_name FROM products WHERE product_id=$product_id");
    if (!$check || mysqli_num_rows($check) == 0) {
        $error = "Product not found!";
    } else {
        $product = mysqli_fetch_assoc($check);

        if ($quantity <= 0) {
            $error = "Quantity must be greater than zero!";
        } elseif ($product['stock'] < $quantity) {
            $error = "Not enough stock available! (Available: {$product['stock']})";
        } else {
            $total = $quantity * $product['price'];

            $insert = "INSERT INTO sales (customer_id, product_id, quantity, total_price)
                       VALUES ('$customer_id', '$product_id', '$quantity', '$total')";
            if (mysqli_query($conn, $insert)) {
                $newStock = $product['stock'] - $quantity;
                mysqli_query($conn, "UPDATE products SET stock=$newStock WHERE product_id=$product_id");
                
                header("Location: view_sales.php");
                exit;
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale - Shop Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Shop Management System</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../products/view_products.php">Products</a></li>
            <li><a href="../customers/view_customers.php">Customers</a></li>
            <li><a href="view_sales.php">Sales</a></li>
            <li><a href="../search.php">Search</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Record New Sale</h2>

            <?php if (isset($error)): ?>
                <div style="color: #e74c3c; margin-bottom: 15px; padding: 10px; background-color: #ffebee; border-left: 3px solid #e74c3c;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <label>Select Customer</label>
                <select name="customer_id" required>
                    <option value="">-- Choose Customer --</option>
                    <?php
                    $cust = mysqli_query($conn, "SELECT * FROM customers");
                    if ($cust) {
                        while ($row = mysqli_fetch_assoc($cust)) {
                            echo "<option value='{$row['customer_id']}'> {$row['name']} ({$row['email']})</option>";
                        }
                    }
                    ?>
                </select>

                <label>Select Product</label>
                <select name="product_id" required>
                    <option value="">-- Choose Product --</option>
                    <?php
                    $prod = mysqli_query($conn, "SELECT * FROM products WHERE stock > 0");
                    if ($prod) {
                        while ($row = mysqli_fetch_assoc($prod)) {
                            echo "<option value='{$row['product_id']}'> {$row['product_name']} (Stock: {$row['stock']})</option>";
                        }
                    }
                    ?>
                </select>

                <label>Quantity</label>
                <input type="number" name="quantity" placeholder="Enter quantity" min="1" required>

                <input type="submit" name="sell" value="Create Sale" class="btn">
                <a href="view_sales.php" class="btn">Back</a>
            </form>
        </div>
    </div>
    
    <footer>
        Made by Chand Raj - 2312360 - Section 5G
    </footer>
</body>
</html>

<?php 
include ('../db.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer - Shop Management System</title>
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
            <li><a href="view_customers.php">Customers</a></li>
            <li><a href="../sales/view_sales.php">Sales</a></li>
            <li><a href="../search.php">Search</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Add New Customer</h2>

            <form method="POST" action="">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter full name" required>
                
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter email address" required>
                
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="Enter phone number" required>
                
                <label>Address</label>
                <input type="text" name="address" placeholder="Enter address" required>
                
                <input type="submit" name="add" value="Add Customer" class="btn">
                <a href="view_customers.php" class="btn">Back</a>
            </form>

            <?php
            if (isset($_POST['add'])) {
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);

                if (empty($name) || empty($email) || empty($phone) || empty($address)) {
                    echo "<p style='margin-top: 15px;'>All fields are required!</p>";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<p style='margin-top: 15px;'>Invalid email format!</p>";
                } elseif (!preg_match('/^[0-9+\-\s]+$/', $phone)) {
                    echo "<p style='margin-top: 15px;'>Invalid phone number!</p>";
                } else {
                    $sql = "INSERT INTO customers (name, email, phone, address)
                            VALUES ('$name', '$email', '$phone', '$address')";

                    if (mysqli_query($conn, $sql)) {
                        echo "<p style='margin-top: 15px;'>Customer Added Successfully!</p>";
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

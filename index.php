
<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Shop Management System</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products/view_products.php">Products</a></li>
            <li><a href="customers/view_customers.php">Customers</a></li>
            <li><a href="sales/view_sales.php">Sales</a></li>
            <li><a href="search.php">Search</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="card">
            <h2>Welcome to Shop Management System</h2>
            <p>Manage your shop operations efficiently.</p>
            
            <div style="margin-top: 20px;">
                <div class="card" style="margin-bottom: 15px;">
                    <h3>Products</h3>
                    <p>Manage product inventory, prices, and stock levels.</p>
                    <a href="products/view_products.php" class="btn">View Products</a>
                </div>
                
                <div class="card" style="margin-bottom: 15px;">
                    <h3>Customers</h3>
                    <p>Manage customer information.</p>
                    <a href="customers/view_customers.php" class="btn">View Customers</a>
                </div>
                
                <div class="card">
                    <h3>Sales</h3>
                    <p>Handle sales transactions and invoices.</p>
                    <a href="sales/view_sales.php" class="btn">View Sales</a>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        Made by Chand Raj - 2312360 - Section 5G
    </footer>
</body>
</html>

<!-- Changes done by GoraveLohana 2 -->

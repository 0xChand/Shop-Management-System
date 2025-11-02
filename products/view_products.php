<?php
include("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - Shop Management System</title>
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
            <h2>Product Management</h2>
            
            <?php if (isset($_GET['msg'])): ?>
                <div style="color: #e74c3c; margin-bottom: 15px; padding: 10px; background-color: #ffebee; border-left: 3px solid #e74c3c;">
                    <?php echo $_GET['msg']; ?>
                </div>
            <?php endif; ?>
            
            <a href="add_product.php" class="btn" style="margin-bottom: 20px; display: inline-block;">Add New Product</a>
            
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn, $sql);
                    $count =1;
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["category"] . "</td>";
                            echo "<td>PKR " . $row["price"] . "</td>";
                            echo "<td>" . $row["stock"] . "</td>";
                            echo "<td class='actions'>";
                            echo "<a href='edit_product.php?id=" . $row["product_id"] . "' class='edit-btn'>Edit</a>";
                            echo "<a href='delete_product.php?id=" . $row["product_id"] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No products found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <footer>
        Made by Chand Raj - 2312360 - Section 5G
    </footer>
</body>
</html>

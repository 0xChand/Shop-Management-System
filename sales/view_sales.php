<?php
include("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales - Shop Management System</title>
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
            <h2>Sales Management</h2>
            <a href="add_sale.php" class="btn" style="margin-bottom: 20px; display: inline-block;">Add New Sale</a>
            
            <table>
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Sale Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT s.*, c.name AS customer_name, p.product_name 
                            FROM sales s
                            JOIN customers c ON s.customer_id = c.customer_id
                            JOIN products p ON s.product_id = p.product_id";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["sale_id"] . "</td>";
                            echo "<td>" . $row["customer_name"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td>PKR " . $row["total_price"] . "</td>";
                            echo "<td>" . $row["sale_date"] . "</td>";
                            echo "<td class='actions'>";
                            echo "<a href='invoice.php?sale_id=" . $row["sale_id"] . "' class='edit-btn'>View Invoice</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No sales found</td></tr>";
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

<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - Shop Management System</title>
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
            <h2>Search System</h2>
            <p>Search across all modules in the shop management system.</p>
            
            <div class="search-form">
                <form method="GET" action="">
                    <label for="search_type">Search Type</label>
                    <select id="search_type" name="search_type" required>
                        <option value="">Select Search Type</option>
                        <option value="products" <?php echo (isset($_GET['search_type']) && $_GET['search_type'] == 'products') ? 'selected' : ''; ?>>Products</option>
                        <option value="customers" <?php echo (isset($_GET['search_type']) && $_GET['search_type'] == 'customers') ? 'selected' : ''; ?>>Customers</option>
                        <option value="sales" <?php echo (isset($_GET['search_type']) && $_GET['search_type'] == 'sales') ? 'selected' : ''; ?>>Sales</option>
                    </select>
                    
                    <label for="search_term">Search Term</label>
                    <input type="text" id="search_term" name="search_term" value="<?php echo isset($_GET['search_term']) ? ($_GET['search_term']) : ''; ?>" placeholder="Enter search term..." required>
                    
                    <input type="submit" value="Search">
                </form>
            </div>

            <?php
            if (isset($_GET['search_type']) && isset($_GET['search_term']) && !empty($_GET['search_term'])) {
                $search_type = $_GET['search_type'];
                $search_term = $_GET['search_term'];
                
                echo "<div class='card'>";
                echo "<h3>Search Results for: " . $search_term . "</h3>";
                
                switch ($search_type) {
                    case 'products':
                        $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_term%' OR category LIKE '%$search_term%'";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>";
                            echo "<thead>
                            <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            </tr>
                            </thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["product_id"] . "</td>";
                                echo "<td>" . $row["product_name"] . "</td>";
                                echo "<td>" . $row["category"] . "</td>";
                                echo "<td>PKR " . $row["price"] . "</td>";
                                echo "<td>" . $row["stock"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No products found matching your search.</p>";
                        }
                        break;
                        
                    case 'customers':
                        $sql = "SELECT * FROM customers WHERE name LIKE '%$search_term%' OR email LIKE '%$search_term%'";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>";
                            echo "<thead>
                            <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            </tr>
                            </thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["customer_id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["phone"] . "</td>";
                                echo "<td>" . $row["address"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No customers found matching your search.</p>";
                        }
                        break;
                        
                    case 'sales':
                        $sql = "SELECT s.*, c.name AS customer_name, p.product_name 
                                FROM sales s
                                JOIN customers c ON s.customer_id = c.customer_id
                                JOIN products p ON s.product_id = p.product_id
                                WHERE s.sale_id LIKE '%$search_term%' OR c.name LIKE '%$search_term%' OR p.product_name LIKE '%$search_term%'";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>";
                            echo "<thead>
                            <tr>
                            <th>Sale ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Sale Date</th>
                            </tr>
                            </thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["sale_id"] . "</td>";
                                echo "<td>" . $row["customer_name"] . "</td>";
                                echo "<td>" . $row["product_name"] . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>PKR " . $row["total_price"] . "</td>";
                                echo "<td>" . $row["sale_date"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No sales found matching your search.</p>";
                        }
                        break;
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
    
    <footer>
        Made by Chand Raj - 2312360 - Section 5G
    </footer>
</body>
</html>

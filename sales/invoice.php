<?php 
include('../db.php');

if (!isset($_GET['sale_id']) || empty($_GET['sale_id'])) {
    die("<p>Sale ID not provided.</p>");
}

$sale_id = intval($_GET['sale_id']);


$sql = "SELECT s.*, 
               c.name AS customer_name, c.email, c.phone, c.address,
               p.product_name, p.price
        FROM sales s
        JOIN customers c ON s.customer_id = c.customer_id
        JOIN products p ON s.product_id = p.product_id
        WHERE s.sale_id = $sale_id";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("<p>Invoice not found!</p>");
}

$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?php echo $sale_id; ?></title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .invoice-box {
            background-color: white;
            color: #333;
            width: 60%;
            margin: 50px auto;
            padding: 30px;
            border-left: 5px solid #667eea;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        td, th {
            padding: 12px;
            text-align: left;
            border: 1px solid #e0e0e0;
        }
        th {
            background-color: #667eea;
            color: white;
        }
        .print-btn {
            background-color: #667eea;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }
    </style>
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
        <div class="invoice-box">
        <h2>Invoice #<?php echo $sale_id; ?></h2>
        <p><strong>Date:</strong> <?php echo $row['sale_date']; ?></p>
        <hr>

        <h3>Customer Info</h3>
        <p>
            <strong>Name:</strong> <?php echo $row['customer_name']; ?><br>
            <strong>Email:</strong> <?php echo $row['email']; ?><br>
            <strong>Phone:</strong> <?php echo $row['phone']; ?><br>
            <strong>Address:</strong> <?php echo $row['address']; ?>
        </p>
        <hr>

        <h3>Product Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>PKR <?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>PKR <?php echo number_format($row['total_price'], 2); ?></td>
                </tr>
            </tbody>
        </table>
        <hr>
         <h3 style="color: #667eea; font-size: 20px; margin-top: 20px;">Total Amount: PKR <?php echo number_format($row['total_price'], 2); ?></h3>

            <br><br>
            <a href="view_sales.php" class="btn">Back</a>
        </div>
    </div>

    <footer>
        Made by Chand Raj - 2312360 - Section 5G
    </footer>
</body>
</html>

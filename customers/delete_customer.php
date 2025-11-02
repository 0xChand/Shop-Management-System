<?php 
include('../db.php'); 
$id = intval($_GET['id']);

$check_sales = "SELECT COUNT(*) as count FROM sales WHERE customer_id=$id";
$result = mysqli_query($conn, $check_sales);
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    header("Location: view_customers.php?msg=Customer Has Sales. Cant delete");
} else {
    $sql = "DELETE FROM customers WHERE customer_id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: view_customers.php");
    }
}
exit;
?>

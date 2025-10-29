<?php
include('../db.php');
$id = intval($_GET['id']);

$check_sales = "SELECT COUNT(*) as count FROM sales WHERE product_id=$id";
$result = mysqli_query($conn, $check_sales);
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    $update_sql = "UPDATE products SET stock=0 WHERE product_id=$id";
    mysqli_query($conn, $update_sql);
    header("Location: view_products.php?msg=Product cannot be deleted as it has sales records. Stock set to 0.");
} else {
    $sql = "DELETE FROM products WHERE product_id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: view_products.php");
    } else {
        header("Location: view_products.php?msg=Error deleting product.");
    }
}
exit;
?>

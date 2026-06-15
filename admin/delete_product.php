<?php
include('../src/dbcon.php');

$id = $_GET['id'];

$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id='$id'"));

if ($product && !empty($product['image'])) {
    $image_path = "assets/images/products/" . $product['image'];

    if (file_exists($image_path)) {
        unlink($image_path);
    }
}

mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

header("Location: view_products.php");
exit();
?>
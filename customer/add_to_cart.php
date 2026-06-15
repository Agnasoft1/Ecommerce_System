<?php
include("../src/dbcon.php");

$session_id = session_id();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['product_id'])) {

    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if ($quantity < 1) {
        $quantity = 1;
    }

    $product_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$product_id'");

    if (mysqli_num_rows($product_query) == 0) {
        die("Product not found");
    }

    $product = mysqli_fetch_assoc($product_query);

    $product_name = mysqli_real_escape_string($conn, $product['product_name']);
    $price = $product['price'];

    $insert_product = mysqli_query($conn, "
        INSERT INTO cart (session_id, product_id, product_name, price, quantity, item_type)
        VALUES ('$session_id', '$product_id', '$product_name', '$price', '$quantity', 'Product')
    ");

    if (!$insert_product) {
        die("Product Insert Error: " . mysqli_error($conn));
    }

    if (!empty($_POST['accessories'])) {
        foreach ($_POST['accessories'] as $accessory_id) {

            $accessory_id = intval($accessory_id);

            $acc_query = mysqli_query($conn, "SELECT * FROM accessories WHERE accessory_id='$accessory_id'");

            if (mysqli_num_rows($acc_query) > 0) {
                $acc = mysqli_fetch_assoc($acc_query);

                $acc_name = mysqli_real_escape_string($conn, $acc['accessory_name']);
                $acc_price = $acc['price'];

                $insert_acc = mysqli_query($conn, "
                    INSERT INTO cart (session_id, product_id, product_name, price, quantity, item_type)
                    VALUES ('$session_id', '$product_id', '$acc_name', '$acc_price', 1, 'Accessory')
                ");

                if (!$insert_acc) {
                    die("Accessory Insert Error: " . mysqli_error($conn));
                }
            }
        }
    }

    header("Location: cart.php");
    exit();
}
else {
    die("Invalid request");
}
?>
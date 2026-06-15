<?php
include('../src/dbcon.php');

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    $check_products = mysqli_query($conn, 
        "SELECT * FROM products WHERE category_id='$category_id'"
    );

    if (mysqli_num_rows($check_products) > 0) {
        echo "
        <script>
            alert('Cannot delete this category because products are available inside it. Delete or move those products first.');
            window.location.href='view_categories.php';
        </script>";
        exit();
    }

    $delete = mysqli_query($conn, 
        "DELETE FROM categories WHERE category_id='$category_id'"
    );

    if ($delete) {
        echo "
        <script>
            alert('Category deleted successfully.');
            window.location.href='view_categories.php';
        </script>";
        exit();
    } else {
        echo 'Delete Failed: ' . mysqli_error($conn);
    }
} else {
    header("Location: view_categories.php");
    exit();
}
?>
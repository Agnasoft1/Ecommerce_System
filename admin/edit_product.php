<?php
include('../src/dbcon.php');
include('includes/header.php');

$id = $_GET['id'];

$product_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$id'");

if (!$product_query) {
    die("Query Error: " . mysqli_error($conn));
}

$product = mysqli_fetch_assoc($product_query);

$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");

if (isset($_POST['update_product'])) {
    $category_id = $_POST['category_id'];
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $update = mysqli_query($conn, "
        UPDATE products SET
        category_id='$category_id',
        product_name='$product_name',
        description='$description',
        price='$price',
        stock='$stock'
        WHERE product_id='$id'
    ");

    if ($update) {
        header("Location: view_products.php");
        exit();
    } else {
        echo "Update Error: " . mysqli_error($conn);
    }
}
?>

<div class="form-page">
    <div class="form-card">
        <h1>Edit Product</h1>

        <form method="POST">

            <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                        <option value="<?php echo $cat['category_id']; ?>"
                            <?php if($cat['category_id'] == $product['category_id']) echo "selected"; ?>>
                            <?php echo $cat['category_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required><?php echo $product['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
            </div>

            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
            </div>

            <button type="submit" name="update_product">Update Product</button>
        </form>

        <a href="view_products.php" class="back-link">← Back to Products</a>
    </div>
</div>

<?php include('includes/footer.php'); ?>
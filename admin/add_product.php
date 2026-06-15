```php
<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$message = "";

$categories = mysqli_query($conn,
"SELECT * FROM categories ORDER BY category_name ASC");

if(isset($_POST['add_product']))
{
    $category_id = mysqli_real_escape_string($conn,$_POST['category_id']);
    $product_name = mysqli_real_escape_string($conn,trim($_POST['product_name']));
    $description = mysqli_real_escape_string($conn,trim($_POST['description']));
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $stock = mysqli_real_escape_string($conn,$_POST['stock']);

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $image_name = time().'_'.$image;

    move_uploaded_file($tmp,"../uploads/".$image_name);

    $query = "INSERT INTO products
    (
        category_id,
        product_name,
        description,
        price,
        stock,
        image
    )
    VALUES
    (
        '$category_id',
        '$product_name',
        '$description',
        '$price',
        '$stock',
        '$image_name'
    )";

    if(mysqli_query($conn,$query))
    {
        $message = "<div class='success-msg'>
        Product Added Successfully
        </div>";
    }
    else
    {
        $message = "<div class='error-msg'>
        ".mysqli_error($conn)."
        </div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<div class="admin-header">

    <div>
        <h2>🛒 ShopCart Admin</h2>
        <span>Welcome, <?php echo $_SESSION['admin_name']; ?></span>
    </div>

    <a href="logout.php" class="logout-btn">
        Logout
    </a>

</div>

<div class="form-container">

    <div class="form-card product-card">

        <h1>📦 Add Product</h1>
        <p>Add new product to your store.</p>

        <?php echo $message; ?>

        <form method="POST" enctype="multipart/form-data">

            <label>Select Category</label>

            <select name="category_id" required>
                <option value="">
                    -- Select Category --
                </option>

                <?php
                while($cat=mysqli_fetch_assoc($categories))
                {
                ?>
                <option value="<?php echo $cat['category_id']; ?>">
                    <?php echo $cat['category_name']; ?>
                </option>
                <?php } ?>
            </select>

            <label>Product Name</label>
            <input
                type="text"
                name="product_name"
                placeholder="Enter Product Name"
                required>

            <label>Description</label>
            <textarea
                name="description"
                placeholder="Enter Product Description"
                required></textarea>

            <label>Price (₹)</label>
            <input
                type="number"
                step="0.01"
                name="price"
                placeholder="Enter Product Price"
                required>

            <label>Stock Quantity</label>
            <input
                type="number"
                name="stock"
                placeholder="Enter Available Stock"
                required>

            <label>Product Image</label>
            <input
                type="file"
                name="image"
                required>

            <button type="submit" name="add_product">
                📦 Add Product
            </button>

        </form>

        <a href="dashboard.php" class="back-btn">
            ← Back to Dashboard
        </a>

    </div>

</div>

</body>
</html>
```

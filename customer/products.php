<?php
include("../src/dbcon.php");
include("../includes/header.php");

if(!isset($_GET['category_id'])){
    header("Location: categories.php");
    exit();
}

$category_id = $_GET['category_id'];

$cat_query = mysqli_query($conn, "SELECT * FROM categories WHERE category_id='$category_id'");
$category = mysqli_fetch_assoc($cat_query);

$product_query = mysqli_query($conn, "SELECT * FROM products WHERE category_id='$category_id' ORDER BY product_id DESC");
?>

<div class="page-container">

    <div class="page-title">
        <h1><?php echo $category['category_name']; ?></h1>
        <p>Choose your product and continue shopping.</p>
    </div>

    <div class="product-grid">

        <?php while($product = mysqli_fetch_assoc($product_query)) { ?>

            <div class="product-card">
                <img src="../assets/images/<?php echo $product['image']; ?>" alt="Product">

                <div class="product-info">
                    <h3><?php echo $product['product_name']; ?></h3>
                    <p><?php echo $product['description']; ?></p>

                    <h4>₹<?php echo number_format($product['price'], 2); ?></h4>

                    <a href="product_details.php?product_id=<?php echo $product['product_id']; ?>" class="small-btn">
                        View Details
                    </a>
                </div>
            </div>

        <?php } ?>

    </div>

</div>

<?php include("../includes/footer.php"); ?>
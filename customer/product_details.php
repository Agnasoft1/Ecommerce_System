<?php
include("../src/dbcon.php");
include("../includes/header.php");

if(!isset($_GET['product_id'])){
    header("Location: categories.php");
    exit();
}

$product_id = $_GET['product_id'];

$product_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$product_id'");
$product = mysqli_fetch_assoc($product_query);

$accessory_query = mysqli_query($conn, "SELECT * FROM accessories WHERE product_id='$product_id'");
?>

<div class="page-container">

    <div class="details-box">

        <div class="details-image">
            <img src="../assets/images/<?php echo $product['image']; ?>" alt="">
        </div>

        <div class="details-info">
            <h1><?php echo $product['product_name']; ?></h1>
            <p><?php echo $product['description']; ?></p>

            <h2>₹<?php echo number_format($product['price'],2); ?></h2>

            <?php if($product['stock'] > 0){ ?>
                <span class="stock in-stock">In Stock: <?php echo $product['stock']; ?></span>
            <?php } else { ?>
                <span class="stock out-stock">Out of Stock</span>
            <?php } ?>

            <form method="POST" action="add_to_cart.php">

                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                <label>Quantity</label>
                <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>" class="qty-input">

                <h3>Related Accessories</h3>

                <div class="accessory-list">
                    <?php while($acc = mysqli_fetch_assoc($accessory_query)) { ?>
                        <label class="accessory-item">
                            <input type="checkbox" name="accessories[]" value="<?php echo $acc['accessory_id']; ?>">
                            <span>
                                <?php echo $acc['accessory_name']; ?>
                                <b>₹<?php echo number_format($acc['price'],2); ?></b>
                            </span>
                        </label>
                    <?php } ?>
                </div>

                <button type="submit" class="cart-btn">Add to Cart</button>

            </form>
        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>
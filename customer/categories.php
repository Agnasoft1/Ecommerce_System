<?php
include("../src/dbcon.php");
include("../includes/header.php");

$query = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_id DESC");
?>

<div class="page-container">

    <div class="page-title">
        <h1>Product Categories</h1>
        <p>Choose a category to view products.</p>
    </div>

    <div class="category-grid">

        <?php while($row = mysqli_fetch_assoc($query)) { ?>
            <a href="products.php?category_id=<?php echo $row['category_id']; ?>" class="category-card">
                <div class="category-icon">🛒</div>
                <h3><?php echo $row['category_name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <span>View Products →</span>
            </a>
        <?php } ?>

    </div>

</div>

<?php include("../includes/footer.php"); ?>
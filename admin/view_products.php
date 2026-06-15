<?php
include('../src/dbcon.php');
include('includes/header.php');

$result = mysqli_query($conn, "
SELECT p.product_id,
       p.product_name,
       p.price,
       p.description,
       p.image,
       p.stock,
       c.category_name
FROM products p
LEFT JOIN categories c
ON p.category_id = c.category_id
");

if(!$result){
    die("SQL Error: " . mysqli_error($conn));
}
?>

<div class="table-page">
    <div class="table-header">
        <div>
            <h1>All Products</h1>
            <p>Manage all products from here.</p>
        </div>
        <a href="add_product.php" class="add-btn">+ Add Product</a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>

                    <td>
                        <img src="../uploads/<?php echo $row['image']; ?>" width="70">
                    </td>

                    <td><?php echo $row['product_name']; ?></td>

                    <td><?php echo $row['category_name']; ?></td>

                    <td>₹<?php echo $row['price']; ?></td>

                    <td><?php echo $row['description']; ?></td>

                    <td><?php echo $row['stock']; ?></td>

                    <td>
                        <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class="edit-btn">Edit</a>

                        <a href="delete_product.php?id=<?php echo $row['product_id']; ?>"
                           class="delete-btn"
                           onclick="return confirm('Delete this product?');">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
</div>

<?php include('includes/footer.php'); ?>
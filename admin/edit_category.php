<?php
include('../src/dbcon.php');
include('includes/header.php');

$id = $_GET['id'];

$cat_result = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");

$current = mysqli_query($conn, "SELECT * FROM categories WHERE category_id='$id'");
$row = mysqli_fetch_assoc($current);

if (isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $description = mysqli_real_escape_string($conn, trim($_POST['description']));

    mysqli_query($conn, "UPDATE categories 
        SET description='$description' 
        WHERE category_id='$category_id'");

    header("Location: view_categories.php");
    exit();
}
?>

<div class="form-page">
    <div class="form-card">

        <h1>Edit Category</h1>
        <p>Select category and update its description.</p>

        <form method="POST">

            <div class="form-group">
                <label>Select Category</label>
                <select name="category_id" required>
                    <option value="">-- Select Category --</option>

                    <?php while($cat = mysqli_fetch_assoc($cat_result)) { ?>
                        <option value="<?php echo $cat['category_id']; ?>"
                            <?php if($cat['category_id'] == $id) echo "selected"; ?>>
                            <?php echo $cat['category_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Category Description</label>
                <textarea name="description" required><?php echo $row['description']; ?></textarea>
            </div>

            <button type="submit" name="update_category">Update Category</button>

        </form>

        <a href="view_categories.php" class="back-link">← Back to Categories</a>

    </div>
</div>

<?php include('includes/footer.php'); ?>
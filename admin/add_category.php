<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['add_category'])){

    $category_name = mysqli_real_escape_string($conn, trim($_POST['category_name']));
    $category_description = mysqli_real_escape_string($conn, trim($_POST['category_description']));

    if($category_name == "" || $category_description == ""){
        $message = "<div class='error-msg'>All fields are required.</div>";
    } else {

        $query = "INSERT INTO categories (category_name, category_description)
                  VALUES ('$category_name', '$category_description')";

        if(mysqli_query($conn, $query)){
            $message = "<div class='success-msg'>Category added successfully.</div>";
        } else {
            $message = "<div class='error-msg'>SQL Error: ".mysqli_error($conn)."</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<div class="admin-header">
    <div>
        <h2>🛒 ShopCart Admin</h2>
        <span>Welcome, <?php echo $_SESSION['admin_name']; ?></span>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="form-container">
    <div class="form-card">

        <h1>📂 Add Category</h1>
        <p>Create a new product category for your store.</p>

        <?php echo $message; ?>

        <form method="POST">

            <label>Category Name</label>
            <input type="text"
                   name="category_name"
                   placeholder="Enter category name"
                   required>

            <label>Category Description</label>
            <textarea name="category_description"
                      placeholder="Enter category description"
                      required></textarea>

            <button type="submit" name="add_category">
                Add Category
            </button>

        </form>

        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    </div>
</div>

</body>
</html>
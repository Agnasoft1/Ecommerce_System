<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "
    SELECT category_id, category_name, description, created_at
    FROM categories
    ORDER BY category_id DESC
");

if(!$result){
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Categories</title>
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
    <div class="table-card">

        <div class="page-title-row">
            <div>
                <h1>📁 View Categories</h1>
                <p>Manage, edit and delete your product categories.</p>
            </div>

            <a href="add_category.php" class="add-btn">+ Add Category</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit_category.php?id=<?php echo $row['category_id']; ?>" class="edit-btn">Edit</a>
                        <a href="delete_category.php?id=<?php echo $row['category_id']; ?>"
                           class="delete-btn"
                           onclick="return confirm('Are you sure you want to delete this category?');">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    </div>
</div>

</body>
</html>
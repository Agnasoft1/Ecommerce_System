<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include('../src/dbcon.php');

$category_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM categories"))['total'];
$product_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM products"))['total'];
$customer_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM customers"))['total'];
$distributor_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM distributors"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>ShopCart Admin Dashboard</title>
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

<div class="dashboard-container">

    <div class="welcome-banner">
        <h2>👋 Welcome Back, <?php echo $_SESSION['admin_name']; ?></h2>
        <p>Manage your ecommerce store, products, orders and distributors.</p>
    </div>

    <div class="dashboard-title">
        <h1>Admin Dashboard</h1>
        <p>Complete control panel for your ecommerce project.</p>
    </div>

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon">📂</div>
            <h3><?php echo $category_count; ?></h3>
            <p>Total Categories</p>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <h3><?php echo $product_count; ?></h3>
            <p>Total Products</p>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <h3><?php echo $customer_count; ?></h3>
            <p>Total Customers</p>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🤝</div>
            <h3><?php echo $distributor_count; ?></h3>
            <p>Total Distributors</p>
        </div>

    </div>

    <h2 class="section-heading">Management Panel</h2>

    <div class="menu-grid">

        <a href="add_admin.php" class="menu-card">
            <h3>👨‍💼 Add Admin</h3>
            <p>Create new administrator</p>
        </a>

        <a href="view_admins.php" class="menu-card">
            <h3>🛡️ View Admins</h3>
            <p>Manage admin accounts</p>
        </a>

        <a href="add_category.php" class="menu-card">
            <h3>📂 Add Category</h3>
            <p>Create product category</p>
        </a>

        <a href="view_categories.php" class="menu-card">
            <h3>📁 Categories</h3>
            <p>Edit and delete categories</p>
        </a>

        <a href="add_product.php" class="menu-card">
            <h3>📦 Add Product</h3>
            <p>Add new store product</p>
        </a>

        <a href="view_products.php" class="menu-card">
            <h3>🛒 Products</h3>
            <p>Manage all products</p>
        </a>

        <a href="add_distributor.php" class="menu-card">
            <h3>🤝 Add Distributor</h3>
            <p>Create distributor account</p>
        </a>

        <a href="view_distributors.php" class="menu-card">
            <h3>📊 Distributors</h3>
            <p>Manage distributor records</p>
        </a>

        <a href="view_customers.php" class="menu-card">
            <h3>👥 Customers</h3>
            <p>View customer details</p>
        </a>

        <a href="view_orders.php" class="menu-card">
            <h3>📋 Orders</h3>
            <p>Track customer orders</p>
        </a>

    </div>

</div>

</body>
</html>
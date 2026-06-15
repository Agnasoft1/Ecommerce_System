<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopCart Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css?v=<?php echo filemtime('assets/css/admin.css'); ?>">
</head>
<body>

<div class="admin-header">
    <h2>ShopCart Admin</h2>
    <div>
        <span><?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></span>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="content">
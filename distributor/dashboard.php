<?php
session_start();
include("../src/dbcon.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distributor Dashboard</title>
    <link rel="stylesheet" href="assets/css/distributor.css">
</head>
<body>

<div class="dashboard-wrapper">

<?php include("includes/header.php"); ?>

<div class="panel-layout">

<?php include("includes/sidebar.php"); ?>

<div class="main-content">

    <div class="welcome-banner">
        <h2>Dashboard Overview</h2>
        <p>Track your orders, commission amount, key requests, and profile details.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Orders</h3>
            <p>0</p>
        </div>

        <div class="stat-card">
            <h3>Total Sales</h3>
            <p>₹0</p>
        </div>

        <div class="stat-card">
            <h3>Commission</h3>
            <p>₹0</p>
        </div>

        <div class="stat-card">
            <h3>Pending Keys</h3>
            <p>0</p>
        </div>
    </div>

    <h2 class="section-title">Quick Actions</h2>

    <div class="menu-grid">
        <a href="orders.php" class="menu-card">
            <h3>📦 Orders</h3>
            <p>View customer orders linked with your distributor code.</p>
        </a>

        <a href="commissions.php" class="menu-card">
            <h3>💰 Commission Amount</h3>
            <p>Check earned, paid, and pending commission amount.</p>
        </a>

        <a href="key_requests.php" class="menu-card">
            <h3>🔑 Key Requests</h3>
            <p>Request product activation or license keys.</p>
        </a>

        <a href="profile.php" class="menu-card">
            <h3>👤 Profile</h3>
            <p>View your distributor account information.</p>
        </a>
    </div>

</div>

</div>

<?php include("includes/footer.php"); ?>

</div>

</body>
</html>
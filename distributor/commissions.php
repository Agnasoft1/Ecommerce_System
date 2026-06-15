<?php
session_start();
include("../src/dbcon.php");

$distributor_id = $_SESSION['distributor_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Commission Amount</title>
    <link rel="stylesheet" href="assets/css/distributor.css">
</head>
<body>

<div class="dashboard-wrapper">

<?php include("includes/header.php"); ?>

<div class="panel-layout">

<?php include("includes/sidebar.php"); ?>

<div class="main-content">

    <div class="welcome-banner">
        <h2>Commission Amount</h2>
        <p>View your earned, paid, and pending commission amount.</p>
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
            <h3>Total Earned</h3>
            <p>₹0</p>
        </div>

        <div class="stat-card">
            <h3>Pending Amount</h3>
            <p>₹0</p>
        </div>

    </div>

    <div class="table-card">

        <div class="page-title-row">
            <div>
                <h1>Commission History</h1>
                <p>Order-wise commission details</p>
            </div>
        </div>

        <table>
            <tr>
                <th>Commission ID</th>
                <th>Order ID</th>
                <th>Order Amount</th>
                <th>Commission Amount</th>
                <th>Payment Status</th>
                <th>Date</th>
            </tr>

            <tr>
                <td>#C1001</td>
                <td>#1001</td>
                <td>₹5,000</td>
                <td>₹500</td>
                <td><span class="status-pending">Pending</span></td>
                <td>2026-06-09</td>
            </tr>

        </table>

    </div>

</div>

</div>

<?php include("includes/footer.php"); ?>

</div>

</body>
</html>
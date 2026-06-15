<?php
session_start();
include("../src/dbcon.php");

$distributor_id = $_SESSION['distributor_id'];

/*
Later we will connect this with orders table.
For now page design is ready.
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distributor Orders</title>
    <link rel="stylesheet" href="assets/css/distributor.css">
</head>
<body>

<div class="dashboard-wrapper">

<?php include("includes/header.php"); ?>

<div class="panel-layout">

<?php include("includes/sidebar.php"); ?>

<div class="main-content">

    <div class="welcome-banner">
        <h2>Orders</h2>
        <p>View all orders connected with your distributor code.</p>
    </div>

    <div class="table-card">

        <div class="page-title-row">
            <div>
                <h1>Order List</h1>
                <p>Customer orders and commission details</p>
            </div>
        </div>

        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Order Amount</th>
                <th>Commission</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <tr>
                <td>#1001</td>
                <td>Sample Customer</td>
                <td>₹5,000</td>
                <td>₹500</td>
                <td><span class="status-paid">Completed</span></td>
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
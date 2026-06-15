<?php
session_start();
include("../src/dbcon.php");

/*
Later we will insert into
key_requests table
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Key Requests</title>
    <link rel="stylesheet" href="assets/css/distributor.css">
</head>
<body>

<div class="dashboard-wrapper">

<?php include("includes/header.php"); ?>

<div class="panel-layout">

<?php include("includes/sidebar.php"); ?>

<div class="main-content">

    <div class="welcome-banner">
        <h2>License Key Requests</h2>
        <p>Request activation keys for products.</p>
    </div>

    <div class="form-card">

        <h1>Request Key</h1>

        <form method="POST">

            <label>Product Name</label>
            <input type="text"
                   name="product_name"
                   required>

            <label>Quantity</label>
            <input type="number"
                   name="quantity"
                   min="1"
                   required>

            <label>Remarks</label>
            <textarea
                name="remarks"></textarea>

            <button type="submit">
                Submit Request
            </button>

        </form>

    </div>

    <div class="table-card">

        <div class="page-title-row">

            <div>
                <h1>Request History</h1>
                <p>Track all key requests</p>
            </div>

        </div>

        <table>

            <tr>
                <th>Request ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <tr>
                <td>#KR001</td>
                <td>ERP Software</td>
                <td>5</td>
                <td>
                    <span class="status-pending">
                        Pending
                    </span>
                </td>
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
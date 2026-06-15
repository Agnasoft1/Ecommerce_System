<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "
    SELECT *
    FROM customers
    ORDER BY customer_id DESC
");

if(!$result){
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Customers</title>
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
                <h1>👥 View Customers</h1>
                <p>All registered customers in your ecommerce store.</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Created At</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $row['customer_id']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    </div>
</div>

</body>
</html>
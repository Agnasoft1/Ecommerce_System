<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn,"
SELECT
    o.id,
    c.customer_name,
    c.phone,
    o.total_amount,
    o.status,
    o.order_date
FROM orders o
LEFT JOIN customers c
ON o.customer_id = c.customer_id
ORDER BY o.id DESC
");

if(!$result){
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
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
                <h1>📋 View Orders</h1>
                <p>Manage customer orders.</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>

                    <td>
                        <?php echo $row['customer_name'] ?? 'Unknown'; ?>
                    </td>

                    <td>
                        <?php echo $row['phone'] ?? '-'; ?>
                    </td>

                    <td>
                        <strong>₹<?php echo number_format($row['total_amount'], 2); ?></strong>
                    </td>

                    <td>
                        <?php
                        if($row['status'] == "Pending"){
                            echo "<span class='status-pending'>Pending</span>";
                        }
                        elseif($row['status'] == "Paid"){
                            echo "<span class='status-paid'>Paid</span>";
                        }
                        elseif($row['status'] == "Completed"){
                            echo "<span class='status-paid'>Completed</span>";
                        }
                        else{
                            echo "<span class='status-other'>".$row['status']."</span>";
                        }
                        ?>
                    </td>

                    <td><?php echo $row['order_date']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    </div>
</div>

</body>
</html>
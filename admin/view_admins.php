<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$admins = mysqli_query($conn, "SELECT id, username, created_at FROM admins ORDER BY id DESC");

if(!$admins){
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Admins</title>
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

        <h1>🛡️ All Admins</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Created At</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($admins)){ ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php } ?>
        </table>

        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    </div>
</div>

</body>
</html>
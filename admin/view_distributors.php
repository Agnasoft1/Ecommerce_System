<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "
    SELECT *
    FROM distributors
    ORDER BY id DESC
");

if(!$result){
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Distributors</title>
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
                <h1>🤝 View Distributors</h1>
                <p>Manage distributor details and commission.</p>
            </div>

            <a href="add_distributor.php" class="add-btn">+ Add Distributor</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Distributor Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Commission</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['commission']; ?>%</td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit_distributor.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                        <a href="delete_distributor.php?id=<?php echo $row['id']; ?>" 
                           class="delete-btn"
                           onclick="return confirm('Delete this distributor?');">
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
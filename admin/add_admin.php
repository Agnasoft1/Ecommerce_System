<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['add_admin'])){
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = md5($_POST['password']);

    $check = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username'");

    if(mysqli_num_rows($check) > 0){
        $message = "<div class='error-msg'>Username already exists</div>";
    } else {
        mysqli_query($conn, "INSERT INTO admins(username,password) VALUES('$username','$password')");
        $message = "<div class='success-msg'>Admin created successfully</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
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
    <div class="form-card">

        <h1>👨‍💼 Create Admin</h1>
        <p>Create and manage administrator accounts for ShopCart.</p>

        <?php echo $message; ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter Username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit" name="add_admin">Create Admin</button>
        </form>

        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    </div>
</div>

</body>
</html>
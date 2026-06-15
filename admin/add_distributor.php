<?php
session_start();
include('../src/dbcon.php');

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['add_distributor'])){

    $distributor_name = mysqli_real_escape_string($conn, trim($_POST['distributor_name']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $password = md5($_POST['password']);
    $distributor_key = mysqli_real_escape_string($conn, strtoupper(trim($_POST['distributor_key'])));
    $discount_percent = mysqli_real_escape_string($conn, $_POST['discount_percent']);

    if($distributor_name == "" || $phone == "" || $password == "" || $distributor_key == "" || $discount_percent == ""){
        $message = "<div class='error-msg'>All fields are required.</div>";
    }
    elseif(!preg_match('/^[6-9][0-9]{9}$/', $phone)){
        $message = "<div class='error-msg'>Enter valid 10 digit phone number.</div>";
    }
    else{
        $check = mysqli_query($conn, "SELECT * FROM distributors WHERE distributor_key='$distributor_key' OR phone='$phone'");

        if(mysqli_num_rows($check) > 0){
            $message = "<div class='error-msg'>Phone number or distributor key already exists.</div>";
        }
        else{
            $query = "INSERT INTO distributors
            (distributor_name, phone, password, distributor_key, discount_percent)
            VALUES
            ('$distributor_name','$phone','$password','$distributor_key','$discount_percent')";

            if(mysqli_query($conn, $query)){
                $message = "<div class='success-msg'>Distributor added successfully.</div>";
            }else{
                $message = "<div class='error-msg'>SQL Error: ".mysqli_error($conn)."</div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Distributor</title>
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

        <h1>🤝 Add Distributor</h1>
        <p>Create distributor account and discount key.</p>

        <?php echo $message; ?>

        <form method="POST">

            <label>Distributor Name</label>
            <input type="text" name="distributor_name" placeholder="Enter distributor name" required>

            <label>Phone Number</label>
            <input type="text" name="phone" placeholder="Enter 10 digit phone number" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>

            <label>Distributor Key</label>
            <input type="text" name="distributor_key" placeholder="Example: DIST10" required>

            <label>Discount Percent</label>
            <input type="number" name="discount_percent" min="0" max="100" placeholder="Enter discount %" required>

            <button type="submit" name="add_distributor">
                🤝 Add Distributor
            </button>

        </form>

        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

    </div>
</div>

</body>
</html>
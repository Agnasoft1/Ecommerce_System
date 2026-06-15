<?php
session_start();
include("../src/dbcon.php");

$error = "";

if(isset($_POST['login'])){
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM distributors 
                                  WHERE phone='$phone' 
                                  AND password='$password'");

    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);

        $_SESSION['distributor_id'] = $row['distributor_id'];
        $_SESSION['distributor_name'] = $row['name'];

        header("Location: dashboard.php");
        exit();
    }else{
        $error = "Invalid phone number or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distributor Login</title>
    <link rel="stylesheet" href="assets/css/distributor.css">
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h2>Distributor Login</h2>
        <p>Access your distributor dashboard</p>

        <?php if($error != ""){ ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="phone" placeholder="Enter Phone Number" required>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>

</body>
</html>
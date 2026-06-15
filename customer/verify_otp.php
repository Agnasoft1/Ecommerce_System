<?php
include("../src/dbcon.php");
include("../includes/header.php");

$message = "";

if(!isset($_SESSION['otp_phone'])){
    header("Location: register.php");
    exit();
}

$phone = $_SESSION['otp_phone'];

if(isset($_POST['verify'])){

    $entered_otp = mysqli_real_escape_string($conn, trim($_POST['otp']));

    $check = mysqli_query($conn, "SELECT * FROM customer_otp 
    WHERE phone='$phone' AND otp='$entered_otp'");

    if(mysqli_num_rows($check) > 0){

        $row = mysqli_fetch_assoc($check);

        $name = mysqli_real_escape_string($conn, $row['name']);
        $phone = mysqli_real_escape_string($conn, $row['phone']);
        $password = mysqli_real_escape_string($conn, $row['password']);

        $insert = mysqli_query($conn, "INSERT INTO customers
        (name, phone, password)
        VALUES
        ('$name', '$phone', '$password')");

        if(!$insert){
            die("Customer Insert Error: " . mysqli_error($conn));
        }

        mysqli_query($conn, "DELETE FROM customer_otp WHERE phone='$phone'");

        unset($_SESSION['otp_phone']);
        unset($_SESSION['register_otp']);

        echo "<script>
            alert('Registration successful. Please login.');
            window.location='login.php';
        </script>";
        exit();

    }else{
        $message = "Invalid OTP. Please try again.";
    }
}
?>

<div class="form-box">
    <h1>Verify OTP</h1>

    <?php if($message!=""){ ?>
        <div class="error-msg"><?php echo $message; ?></div>
    <?php } ?>

    <form method="POST">

        <input type="text" 
               name="otp" 
               placeholder="Enter OTP" 
               maxlength="6" 
               required>

        <button type="submit" name="verify">Verify OTP</button>

    </form>
<p>
    Didn't receive OTP?
    <a href="resend_otp.php">Resend OTP</a>
</p>

<p>
    Entered wrong number?
    <a href="register.php">Change Number</a>
</p>
</div>

<?php include("../includes/footer.php"); ?>
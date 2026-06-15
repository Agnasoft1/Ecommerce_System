<?php
include("../src/dbcon.php");
include("../includes/header.php");

$message = "";

function generateCaptcha($length = 5){
    $letters = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    $numbers = '23456789';

    $captcha = '';
    $captcha .= $letters[rand(0, strlen($letters)-1)];
    $captcha .= $numbers[rand(0, strlen($numbers)-1)];

    $chars = $letters . $numbers;

    for($i = 2; $i < $length; $i++){
        $captcha .= $chars[rand(0, strlen($chars)-1)];
    }

    return strtoupper(str_shuffle($captcha));
}

if(!isset($_SESSION['captcha'])){
    $_SESSION['captcha'] = generateCaptcha();
}

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $password = trim($_POST['password']);

    $captcha = strtoupper(str_replace(' ', '', trim($_POST['captcha'])));
    $session_captcha = strtoupper(str_replace(' ', '', $_SESSION['captcha']));

    if(!preg_match("/^[6-9][0-9]{9}$/", $phone)){
        $message = "Enter valid 10 digit phone number starting with 6,7,8,9.";
    }
    elseif($captcha != $session_captcha){
        $message = "Invalid captcha. Please try again.";
        $_SESSION['captcha'] = generateCaptcha();
    }
    elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)){
        $message = "Password must contain uppercase, lowercase, number and minimum 8 characters.";
    }
    else{

        $check = mysqli_query($conn,"SELECT * FROM customers WHERE phone='$phone'");

        if(mysqli_num_rows($check)>0){
            $message = "Phone number already registered.";
        }
        else{

            $otp = rand(100000,999999);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $otp_expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

            mysqli_query($conn,"DELETE FROM customer_otp WHERE phone='$phone'");

            $insert = mysqli_query($conn,"INSERT INTO customer_otp
            (name, phone, password, otp, otp_expiry)
            VALUES
            ('$name', '$phone', '$hashed_password', '$otp', '$otp_expiry')");

            if(!$insert){
                die("OTP Insert Error: " . mysqli_error($conn));
            }

            $_SESSION['register_otp'] = $otp;
            $_SESSION['otp_phone'] = $phone;
            $_SESSION['captcha'] = generateCaptcha();

            echo "<script>
                alert('Your Test OTP: $otp');
                window.location='verify_otp.php';
            </script>";
            exit();
        }
    }
}
?>

<div class="form-box">
    <h1>Customer Register</h1>

    <?php if($message!=""){ ?>
        <div class="error-msg"><?php echo $message; ?></div>
    <?php } ?>

    <form method="POST">

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="text" name="phone" placeholder="Phone Number" maxlength="10" required>

        <div class="password-wrapper">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span class="eye-icon" onclick="togglePassword()">👁</span>
        </div>

        <div class="captcha-box">
            <div class="captcha-display">
                <?php echo $_SESSION['captcha']; ?>
            </div>

            <input type="text" name="captcha" placeholder="Enter Captcha" required>
        </div>

        <button type="submit" name="register">Send OTP</button>

    </form>

    <p>Already have account?
        <a href="login.php">Login</a>
    </p>
</div>

<script>
function togglePassword(){
    var x = document.getElementById("password");
    var eye = document.querySelector(".eye-icon");

    if(x.type === "password"){
        x.type = "text";
        eye.innerHTML = "🙈";
    }else{
        x.type = "password";
        eye.innerHTML = "👁";
    }
}
</script>

<?php include("../includes/footer.php"); ?>
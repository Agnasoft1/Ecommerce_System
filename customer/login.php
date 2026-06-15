<?php
include("../src/dbcon.php");

$message = "";

if(isset($_POST['login']))
{
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $password = trim($_POST['password']);

    $query = mysqli_query($conn,
    "SELECT * FROM customers WHERE phone='$phone'");

    if(mysqli_num_rows($query) > 0)
    {
        $user = mysqli_fetch_assoc($query);

        if(password_verify($password, $user['password']) || $password == $user['password'])
        {
            $_SESSION['customer_id'] = $user['customer_id'];
            $_SESSION['customer_name'] = $user['customer_name'];

            header("Location: delivery_address.php");
            exit();
        }
        else
        {
            $message = "Invalid Password";
        }
    }
    else
    {
        $message = "Phone Number Not Registered";
    }
}

include("../includes/header.php");
?>

<div class="form-box">

    <h1>Customer Login</h1>

    <?php if($message!=""){ ?>
        <div class="error-msg">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <input type="text"
               name="phone"
               placeholder="Phone Number"
               maxlength="10"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <p>
        New Customer?
        <a href="register.php">Register</a>
    </p>

</div>

<?php include("../includes/footer.php"); ?>
<?php
include("../src/dbcon.php");
include("../includes/header.php");

$session_id = session_id();

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: cart.php");
    exit();
}

$grand_total = $_POST['grand_total'];
$discount_code = trim($_POST['discount_code']);

$discount_amount = 0;
$final_amount = $grand_total;
$message = "";

if ($discount_code != "") {

    $code_query = mysqli_query($conn,
    "SELECT * FROM distributors WHERE distributor_key='$discount_code'");

    if(mysqli_num_rows($code_query) > 0){

        $code = mysqli_fetch_assoc($code_query);

        $discount_percent = $code['discount_percent'];

        $discount_amount =
        ($grand_total * $discount_percent) / 100;

        $final_amount =
        $grand_total - $discount_amount;

        $_SESSION['discount_code'] = $discount_code;
        $_SESSION['discount_amount'] = $discount_amount;
        $_SESSION['final_amount'] = $final_amount;

    } else {

        $message = "Invalid Distributor Key";

        $_SESSION['discount_amount'] = 0;
        $_SESSION['final_amount'] = $grand_total;
    }
}

$_SESSION['grand_total'] = $grand_total;
?>

<div class="page-container">

    <div class="checkout-box">

        <h1>Checkout Summary</h1>

        <?php if($message != "") { ?>
            <div class="error-msg"><?php echo $message; ?></div>
        <?php } ?>

        <div class="summary-row">
            <span>Grand Total</span>
            <b>₹<?php echo number_format($grand_total,2); ?></b>
        </div>

        <div class="summary-row">
            <span>Discount Amount</span>
            <b class="green">- ₹<?php echo number_format($discount_amount,2); ?></b>
        </div>

        <div class="summary-row final">
            <span>Final Amount</span>
            <b>₹<?php echo number_format($final_amount,2); ?></b>
        </div>

        <?php if(isset($_SESSION['customer_id'])) { ?>
            <a href="delivery_address.php" class="checkout-btn">Continue to Delivery Address</a>
        <?php } else { ?>
            <div class="login-choice">
                <p>Please login or register to continue checkout.</p>
                <a href="login.php" class="checkout-btn">Login</a>
                <a href="register.php" class="outline-btn">Register</a>
            </div>
        <?php } ?>

    </div>

</div>

<?php include("../includes/footer.php"); ?>
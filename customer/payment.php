<?php
include("../src/dbcon.php");
include("../includes/header.php");

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_SESSION['address_id'])){
    header("Location: delivery_address.php");
    exit();
}

if(!isset($_SESSION['final_amount'])){
    header("Location: checkout.php");
    exit();
}

$final_amount = $_SESSION['final_amount'];
?>

<div class="page-container">
    <div class="payment-box">
        <h1>Payment</h1>

        <div class="pay-amount">
            Payable Amount:
            <b>₹<?php echo number_format($final_amount, 2); ?></b>
        </div>

        <form method="POST" action="cashfree_payment.php">
            <button type="submit" name="pay_now">
                Pay with Cashfree
            </button>
        </form>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
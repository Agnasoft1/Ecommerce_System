<?php
include("../src/dbcon.php");
include("../includes/header.php");

if(!isset($_GET['order_id'])){
    header("Location: categories.php");
    exit();
}

$order_id = $_GET['order_id'];

$order_query = mysqli_query($conn, "SELECT * FROM orders WHERE id='$order_id'");
$order = mysqli_fetch_assoc($order_query);

$payment_query = mysqli_query($conn, "SELECT * FROM payments WHERE order_id='$order_id'");
$payment = mysqli_fetch_assoc($payment_query);
?>

<div class="page-container">

    <div class="success-box">
        <div class="success-icon">✅</div>

        <h1>Order Placed Successfully</h1>

        <p>Your payment status is:</p>

        <h2><?php echo $payment['payment_status']; ?></h2>

        <div class="order-info">
            <p><b>Order ID:</b> #<?php echo $order_id; ?></p>
            <p><b>Payment Method:</b> <?php echo $payment['payment_method']; ?></p>
            <p><b>Total Paid:</b> ₹<?php echo number_format($payment['amount'],2); ?></p>
            <p><b>Order Status:</b> <?php echo $order['status']; ?></p>
        </div>

        <a href="categories.php" class="checkout-btn">Continue Shopping</a>
    </div>

</div>

<?php include("../includes/footer.php"); ?>
<?php
include("../src/dbcon.php");
include("../includes/header.php");

$session_id = session_id();

$cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE session_id='$session_id'");
$grand_total = 0;
?>

<div class="page-container">

    <div class="page-title">
        <h1>My Cart</h1>
        <p>Review your selected products and accessories.</p>
    </div>

    <div class="cart-box">

        <table class="cart-table">
            <tr>
                <th>Item</th>
                <th>Type</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($cart_query)) { 
                $total = $row['price'] * $row['quantity'];
                $grand_total += $total;
            ?>
            <tr>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['item_type']; ?></td>
                <td>₹<?php echo number_format($row['price'],2); ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>₹<?php echo number_format($total,2); ?></td>
            </tr>
            <?php } ?>

        </table>

        <div class="cart-summary">
            <h2>Order Summary</h2>
            <p>Grand Total: <b>₹<?php echo number_format($grand_total,2); ?></b></p>

            <form method="POST" action="checkout.php">
                <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">

                <label>Distributor Discount Code</label>
                <input type="text" name="discount_code" placeholder="Enter distributor code">

                <button type="submit">Proceed to Checkout</button>
            </form>
        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>
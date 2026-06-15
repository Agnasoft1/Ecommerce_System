<?php
include("../src/dbcon.php");

if(!isset($_SESSION['customer_id']))
{
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$message = "";

if(isset($_POST['save_address']))
{
    $receiver_name = mysqli_real_escape_string($conn,$_POST['receiver_name']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address_line1 = mysqli_real_escape_string($conn,$_POST['address_line1']);
    $address_line2 = mysqli_real_escape_string($conn,$_POST['address_line2']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $state = mysqli_real_escape_string($conn,$_POST['state']);
    $pincode = mysqli_real_escape_string($conn,$_POST['pincode']);
    $landmark = mysqli_real_escape_string($conn,$_POST['landmark']);

    $insert = mysqli_query($conn,"
    INSERT INTO delivery_address
    (
        customer_id,
        receiver_name,
        phone,
        address_line1,
        address_line2,
        city,
        state,
        pincode,
        landmark
    )
    VALUES
    (
        '$customer_id',
        '$receiver_name',
        '$phone',
        '$address_line1',
        '$address_line2',
        '$city',
        '$state',
        '$pincode',
        '$landmark'
    )");

    if(!$insert)
    {
        die(mysqli_error($conn));
    }

    $_SESSION['address_id'] = mysqli_insert_id($conn);

    header("Location: payment.php");
    exit();
}

include("../includes/header.php");
?>

<div class="page-container">

    <div class="address-box">

        <h1>Delivery Address</h1>

        <form method="POST">

            <input type="text"
                   name="receiver_name"
                   placeholder="Receiver Name"
                   required>

            <input type="text"
                   name="phone"
                   placeholder="Phone Number"
                   maxlength="10"
                   required>

            <input type="text"
                   name="address_line1"
                   placeholder="House No / Flat No"
                   required>

            <input type="text"
                   name="address_line2"
                   placeholder="Street / Area">

            <input type="text"
                   name="city"
                   placeholder="City"
                   required>

            <input type="text"
                   name="state"
                   placeholder="State"
                   required>

            <input type="text"
                   name="pincode"
                   placeholder="Pincode"
                   maxlength="6"
                   required>

            <input type="text"
                   name="landmark"
                   placeholder="Landmark">

            <button type="submit"
                    name="save_address">
                Save Address & Continue
            </button>

        </form>

    </div>

</div>

<?php include("../includes/footer.php"); ?>
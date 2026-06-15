<?php
include("../src/dbcon.php");
include("../config/cashfree_config.php");

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_SESSION['final_amount'])){
    header("Location: checkout.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$amount = $_SESSION['final_amount'];


mysqli_query($conn, "INSERT INTO orders
(customer_id, total_amount, status, order_date)
VALUES
('$customer_id', '$amount', 'Pending', NOW())");

$db_order_id = mysqli_insert_id($conn);

$cashfree_order_id = "ORDER_" . $db_order_id . "_" . time();

$data = [
    "order_id" => $cashfree_order_id,
    "order_amount" => (float)$amount,
    "order_currency" => "INR",
    "customer_details" => [
        "customer_id" => "CUST_" . $customer_id,
        "customer_name" => "Customer",
        "customer_email" => "customer@gmail.com",
        "customer_phone" => "9876543210"
    ],
    "order_meta" => [
        "return_url" => "http://localhost/ecommerce/customer/payment_success.php?order_id=$db_order_id&cf_order_id={order_id}"
    ]
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://sandbox.cashfree.com/pg/orders",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Accept: application/json",
        "x-client-id: $client_id",
        "x-client-secret: $client_secret",
        "x-api-version: 2023-08-01"
    ]
]);

$response = curl_exec($curl);
$error = curl_error($curl);
curl_close($curl);

if($error){
    echo "Curl Error: " . $error;
    exit();
}

$result = json_decode($response, true);

if(!isset($result['payment_session_id'])){
    echo "<pre>";
    print_r($result);
    echo "</pre>";
    exit();
}

$payment_session_id = $result['payment_session_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cashfree Payment</title>
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
</head>
<body>

<script>
const cashfree = Cashfree({
    mode: "sandbox"
});

cashfree.checkout({
    paymentSessionId: "<?php echo $payment_session_id; ?>",
    redirectTarget: "_self"
});
</script>

</body>
</html>
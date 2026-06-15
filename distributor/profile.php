<?php
session_start();
include("../src/dbcon.php");

if(!isset($_SESSION['distributor_id']))
{
    header("Location: login.php");
    exit();
}

$distributor_id = $_SESSION['distributor_id'];

$query = mysqli_query($conn,
"SELECT * FROM distributors
WHERE distributor_id='$distributor_id'");

$data = mysqli_fetch_assoc($query);

$name = $data['distributor_name'] ?? '';
$phone = $data['phone'] ?? '';
$key = $data['distributor_key'] ?? '';
$discount = $data['discount_percent'] ?? 0;
$created = $data['created_at'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distributor Profile</title>
    <link rel="stylesheet" href="assets/css/distributor.css">
</head>
<body>

<div class="dashboard-wrapper">

    <?php include("includes/header.php"); ?>

    <div class="panel-layout">

        <?php include("includes/sidebar.php"); ?>

        <div class="main-content">

            <div class="welcome-banner">
                <h2>My Profile</h2>
                <p>View your distributor account details.</p>
            </div>

            <div class="profile-card">

                <div class="profile-icon">
                    👤
                </div>

                <h2><?php echo $name; ?></h2>
                <p class="profile-role">
                    Distributor Account
                </p>

                <div class="profile-details">

                    <div>
                        <strong>Distributor Name</strong>
                        <span><?php echo $name; ?></span>
                    </div>

                    <div>
                        <strong>Phone Number</strong>
                        <span><?php echo $phone; ?></span>
                    </div>

                    <div>
                        <strong>Distributor Key</strong>
                        <span><?php echo $key; ?></span>
                    </div>

                    <div>
                        <strong>Discount Percent</strong>
                        <span><?php echo $discount; ?>%</span>
                    </div>

                    <div>
                        <strong>Joined Date</strong>
                        <span><?php echo $created; ?></span>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php include("includes/footer.php"); ?>

</div>

</body>
</html>
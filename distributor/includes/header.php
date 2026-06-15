<?php
if(!isset($_SESSION['distributor_id'])){
    header("Location: login.php");
    exit();
}
?>

<div class="dist-header">
    <div>
        <h1>Distributor Portal</h1>
        <p>Welcome, <?php echo $_SESSION['distributor_name']; ?></p>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
</div>
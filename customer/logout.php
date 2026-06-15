<?php
include("../src/dbcon.php");

unset($_SESSION['customer_id']);
unset($_SESSION['customer_name']);

header("Location: login.php");
exit();
?>
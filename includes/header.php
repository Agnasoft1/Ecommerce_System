<!DOCTYPE html>
<html>
<head>
    <title>ShopCart</title>
  <link rel="stylesheet" href="/ecommerce/assets/css/style.css?v=10">
</head>
<body>

<header class="main-header">
    <div class="logo">
        <a href="index.php">ShopCart</a>
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="categories.php">Categories</a>
        <a href="cart.php">Cart</a>

        <?php if(isset($_SESSION['customer_id'])) { ?>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } ?>
    </nav>
</header>
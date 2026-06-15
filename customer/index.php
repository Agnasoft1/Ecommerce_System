<?php
include("../src/dbcon.php");
include("../includes/header.php");
?>

<div class="index-wrapper">

    <section class="home-hero">
        <div class="hero-left">
            <p class="hero-tag">Best Online Shopping Experience</p>
            <h1>Shop Smart with <span>ShopCart</span></h1>
            <p class="hero-desc">
                Choose products, add related accessories, apply distributor discount codes,
                and checkout safely with delivery and payment options.
            </p>
            <a href="categories.php" class="hero-btn">Start Shopping</a>
        </div>

        <div class="hero-right">
            <h2>Why Choose Us?</h2>

            <div class="why-box">
                <h3>Fast Delivery</h3>
                <p>Quick and secure delivery.</p>
            </div>

            <div class="why-box">
                <h3>Best Discount</h3>
                <p>Apply distributor code easily.</p>
            </div>

            <div class="why-box">
                <h3>Easy Payment</h3>
                <p>Simple and safe checkout.</p>
            </div>
        </div>
    </section>

    <section class="feature-section">
        <div class="feature-card">
            <span>🛍️</span>
            <h3>Product Categories</h3>
            <p>Browse products category-wise with clean product cards.</p>
        </div>

        <div class="feature-card">
            <span>🎧</span>
            <h3>Related Accessories</h3>
            <p>Add matching accessories with selected products.</p>
        </div>

        <div class="feature-card">
            <span>🔐</span>
            <h3>Secure Checkout</h3>
            <p>Login, address, discount and payment in one smooth flow.</p>
        </div>
    </section>

</div>

<?php include("../includes/footer.php"); ?>
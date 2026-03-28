<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_cart_shop.css">

</head>

<body>
    <?php include("includes/header.php"); ?>


    <?php include("includes/cart_shop.php"); ?>
    <div class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Explore Premium Shoes</h1>
                <div class="hero-buttons">
                    <button class="btn-shop">Shop now</button>
                    <button class="btn-categories">Categories</button>
                </div>
            </div>
            <div class="hero-card">
                <img
                    src="https://cdn.prod.website-files.com/6890fbf29f28b7089b169c21/6891ed3ee3d93ad17e2c0430_hero-product.jpg">
                <button>Explore New Arrivals</button>
            </div>
        </div>
    </div>

    <section class="features">
        <div class="feature-item">
            <div class="feature-icon"><img
                    src="<?= BASE_URL ?>/assets/images/icons/6892144f750bf17c33b635e7_recycling-reproducing-svgrepo-com 1.svg"
                    alt=""></div>
            <h3 class="feature-title">Sustainable Materials</h3>
            <p class="feature-text">We believe great style shouldn’t come at the planet’s expense.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><img
                    src="<?= BASE_URL ?>/assets/images/icons/689214509e45233c0eac2f63_warranty-svgrepo-com 1.svg"
                    alt=""></div>
            <h3 class="feature-title">Warranty Included</h3>
            <p class="feature-text">Every pair comes with a hassle-free 6-month warranty</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><img
                    src="<?= BASE_URL ?>/assets/images/icons/68921450b524ed88c4868689_delivery-fast-svgrepo.svg" alt="">
            </div>
            <h3 class="feature-title">Delivery & Shipping</h3>
            <p class="feature-text">Your shoes will be dispatched within 1–2 business days</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><img
                    src="<?= BASE_URL ?>/assets/images/icons/6892144f566712d4d864a312_eco-friendly-svgrepo-com 1.svg"
                    alt=""></div>
            <h3 class="feature-title">Eco-Friendly Fabrics</h3>
            <p class="feature-text">Crafted with sustainability in mind, our shoes feature eco-friendly fabrics</p>
        </div>
    </section>

    <section class="category-banners">
        <div class="category-banner1">
            <span class="banner-badge">20% OFF</span>
            <div class="banner-content">
                <h2>Explore All Formal Shoes</h2>
                <a href="<?= BASE_URL ?>/shop" class="banner-btn">Shop Now</a>
            </div>
        </div>
        <div class="category-banner2">
            <span class="banner-badge">25% OFF</span>
            <div class="banner-content">
                <h2>Grab The Latest Running Shoes</h2>
                <a href="<?= BASE_URL ?>/shop" class="banner-btn">Shop Now</a>
            </div>
        </div>
    </section>

    <div class="products-container">
        <div class="title-product-seller">
            <h2>Best Sellers</h2>
        </div>
        <div class="form-product-seller">
            <?php $count = 0;
            foreach ($products as $product):
            if($count >= 8) break;  ?>
            <div class=" product-seller">
                <div class="image">
                    <img src="<?= BASE_URL ?>/uploads/<?php echo $product["image"] ?>" alt="" width="250px">
                </div>
                <span class="name"><?php echo $product["name"] ?></span>
                <div class="price">
                    <span>$<?php echo number_format($product["discount_price"], 0, ",", "."); ?></span>
                    <span
                        class="old-price"><del>$<?php echo number_format($product["price"], 0, ",", "."); ?></del></span>
                </div>
            </div>
            <?php 
        $count++;
        endforeach; ?>
        </div>
    </div>

    <div class="form-slide">
        <div class="slider">
            <div class="slides">
                <img src="<?= BASE_URL ?>/assets/images/banners/689f6c65381608ffd59aca70_Offer-Frame-one.png"
                    class="slide">
                <img src="<?= BASE_URL ?>/assets/images/banners/689f6c65aacca81a46e142c0_Offer-Frame-two.png"
                    class="slide">
                <img src="<?= BASE_URL ?>/assets/images/banners/689f6c65b2cc4aa2b920c790_Offer-Frame-three.png"
                    class="slide">
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
    <script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>
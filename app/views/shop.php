<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_shop.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <h1>Explore Our Shop</h1>
        <div class="row">
            <div class="sidebar">
                <div class="dropdown">
                    <span href="" class="dropbtn">Categories</span>
                    <div class="dropdown-content">
                        <a href="#">All Products</a>
                        <a href="">Sneaker</a>
                        <a href="">Boots</a>
                        <a href="">Formal</a>
                        <a href="">Running</a>
                        <a href="">Oxford</a>
                        <a href="">Sports Shoe</a>
                        <a href="">High Neck</a>
                        <a href="">Loafers</a>

                    </div>
                </div>
                <div class="dropdown">
                    <span href="" class="dropbtn">Price Range</span>
                    <div class="dropdown-content">
                        <a href="">$0 - $50</a>
                        <a href="">$50 - $100</a>
                        <a href="">$100 - $200</a>
                        <a href="">$200 - $500</a>
                        <a href="">$500+</a>
                    </div>

                </div>
                <div class="dropdown">
                    <span href="" class="dropbtn">Color</span>
                    <div class="dropdown-content">
                        <a href="">Black</a>
                        <a href="">White</a>
                        <a href="">Red</a>
                        <a href="">Blue</a>
                        <a href="">Green</a>
                    </div>
                </div>
            </div>
            <div class="product">
                <video autoplay muted loop height="260px">
                    <source src="<?= BASE_URL ?>/uploads/sora1.mp4" type="video/mp4">
                </video>
                <?php foreach ($products as $product): ?>
                <div class=" product-card">
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
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>
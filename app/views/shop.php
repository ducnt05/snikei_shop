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
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_cart_shop.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/cart_shop.php"); ?>
    <div class="container">
        <h1>Explore Our Shop</h1>
        <div class="row">
            <div class="sidebar">
                <div class="dropdown">
                    <span href="" class="dropbtn">Categories</span>
                    <div class="dropdown-content">
                        <a href="<?= BASE_URL ?>/shop">All Products</a>
                        <a href="<?= BASE_URL ?>/category/sneakers">Sneaker</a>
                        <a href="<?= BASE_URL ?>/category/boots">Boots</a>
                        <a href="<?= BASE_URL ?>/category/formal">Formal</a>
                        <a href="<?= BASE_URL ?>/category/running">Running</a>
                        <a href="<?= BASE_URL ?>/category/oxford">Oxford</a>
                        <a href="<?= BASE_URL ?>/category/sports-shoe">Sports Shoe</a>
                        <a href="<?= BASE_URL ?>/category/high-neck">High Neck</a>
                        <a href="<?= BASE_URL ?>/category/loafers">Loafers</a>

                    </div>
                </div>
                <div class="dropdown">
                    <span href="" class="dropbtn">Price Range</span>
                    <div class="dropdown-content">
                        <a href="<?= BASE_URL ?>/price/0-50">$0 - $50</a>
                        <a href="<?= BASE_URL ?>/price/50-100">$50 - $100</a>
                        <a href="<?= BASE_URL ?>/price/100-200">$100 - $200</a>
                        <a href="<?= BASE_URL ?>/price/200-500">$200 - $500</a>
                        <a href="<?= BASE_URL ?>/price/500+">$500+</a>
                    </div>

                </div>
                <div class="dropdown">
                    <span href="" class="dropbtn">Color</span>
                    <div class="dropdown-content">
                        <a href="<?= BASE_URL ?>/color/black">Black</a>
                        <a href="<?= BASE_URL ?>/color/white">White</a>
                        <a href="<?= BASE_URL ?>/color/red">Red</a>
                        <a href="<?= BASE_URL ?>/color/blue">Blue</a>
                        <a href="<?= BASE_URL ?>/color/green">Green</a>
                    </div>
                </div>
            </div>
            <div class="product">
                <!-- <div class="video-wrapper">
                    <video autoplay muted loop>
                        <source src="<?= BASE_URL ?>/uploads/sora1.mp4" type="video/mp4">
                    </video>

                </div> -->

                <?php foreach ($products as $product): ?>
                <div class=" product-card">
                    <div class="image">
                        <a href="<?= BASE_URL ?>/shop?id=<?= $product['id'] ?>">
                            <img src="<?= BASE_URL ?>/uploads/<?php echo $product["image"] ?>" alt="" width="250px">
                        </a>
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
    <script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>
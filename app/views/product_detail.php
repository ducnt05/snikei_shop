<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Shop | Product Detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_product_detail.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_cart_shop.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/cart_shop.php"); ?>
    <div class="container">
        <div class="product-detail">
            <div class="product-left">
                <img src="<?= BASE_URL ?>/uploads/<?= $product['image'] ?>" alt="" width="500px">
            </div>
            <div class=" product-right">
                <div class="product-rating">
                    <div class="rating-stars-wrap"><img
                            src="https://cdn.prod.website-files.com/6890fbf29f28b7089b169c21/68a07e9e478c76ab436809ab_star-fill%20(1).svg"
                            loading="lazy" width="14" alt=""><img
                            src="https://cdn.prod.website-files.com/6890fbf29f28b7089b169c21/68a07e9e478c76ab436809ab_star-fill%20(1).svg"
                            loading="lazy" width="14" alt=""><img
                            src="https://cdn.prod.website-files.com/6890fbf29f28b7089b169c21/68a07e9e478c76ab436809ab_star-fill%20(1).svg"
                            loading="lazy" width="14" alt=""><img
                            src="https://cdn.prod.website-files.com/6890fbf29f28b7089b169c21/68a07e9e478c76ab436809ab_star-fill%20(1).svg"
                            loading="lazy" width="14" alt=""><img
                            src="https://cdn.prod.website-files.com/6890fbf29f28b7089b169c21/68a07e9eea1c3b89ccf0fe1b_star-half-fill.svg"
                            loading="lazy" width="14" height="14" alt=""></div>
                    <div class="reviews-count-wrap">
                        <div>(</div>
                        <div class="number-of-reviews">75</div>
                        <div>reviews</div>
                        <div>)</div>
                    </div>
                </div>
                <h1><?= $product['name'] ?></h1>
                <div class="price">
                    <span>$<?php echo number_format($product["discount_price"], 0, ",", "."); ?></span>
                    <span
                        class="old-price"><del>$<?php echo number_format($product["price"], 0, ",", "."); ?></del></span>
                </div>
                <div class="description">
                    <p><?= $product['description'] ?></p>
                </div>
                <div class="size">
                    <button>S</button>
                    <button>M</button>
                    <button>L</button>
                    <button>XL</button>
                    <button>XXL</button>
                </div>
                <form action="<?= BASE_URL ?>/process_addcart" method="POST">
                    <div class="btn-buy">
                        <input type="number" name="quantity" value="1" min="1">

                        <!-- gửi product_id -->
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
                        <button type="submit" class="buy">
                            Add to Cart <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </form>
                <div class="more-info">
                    <h3>More Info</h3>
                    <ul>
                        <li>
                            Available in a comprehensive range of sizes
                        </li>
                        <li>
                            Pre-softened for enhanced comfort and flexibility
                        </li>

                    </ul>
                </div>

            </div>
        </div>
        <div class="product-overview">
            <h2>Product Overview</h2>
            <p>Discover the perfect blend of style, comfort, and durability with our latest shoe collection — designed
                for everyday wear, but crafted to make a statement. Whether you're navigating city streets, heading to
                the office, or catching up with friends, these shoes are your go-to companion for every step.</p>
            <p>Made with premium materials and breathable lining, each pair ensures all-day comfort without compromising
                on design. The lightweight sole offers superior flexibility and shock absorption, reducing foot fatigue
                and keeping you energized throughout your day. Reinforced stitching and quality craftsmanship provide
                long-lasting wear, so your shoes look fresh—season after season.</p>
            <p>From modern minimalism to bold street-inspired looks, our collection is thoughtfully created to suit a
                variety of personal styles. Slip them on and experience a perfect fit, versatile design, and the
                confidence to move through life in comfort and style.</p>
            <ul>
                <li>All-day comfort with soft cushioning and ergonomic design</li>
                <li>Breathable materials to keep your feet cool and fresh</li>
                <li>Versatile style — perfect for work, weekends, or travel</li>
                <li>Lightweight sole for easy movement and reduced fatigue</li>
                <li>Premium craftsmanship with durable stitching and finishes</li>
            </ul>
        </div>

        <div class="product-review">
            <h2>Product Reviews</h2>
            <!-- Review content will be displayed here -->
            <?php
            $reviews = $reviews ?? [];
            $user = $user ?? [];
            $userNameById = array_column($user, 'name', 'id');
            ?>
            <?php foreach ($reviews as $review): ?>
            <div class="review">
                <div class="name-user"><img
                        src="https://png.pngtree.com/png-clipart/20250117/original/pngtree-account-avatar-user-abstract-circle-background-flat-color-icon-png-image_4965046.png"
                        alt="User Avatar" width="50px">
                    <h4><?= htmlspecialchars($userNameById[(int) ($review['user_id'] ?? 0)] ?? 'Unknown User', ENT_QUOTES, 'UTF-8') ?>
                    </h4>
                </div>

                <div class="rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span class="star <?= $i <= $review['rating'] ? 'filled' : '' ?>"><img
                            src="https://cdn.prod.website-files.com/6890fbf29f28b7089b169c21/68a07e9e478c76ab436809ab_star-fill%20(1).svg"
                            loading="lazy" width="20" alt=""></span>
                    <?php endfor; ?>
                </div>
                <p><?= $review['comment'] ?></p>
            </div>
            <?php endforeach; ?>
            <div class="form-review">
                <?php if (isset($_SESSION['user_id'])): ?>
                <form action=" <?= BASE_URL ?>/process_add_review" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

                    <h3>Write a Review</h3>
                    <div class="rating">

                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5" class="star"></label>

                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4" class="star"></label>

                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3" class="star"></label>

                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2" class="star"></label>

                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1" class="star"></label>
                    </div>
                    <input class="input-comment" type="text" name="comment" placeholder="Write your review here...">
                    <div class="btn-review">
                        <button type="submit">Submit Review</button>
                    </div>
                </form>
                <?php else: ?>
                <p>Please <a href="<?= BASE_URL ?>/login">login</a> to write a review.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="similar-product">
            <h2>Similar Products</h2>

            <div class="product">

                <?php foreach ($similarProduct as $similarProduct): ?>
                <div class=" product-card">
                    <div class="image">
                        <a href="<?= BASE_URL ?>/shop?id=<?= $similarProduct['id'] ?>">
                            <img src="<?= BASE_URL ?>/uploads/<?php echo $similarProduct["image"] ?>" alt=""
                                width="250px">
                        </a>
                    </div>
                    <span class="name"><?php echo $similarProduct["name"] ?></span>
                    <div class="price">
                        <span>$<?php echo number_format($similarProduct["discount_price"], 0, ",", "."); ?></span>
                        <span
                            class="old-price"><del>$<?php echo number_format($similarProduct["price"], 0, ",", "."); ?></del></span>
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
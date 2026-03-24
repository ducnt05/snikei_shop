<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_categories.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <h1>All Categories</h1>
        <div class="categories-list">
            <div class="card">
                <a href="<?= BASE_URL ?>/category/sneakers">
                    <img src="<?= BASE_URL ?>/assets/images/banners/sneakers.png" alt="">
                </a>
                <span>Sneakers</span>
            </div>
            <div class=" card">
                <a href="<?= BASE_URL ?>/category/boots">
                    <img src=" <?= BASE_URL ?>/assets/images/banners/boots.png" alt="">
                </a>
                <span>Boots</span>

            </div>
            <div class="card">
                <a href="<?= BASE_URL ?>/category/formal">
                    <img src="<?= BASE_URL ?>/assets/images/banners/formal.png" alt="">
                </a>
                <span>Formal</span>
            </div>
            <div class="card">
                <a href="<?= BASE_URL ?>/category/running">
                    <img src="<?= BASE_URL ?>/assets/images/banners/running.png" alt="">
                </a>
                <span>Running</span>
            </div>
            <div class="card">
                <a href="<?= BASE_URL ?>/category/oxford">
                    <img src="<?= BASE_URL ?>/assets/images/banners/oxford.png" alt="">
                </a>
                <span>Oxford</span>
            </div>
            <div class="card">
                <a href="<?= BASE_URL ?>/category/sports">
                    <img src="<?= BASE_URL ?>/assets/images/banners/sports.png" alt="">
                </a>
                <span>Sport Shoe</span>
            </div>
            <div class="card">
                <a href="<?= BASE_URL ?>/category/high-neck">
                    <img src="<?= BASE_URL ?>/assets/images/banners/high-neck.png" alt="">
                </a>
                <span>High Neck</span>
            </div>
            <div class="card">
                <a href="<?= BASE_URL ?>/category/loafers">
                    <img src="<?= BASE_URL ?>/assets/images/banners/loafer.png" alt="">
                </a>
                <span>Loafers</span>
            </div>
        </div>
    </div>


    <?php include("includes/footer.php"); ?>
</body>

</html>
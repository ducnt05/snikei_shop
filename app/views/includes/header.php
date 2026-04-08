<header class="header-container">

    <h1><a href="<?= BASE_URL ?>">SNIKEI</a></h1>

    <nav class="header-nav">
        <a href="<?= BASE_URL ?>/categories">Categories</a>
        <a href="<?= BASE_URL ?>/shop">Shop</a>
        <a href="<?= BASE_URL ?>/about">About</a>
        <a href="<?= BASE_URL ?>/blog">Blog</a>
        <a href="<?= BASE_URL ?>/contact">Contact</a>
    </nav>

    <div class="header-actions">
        <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>/profile"><i class="fa-solid fa-address-book"></i></a>
        <?php endif; ?>
        <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
        <a class="btn-cartshop"><i class="fa-solid fa-cart-shopping"></i></a>
        <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>/login"><i class="fa-solid fa-user"></i></a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>/logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        <?php endif; ?>
    </div>

</header>
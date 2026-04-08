<?php $year = date('Y'); ?>
<footer class="site-footer">
    <div class="footer-brand">
        <h3>SNIKEI</h3>
        <p>Curated footwear with a cleaner shopping experience, faster support, and simpler choices.</p>
    </div>

    <div class="footer-column">
        <h4>Navigation</h4>
        <a href="<?= BASE_URL ?>">Home</a>
        <a href="<?= BASE_URL ?>/about">About</a>
        <a href="<?= BASE_URL ?>/categories">Categories</a>
        <a href="<?= BASE_URL ?>/shop">Shop</a>
        <a href="<?= BASE_URL ?>/blog">Blog</a>
        <a href="<?= BASE_URL ?>/contact">Contact</a>
    </div>

    <div class="footer-column">
        <h4>Categories</h4>
        <a href="<?= BASE_URL ?>/categories">Sneakers</a>
        <a href="<?= BASE_URL ?>/categories">Boots</a>
        <a href="<?= BASE_URL ?>/categories">Formal</a>
        <a href="<?= BASE_URL ?>/categories">Running</a>
        <a href="<?= BASE_URL ?>/categories">Oxford</a>
        <a href="<?= BASE_URL ?>/categories">Sports Shoe</a>
    </div>

    <div class="footer-column footer-contact">
        <h4>Contact</h4>
        <p>56757 Dream Avenue, Garden City, New Jersey, USA</p>
        <a href="mailto:snikei@gmail.com">snikei@gmail.com</a>
        <a href="tel:+13451234568">(345) 123 456 5368</a>
        <span class="footer-copy">&copy; <?= $year ?> SNIKEI. All rights reserved.</span>
    </div>
</footer>
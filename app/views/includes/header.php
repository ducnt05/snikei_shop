<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
$route = '/' . trim(substr($currentPath, strlen($basePath)), '/');
if ($route === '//') {
    $route = '/';
}

$navItems = [
    ['label' => 'Categories', 'href' => BASE_URL . '/categories', 'route' => '/categories'],
    ['label' => 'Shop', 'href' => BASE_URL . '/shop', 'route' => '/shop'],
    ['label' => 'About', 'href' => BASE_URL . '/about', 'route' => '/about'],
    ['label' => 'Blog', 'href' => BASE_URL . '/blog', 'route' => '/blog'],
    ['label' => 'Contact', 'href' => BASE_URL . '/contact', 'route' => '/contact'],
];
?>

<header class="header-container">
    <a class="brand" href="<?= BASE_URL ?>">
        <span class="brand-mark">S</span>
        <span class="brand-text">
            <strong>SNIKEI</strong>
            <small>Curated footwear store</small>
        </span>
    </a>

    <nav class="header-nav" aria-label="Primary navigation">
        <?php foreach ($navItems as $item): ?>
        <a href="<?= $item['href'] ?>" class="<?= $route === $item['route'] ? 'active' : '' ?>"
            <?= $route === $item['route'] ? 'aria-current="page"' : '' ?>><?= $item['label'] ?></a>
        <?php endforeach; ?>
    </nav>

    <div class="header-actions">
        <a href="#" title="Search"><i class="fa-solid fa-magnifying-glass"></i></a>
        <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>/profile" title="Profile"><i class="fa-solid fa-address-book"></i></a>
        <?php endif; ?>

        <a class="btn-cartshop" title="Cart"><i class="fa-solid fa-cart-shopping"></i></a>
        <?php if (!isset($_SESSION['user_id'])) { ?>
        <a href="<?= BASE_URL ?>/login" title="Login"><i class="fa-solid fa-user"></i></a>
        <?php } else { ?>
        <p><?php echo htmlspecialchars($_SESSION['user_name'] ?? ($user['name'] ?? 'User'), ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="<?= BASE_URL ?>/logout" title="Logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        <?php } ?>
    </div>
</header>
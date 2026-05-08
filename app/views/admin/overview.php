<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Overview</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_overview.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
    <?php
    $orders = $orders ?? [];
    $user = $user ?? [];
    $userNamesById = [];
    foreach ($user as $userRow) {
        $userNamesById[(int) ($userRow['id'] ?? 0)] = $userRow['name'] ?? 'Unknown';
    }
    ?>
    <div class="main">
        <div class="main-header">
            <div class="header-left">
                <i class="fa-solid fa-bars menu-btn"></i>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search here...">
                </div>
            </div>
            <div class="header-right">
                <i class="fa-solid fa-sun"></i>
                <i class="fa-regular fa-bell"></i>
                <a href="<?= BASE_URL ?>">Home</a>
            </div>
        </div>
        <div class="content">
            <div class="content-header">
                <h2>Overview</h2>
                <p>Manage all orders in one place.</p>

            </div>
            <div class="content-search">
                <div class="search-customer-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search order...">
                </div>
                <a href="#" class="btn-add"><i class="fa-solid fa-plus"></i> Add Order</a>

            </div>
            <div class=" content-table">
                <div class="table-header">
                    <span class="id">#</span>
                    <span class="name">Bill For</span>
                    <span class="created_at">Created At</span>
                    <span class="updated_at">Updated At</span>
                    <span class="total">Total</span>
                    <span class="status">Status</span>
                    <span class="action">Action</span>


                </div>
                <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                <div class="table-row">
                    <span class="id"><?= (int) ($order['id'] ?? 0) ?></span>
                    <span class="name"><?= htmlspecialchars((string) ($userNamesById[(int) ($order['user_id'] ?? 0)] ?? 'Unknown'), ENT_QUOTES, 'UTF-8') ?></span>
                    <span class="created_at">
                        <?= !empty($order['created_at']) ? date('d/m/Y H:i:s', strtotime((string) $order['created_at'])) : '-' ?>
                    </span>

                    <span class="updated_at">
                        <?= !empty($order['updated_at']) ? date('d/m/Y H:i:s', strtotime((string) $order['updated_at'])) : '-' ?>
                    </span>
                    <span class="total">$<?= number_format((float) ($order['total_price'] ?? 0), 0) ?></span>
                    <span class="status"><span class="status-badge"><?= htmlspecialchars((string) ($order['status'] ?? 'pending'), ENT_QUOTES, 'UTF-8') ?></span></span>
                    <span class="action">
                        <span><a href="<?= BASE_URL ?>/admin/transaction?order_id=<?= (int) ($order['id'] ?? 0) ?>" title="Update status"><i class="fa-solid fa-pen-to-square"></i></a></span>
                    </span>
                </div>
                <?php endforeach; ?>
                <?php else : ?>
                <div class="table-empty">
                    <i class="fa-regular fa-face-frown-open"></i>
                    <p>No orders found.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
    </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
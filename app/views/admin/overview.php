<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_overview.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
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
                    <span class="id"><?= $order['id'] ?></span>
                    <span
                        class="name"><?= $user[array_search($order['user_id'], array_column($user, 'id'))]['name'] ?></span>
                    <span class="created_at">
                        <?= date('d/m/Y H:i:s', strtotime($order['created_at'])) ?>
                    </span>

                    <span class="updated_at">
                        <?= date('d/m/Y H:i:s', strtotime($order['updated_at'])) ?>
                    </span>
                    <span class="total">$<?= number_format($order['total_price'], 0) ?></span>
                    <span class="status"><span class="status-badge"><?= $order['status'] ?></span></span>
                    <span class="action">
                        <span><a href="<?= BASE_URL ?>/admin/orders/<?= $order['id'] ?>/edit"><i
                                    class="fa-solid fa-pen-to-square"></i></a></span>
                        <span><a href="<?= BASE_URL ?>/admin/orders/<?= $order['id'] ?>/delete"
                                onclick="return confirm('Are you sure you want to delete this order?')"><i
                                    class="fa-solid fa-trash"></i></a></span>
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
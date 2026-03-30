<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_dashboard.css">
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

        <div class="dashboard-content">
            <div class="dashboard-top">
                <div>
                    <h2>Dashboard</h2>
                    <p>Simple summary of your store performance.</p>
                </div>
                <span class="today"><?= date('d/m/Y') ?></span>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <p>Total Users</p>
                    <h3><?= (int) ($stats['users'] ?? 0) ?></h3>
                </div>
                <div class="stat-card">
                    <p>Total Products</p>
                    <h3><?= (int) ($stats['products'] ?? 0) ?></h3>
                </div>
                <div class="stat-card">
                    <p>Total Orders</p>
                    <h3><?= (int) ($stats['orders'] ?? 0) ?></h3>
                </div>
                <div class="stat-card highlight">
                    <p>Total Revenue</p>
                    <h3>$<?= number_format((float) ($stats['revenue'] ?? 0), 0) ?></h3>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="panel">
                    <div class="panel-header">
                        <h4>Revenue Last 6 Months</h4>
                    </div>
                    <div class="mini-chart">
                        <?php foreach (($monthlyChart ?? []) as $item): ?>
                        <?php
                            $maxValue = (float) ($monthlyMax ?? 1);
                            $total = (float) ($item['total'] ?? 0);
                            $height = $maxValue > 0 ? (int) round(($total / $maxValue) * 100) : 0;
                            if ($height < 8 && $total > 0) {
                                $height = 8;
                            }
                        ?>
                        <div class="bar-item" title="$<?= number_format($total, 0) ?>">
                            <div class="bar" style="height: <?= $height ?>%;"></div>
                            <span><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <h4>Latest Orders</h4>
                    </div>
                    <?php if (!empty($latestOrders)): ?>
                    <div class="table-wrap">
                        <div class="table-head">
                            <span>#</span>
                            <span>Customer</span>
                            <span>Total</span>
                            <span>Status</span>
                        </div>
                        <?php foreach ($latestOrders as $order): ?>
                        <div class="table-row">
                            <span><?= (int) ($order['id'] ?? 0) ?></span>
                            <span><?= htmlspecialchars($userNamesById[(int) ($order['user_id'] ?? 0)] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></span>
                            <span>$<?= number_format((float) ($order['total_price'] ?? 0), 0) ?></span>
                            <span class="status"><?= htmlspecialchars($order['status'] ?? 'pending', ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <p class="empty">No orders yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
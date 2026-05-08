<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Taxes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_overview.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_taxes.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
    <?php
    $orders = $orders ?? [];
    $taxRate = (float) ($taxRate ?? 0.1);
    $taxableRevenue = (float) ($taxableRevenue ?? 0);
    $taxSummary = $taxSummary ?? [];
    ?>
    <div class="main">
        <div class="main-header">
            <div class="header-left">
                <i class="fa-solid fa-bars menu-btn"></i>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search tax...">
                </div>
            </div>
            <div class="header-right">
                <i class="fa-solid fa-sun"></i>
                <i class="fa-regular fa-bell"></i>
                <a href="<?= BASE_URL ?>">Home</a>
            </div>
        </div>

        <div class="content">
            <div class="page-hero">
                <div>
                    <h2>Taxes</h2>
                    <p>Estimated tax summary based on completed order value, grouped by month for a clearer financial snapshot.</p>
                </div>
                <div class="hero-chip"><i class="fa-solid fa-calculator"></i> Tax overview</div>
            </div>

            <div class="stats-grid" style="margin-top: 18px; margin-bottom: 24px;">
                <div class="stat-card">
                    <p>Tax Rate</p>
                    <h3><?= number_format($taxRate * 100, 0) ?>%</h3>
                </div>
                <div class="stat-card">
                    <p>Taxable Revenue</p>
                    <h3>$<?= number_format($taxableRevenue, 0) ?></h3>
                </div>
                <div class="stat-card highlight">
                    <p>Estimated Tax</p>
                    <h3>$<?= number_format($taxableRevenue * $taxRate, 0) ?></h3>
                </div>
            </div>

            <div class="content-table">
                <div class="table-header">
                    <span class="id">Month</span>
                    <span class="name">Estimated Tax</span>
                    <span class="status">Orders</span>
                </div>
                <?php if (!empty($taxSummary)): ?>
                    <?php foreach ($taxSummary as $month => $taxAmount): ?>
                    <div class="table-row">
                        <span class="id"><?= htmlspecialchars(date('m/Y', strtotime($month . '-01')), ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="name">$<?= number_format((float) $taxAmount, 0) ?></span>
                        <span class="status"><span class="status-badge is-success">Taxable</span></span>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-regular fa-face-frown-open"></i>
                        <p>No taxable orders found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
       <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_invoice.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
    <?php $orders = $orders ?? []; ?>
    <?php $userNamesById = $userNamesById ?? []; ?>
    <div class="main">
        <div class="main-header">
            <div class="header-left">
                <i class="fa-solid fa-bars menu-btn"></i>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search invoice...">
                </div>
            </div>
            <div class="header-right">
                <i class="fa-solid fa-sun"></i>
                <i class="fa-regular fa-bell"></i>
                <a href="<?= BASE_URL ?>">Home</a>
            </div>
        </div>

        <div class="invoice-wrap">
            <div class="page-hero">
                <div>
                    <h2>Invoice</h2>
                    <p>Latest order invoices ready for review and printing, with a more polished card-based layout.</p>
                </div>
                <div class="hero-chip"><i class="fa-solid fa-file-invoice"></i> Billing</div>
            </div>

            <div class="layout-grid" style="margin-top: 18px;">
                <?php if (!empty($orders)): ?>
                    <?php foreach (array_slice($orders, 0, 12) as $order): ?>
                    <div class="invoice-card panel-card">
                        <div class="invoice-top" style="display: flex; justify-content: space-between; gap: 12px; flex-wrap: wrap; align-items: flex-start;">
                            <div>
                                <h3>Invoice #<?php echo (int) ($order['id'] ?? 0); ?></h3>
                                <div class="invoice-meta" style="color: rgb(102, 112, 133); margin-top: 8px; display: grid; gap: 4px;">
                                    <span>Customer: <?php echo htmlspecialchars((string) ($userNamesById[(int) ($order['user_id'] ?? 0)] ?? 'Unknown'), ENT_QUOTES, 'UTF-8'); ?></span>
                                    <span>Date: <?php echo !empty($order['created_at']) ? htmlspecialchars(date('d/m/Y H:i:s', strtotime((string) $order['created_at'])), ENT_QUOTES, 'UTF-8') : '-'; ?></span>
                                    <span>Total: $<?php echo number_format((float) ($order['total_price'] ?? 0), 0); ?></span>
                                </div>
                            </div>
                            <span class="pill <?php echo in_array(strtolower((string) ($order['status'] ?? 'pending')), ['paid', 'completed'], true) ? 'success' : 'warn'; ?>"><?php echo htmlspecialchars((string) ($order['status'] ?? 'pending'), ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="invoice-card panel-card">
                        <p>No invoices found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
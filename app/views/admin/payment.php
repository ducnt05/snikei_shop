<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_payment.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
    <div class="main">
        <div class="main-header">
            <div class="header-left">
                <i class="fa-solid fa-bars menu-btn"></i>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search payment...">
                </div>
            </div>
            <div class="header-right">
                <i class="fa-solid fa-sun"></i>
                <i class="fa-regular fa-bell"></i>
                <a href="<?= BASE_URL ?>">Home</a>
            </div>
        </div>

        <?php $payments = $payments ?? []; ?>
        <?php $paymentSummary = $paymentSummary ?? ['total_orders' => 0, 'paid' => 0, 'pending' => 0, 'revenue' => 0]; ?>
        <?php $userNamesById = $userNamesById ?? []; ?>

        <div class="content">
            <div class="page-hero">
                <div>
                    <h2>Payment</h2>
                    <p>Track recent order payments and payment status with a cleaner finance dashboard.</p>
                </div>
                <div class="hero-chip"><i class="fa-solid fa-credit-card"></i> Finance panel</div>
            </div>

            <div class="stats-grid" style="margin-top: 18px; margin-bottom: 24px;">
                <div class="stat-card">
                    <p>Total Orders</p>
                    <h3><?= (int) ($paymentSummary['total_orders'] ?? 0) ?></h3>
                </div>
                <div class="stat-card">
                    <p>Paid Orders</p>
                    <h3><?= (int) ($paymentSummary['paid'] ?? 0) ?></h3>
                </div>
                <div class="stat-card">
                    <p>Pending Orders</p>
                    <h3><?= (int) ($paymentSummary['pending'] ?? 0) ?></h3>
                </div>
                <div class="stat-card highlight">
                    <p>Total Revenue</p>
                    <h3>$<?= number_format((float) ($paymentSummary['revenue'] ?? 0), 0) ?></h3>
                </div>
            </div>

            <div class="content-table">
                <div class="table-header">
                    <span class="id">#</span>
                    <span class="name">Customer</span>
                    <span class="created">Created At</span>
                    <span class="total">Total</span>
                    <span class="status">Status</span>
                </div>

                <?php if (!empty($payments)): ?>
                    <?php foreach ($payments as $payment): ?>
                    <div class="table-row">
                        <span class="id"><?= (int) ($payment['id'] ?? 0) ?></span>
                        <span class="name"><?= htmlspecialchars((string) ($userNamesById[(int) ($payment['user_id'] ?? 0)] ?? 'Unknown'), ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="created"><?= !empty($payment['created_at']) ? htmlspecialchars(date('d/m/Y H:i:s', strtotime((string) $payment['created_at'])), ENT_QUOTES, 'UTF-8') : '-' ?></span>
                        <span class="total">$<?= number_format((float) ($payment['total_price'] ?? 0), 0) ?></span>
                        <?php $status = strtolower((string) ($payment['status'] ?? 'pending')); ?>
                        <span class="status"><span class="status-badge <?= in_array($status, ['paid', 'completed'], true) ? 'is-success' : ($status === 'cancelled' ? 'is-danger' : 'is-warn') ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span></span>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-regular fa-face-frown-open"></i>
                        <p>No payment records found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Transaction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_overview.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_transaction.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
    <?php $orders = $orders ?? []; ?>
    <?php $selectedOrderId = (int) ($selectedOrderId ?? 0); ?>
    <div class="main">
        <div class="main-header">
            <div class="header-left">
                <i class="fa-solid fa-bars menu-btn"></i>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search transaction...">
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
                    <h2>Add Transaction</h2>
                    <p>Update order status to record a payment or transaction state with a cleaner admin form.</p>
                </div>
                <div class="hero-chip"><i class="fa-solid fa-pen-to-square"></i> Update flow</div>
            </div>

            <div class="form-card" style="margin-top: 18px; margin-bottom: 24px; max-width: 640px;">
                <form action="<?= BASE_URL ?>/admin/process_transaction" method="post">
                    <div>
                        <label for="order_id">Order</label>
                        <select id="order_id" name="order_id" required>
                            <option value="">Select order</option>
                            <?php foreach ($orders as $order): ?>
                            <option value="<?php echo (int) ($order['id'] ?? 0); ?>" <?php echo $selectedOrderId === (int) ($order['id'] ?? 0) ? 'selected' : ''; ?>>#<?php echo (int) ($order['id'] ?? 0); ?> - $<?php echo number_format((float) ($order['total_price'] ?? 0), 0); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="paid">Paid</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <button type="submit">Save Transaction</button>
                </form>
            </div>

            <div class="content-table">
                <div class="table-header">
                    <span class="id">#</span>
                    <span class="name">Order</span>
                    <span class="status">Status</span>
                    <span class="total">Total</span>
                </div>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                    <div class="table-row">
                        <span class="id"><?php echo (int) ($order['id'] ?? 0); ?></span>
                        <span class="name">Order <?php echo (int) ($order['id'] ?? 0); ?></span>
                        <?php $status = strtolower((string) ($order['status'] ?? 'pending')); ?>
                        <span class="status"><span class="status-badge <?= in_array($status, ['paid', 'completed'], true) ? 'is-success' : ($status === 'cancelled' ? 'is-danger' : 'is-warn') ?>"><?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></span></span>
                        <span class="total">$<?php echo number_format((float) ($order['total_price'] ?? 0), 0); ?></span>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-regular fa-face-frown-open"></i>
                        <p>No transactions found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
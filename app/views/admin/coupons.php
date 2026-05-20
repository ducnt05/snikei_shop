<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Coupons</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
    <style>
        .coupon-form { padding: 16px; background: #fff; margin: 16px; border-radius: 6px; }
        .coupon-form input, .coupon-form select { padding: 8px; margin: 6px 0; width: 100%; box-sizing: border-box; }
        .coupon-list { margin: 16px; }
        .coupon-row { display:flex; gap:12px; padding:8px 12px; align-items:center; border-bottom:1px solid #eee }
        .coupon-row span { flex:1 }
        .coupon-actions { flex:0 0 160px }
    </style>
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
    <?php $coupons = $coupons ?? []; ?>

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

        <div class="coupon-form">
            <h2>Add Coupon</h2>
            <form action="<?= BASE_URL ?>/admin/process_add_coupon" method="post">
                <label>Code</label>
                <input type="text" name="code" required maxlength="50">

                <label>Discount Percent (%)</label>
                <input type="number" name="discount_percent" step="0.01" min="0" max="100">

                <label>Discount Amount</label>
                <input type="number" name="discount_amount" step="0.01" min="0">

                <label>Valid From</label>
                <input type="datetime-local" name="valid_from">

                <label>Valid Until</label>
                <input type="datetime-local" name="valid_until">

                <label>Usage Limit</label>
                <input type="number" name="usage_limit" min="0">

                <label>Status</label>
                <select name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>

                <div style="margin-top:10px">
                    <button type="submit" class="btn-add">Add Coupon</button>
                </div>
            </form>
        </div>

        <div class="coupon-list">
            <h2>Coupons</h2>
            <div class="coupon-row" style="font-weight:600">
                <span style="flex:0 0 40px">ID</span>
                <span style="flex:0 0 120px">Code</span>
                <span>Percent</span>
                <span>Amount</span>
                <span>Valid From</span>
                <span>Valid Until</span>
                <span>Limit</span>
                <span>Used</span>
                <span>Status</span>
                <span class="coupon-actions">Action</span>
            </div>
            <?php foreach ($coupons as $c): ?>
            <div class="coupon-row">
                <span style="flex:0 0 40px"><?php echo $c['id']; ?></span>
                <span style="flex:0 0 120px"><?php echo htmlspecialchars($c['code']); ?></span>
                <span><?php echo $c['discount_percent']; ?></span>
                <span><?php echo $c['discount_amount']; ?></span>
                <span><?php echo $c['valid_from']; ?></span>
                <span><?php echo $c['valid_until']; ?></span>
                <span><?php echo $c['usage_limit']; ?></span>
                <span><?php echo $c['used_count']; ?></span>
                <span><?php echo $c['status']; ?></span>
                <span class="coupon-actions">
                    <a href="<?= BASE_URL ?>/admin/delete_coupon?id=<?php echo $c['id']; ?>" onclick="return confirm('Delete coupon?')">Delete</a>
                </span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>

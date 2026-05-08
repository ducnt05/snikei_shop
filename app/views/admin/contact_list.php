<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Contact List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_customers.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_contact_list.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
    <?php $customers = $customers ?? []; ?>
    <div class="main">
        <div class="main-header">
            <div class="header-left">
                <i class="fa-solid fa-bars menu-btn"></i>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search contact...">
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
                    <h2>Contact List</h2>
                    <p>Quick directory of customer accounts and their contact details, now with a clearer admin layout.</p>
                </div>
                <div class="hero-chip"><i class="fa-solid fa-address-book"></i> Directory</div>
            </div>

            <div class="content-table">
                <div class="table-header">
                    <span class="id">#</span>
                    <span class="name">Name</span>
                    <span class="email">Email</span>
                    <span class="role">Role</span>
                </div>
                <?php if (!empty($customers)): ?>
                    <?php foreach ($customers as $customer): ?>
                    <div class="table-row">
                        <span class="id"><?php echo (int) ($customer['id'] ?? 0); ?></span>
                        <span class="name"><?php echo htmlspecialchars((string) ($customer['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="email"><?php echo htmlspecialchars((string) ($customer['email'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="role"><span class="role-badge"><?php echo htmlspecialchars((string) ($customer['role'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span></span>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-regular fa-face-frown-open"></i>
                        <p>No contacts found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
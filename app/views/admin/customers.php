<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin &#8211; Customers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_customers.css">
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
                <h2>Customers</h2>
                <p>Manage registered customer accounts in one place.</p>
            </div>
            <div class="content-search">
                <div class="search-customer-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search customer...">
                </div>
                <a href="#" class="btn-add"><i class="fa-solid fa-plus"></i> Add Customer</a>
            </div>
            <div class="content-table">
                <div class="table-header">
                    <span class="id">#</span>
                    <span class="name">Name</span>
                    <span class="email">Email</span>
                    <span class="role">Role</span>
                    <span class="action">Action</span>
                </div>
                <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer): ?>
                <div class="table-row">
                    <span class="id"><?php echo (int) $customer['id']; ?></span>
                    <span class="name"><?php echo htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span class="email"><?php echo htmlspecialchars($customer['email'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span class="role">
                        <span
                            class="role-badge"><?php echo htmlspecialchars($customer['role'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </span>
                    <span class="action">
                        <a href="#" title="Edit customer"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" onclick="return confirm('Are you sure you want to delete this user?')"
                            title="Delete customer"><i class="fa-solid fa-trash"></i></a>
                    </span>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="table-empty">
                    <i class="fa-regular fa-face-frown-open"></i>
                    <p>No customers found.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
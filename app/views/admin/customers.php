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
        <div class="users-container">
            <div class="users-header">
                <h2>Users Details</h2>
                <button class="btn-add">+ Add User</button>
            </div>
            <div class="users-table">
                <div class="table-head">
                    <span>ID</span>
                    <span>Name</span>
                    <span>Email</span>
                    <span>Role</span>
                    <span>Action</span>
                </div>
                <?php foreach ($customers as $customer): ?>
                <div class="table-row">
                    <span><?php echo $customer['id']; ?></span>
                    <span><?php echo $customer['name']; ?></span>
                    <span><?php echo $customer['email']; ?></span>
                    <span><?php echo $customer['role']; ?></span>
                    <span class="action">
                        <a href="#">Edit</a>
                        <a href="#">Delete</a>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
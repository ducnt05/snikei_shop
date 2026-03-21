<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin &#8211; Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_message.css">
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
        <div class="mess-container">
            <div class="mess-header">
                <h2>Message</h2>
            </div>
            <div class="mess-table">
                <div class="table-head">
                    <span>ID</span>
                    <span>Name</span>
                    <span>Email</span>
                    <span>Message</span>
                </div>
                <?php foreach ($messages as $message): ?>
                <div class="table-row">
                    <span><?php echo $message['id']; ?></span>
                    <span><?php echo $message['name']; ?></span>
                    <span><?php echo $message['email']; ?></span>
                    <span><?php echo $message['message']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
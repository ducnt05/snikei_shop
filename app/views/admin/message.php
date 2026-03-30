<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Messages</title>
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
        <div class="content">
            <div class="content-header">
                <h2>Messages</h2>
                <p>Review contact messages sent from the website.</p>
            </div>

            <div class="content-search">
                <div class="search-message-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search message...">
                </div>
                <a href="<?= BASE_URL ?>/contact" class="btn-add"><i class="fa-solid fa-plus"></i> New Message</a>
            </div>

            <div class="content-table">
                <div class="table-header">
                    <span class="id">#</span>
                    <span class="name">Name</span>
                    <span class="email">Email</span>
                    <span class="message">Message</span>
                </div>

                <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                <div class="table-row">
                    <span class="id"><?php echo (int) $message['id']; ?></span>
                    <span class="name"><?php echo htmlspecialchars($message['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span class="email"><?php echo htmlspecialchars($message['email'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span class="message"><?php echo htmlspecialchars($message['message'], ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="table-empty">
                    <i class="fa-regular fa-face-frown-open"></i>
                    <p>No messages found.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_calendar.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>
    <?php $events = $events ?? []; ?>
    <div class="main">
        <div class="main-header">
            <div class="header-left">
                <i class="fa-solid fa-bars menu-btn"></i>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search event...">
                </div>
            </div>
            <div class="header-right">
                <i class="fa-solid fa-sun"></i>
                <i class="fa-regular fa-bell"></i>
                <a href="<?= BASE_URL ?>">Home</a>
            </div>
        </div>

        <div class="calendar-wrap">
            <div class="page-hero">
                <div>
                    <h2>Calendar</h2>
                    <p>Recent orders and contact messages arranged chronologically for a quick operational view.</p>
                </div>
                <div class="hero-chip"><i class="fa-solid fa-calendar-days"></i> Timeline</div>
            </div>

            <div class="calendar-grid" style="margin-top: 18px;">
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                    <div class="calendar-card panel-card">
                        <h4><?php echo htmlspecialchars((string) ($event['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h4>
                        <div class="calendar-meta">
                            <span><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime((string) ($event['date'] ?? 'now'))), ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="event-tag <?php echo ($event['type'] ?? '') === 'message' ? 'message' : ''; ?>"><?php echo htmlspecialchars((string) ($event['type'] ?? 'event'), ENT_QUOTES, 'UTF-8'); ?></span>
                            <?php if (($event['type'] ?? '') === 'order'): ?>
                            <span>Status: <?php echo htmlspecialchars((string) ($event['status'] ?? 'pending'), ENT_QUOTES, 'UTF-8'); ?></span>
                            <span>Amount: $<?php echo number_format((float) ($event['amount'] ?? 0), 0); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="calendar-card panel-card">
                        <p>No upcoming events.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Shop | About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_cart_shop.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_about.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/cart_shop.php"); ?>
    <?php $e = fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); ?>
    <main class="about-page">
        <section class="about-hero">
            <div class="container about-hero-grid">
                <div class="about-copy">
                    <span class="eyebrow">About Sni Kei</span>
                    <h1>We build a sharper shopping experience for people who care about what they wear.</h1>
                    <p>Sni Kei is a footwear store focused on clean selection, dependable service, and styles that stay useful beyond one season.</p>
                    <div class="about-actions">
                        <a href="<?= BASE_URL ?>/shop" class="btn-primary">Shop collection</a>
                        <a href="<?= BASE_URL ?>/contact" class="btn-secondary">Talk to us</a>
                    </div>
                </div>

                <aside class="about-panel">
                    <div class="about-panel-top">
                        <span class="panel-label">Our promise</span>
                        <h2>Simple choices. Better fit. Less noise.</h2>
                        <p>We keep the catalog focused so customers can find a pair faster without scrolling through clutter.</p>
                    </div>
                    <div class="panel-badge-row">
                        <span>Curated</span>
                        <span>Reliable</span>
                        <span>Fast support</span>
                    </div>
                </aside>
            </div>
        </section>

        <section class="about-section">
            <div class="container stats-grid">
                <?php foreach ($stats as $stat): ?>
                    <article class="stat-card">
                        <strong><?= $e($stat['value']) ?></strong>
                        <span><?= $e($stat['label']) ?></span>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="about-section">
            <div class="container split-grid">
                <div class="story-card">
                    <span class="eyebrow">Our story</span>
                    <h2>Started with a small idea: make shoe shopping feel more intentional.</h2>
                    <p>Instead of flooding the page with endless products, we organize around practical use, clean visuals, and clear buying decisions.</p>
                    <p>That means fewer distractions, stronger product stories, and a shopping flow that feels easier from first click to checkout.</p>
                </div>

                <div class="timeline-card">
                    <span class="eyebrow">Milestones</span>
                    <div class="timeline-list">
                        <?php foreach ($timeline as $item): ?>
                            <div class="timeline-item">
                                <div class="timeline-year"><?= $e($item['year']) ?></div>
                                <div>
                                    <h3><?= $e($item['title']) ?></h3>
                                    <p><?= $e($item['text']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container">
                <div class="section-head">
                    <div>
                        <span class="eyebrow">What we value</span>
                        <h2>Three principles that shape the store</h2>
                    </div>
                    <p>Every decision we make goes through the same filter: does it help the customer choose better and faster?</p>
                </div>

                <div class="value-grid">
                    <?php foreach ($values as $value): ?>
                        <article class="value-card">
                            <div class="value-icon"><i class="fa-solid <?= $e($value['icon']) ?>"></i></div>
                            <h3><?= $e($value['title']) ?></h3>
                            <p><?= $e($value['text']) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container team-grid">
                <div class="team-intro">
                    <span class="eyebrow">How we work</span>
                    <h2>A small team with a focused workflow.</h2>
                    <p>From product curation to logistics, each part of the process is designed to keep the customer experience simple.</p>
                </div>

                <div class="team-list">
                    <?php foreach ($team as $member): ?>
                        <article class="team-card">
                            <span><?= $e($member['role']) ?></span>
                            <h3><?= $e($member['name']) ?></h3>
                            <p><?= $e($member['text']) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include("includes/footer.php"); ?>
    <script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>
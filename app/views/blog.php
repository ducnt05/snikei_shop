<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Shop | Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_cart_shop.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_blog.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/cart_shop.php"); ?>
    <?php $e = fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); ?>
    <main class="blog-page">
        <section class="blog-hero">
            <div class="container blog-hero-grid">
                <div class="blog-hero-copy">
                    <span class="eyebrow">Journal</span>
                    <h1>Ideas, guides, and shoe stories worth reading.</h1>
                    <p>Discover styling notes, buying advice, and care tips designed to help you build a smarter shoe rotation.</p>
                    <div class="blog-hero-actions">
                        <a href="#featured" class="btn-primary">Read featured story</a>
                        <a href="<?= BASE_URL ?>/shop" class="btn-secondary">Browse collection</a>
                    </div>
                </div>

                <aside class="blog-hero-card">
                    <span class="card-label">Featured topic</span>
                    <h2><?= $e($featuredPost['tag']) ?></h2>
                    <p><?= $e($featuredPost['accent']) ?></p>
                    <div class="topic-list">
                        <?php foreach ($topics as $topic): ?>
                            <span><?= $e($topic) ?></span>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        </section>

        <section class="blog-section" id="featured">
            <div class="container">
                <div class="section-head">
                    <div>
                        <span class="eyebrow">Featured article</span>
                        <h2><?= $e($featuredPost['title']) ?></h2>
                    </div>
                    <p><?= $e($featuredPost['excerpt']) ?></p>
                </div>

                <article class="featured-article">
                    <div class="featured-article-copy">
                        <div class="post-meta">
                            <span><?= $e($featuredPost['author']) ?></span>
                            <span><?= $e($featuredPost['date']) ?></span>
                            <span><?= $e($featuredPost['readTime']) ?></span>
                        </div>
                        <h3><?= $e($featuredPost['title']) ?></h3>
                        <p><?= $e($featuredPost['excerpt']) ?></p>
                        <a href="#latest" class="text-link">Explore more articles <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="featured-article-visual">
                        <div class="visual-orb orb-one"></div>
                        <div class="visual-orb orb-two"></div>
                        <div class="visual-card">
                            <i class="fa-solid fa-shoe-prints"></i>
                            <span>Curated for everyday wear</span>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="blog-section" id="latest">
            <div class="container">
                <div class="section-head compact">
                    <div>
                        <span class="eyebrow">Latest posts</span>
                        <h2>Fresh reads from the Sni Kei team</h2>
                    </div>
                    <p>Short, useful posts that help you choose, style, and maintain the pairs you already own.</p>
                </div>

                <div class="blog-grid">
                    <?php foreach ($blogPosts as $post): ?>
                        <article class="blog-card">
                            <span class="blog-tag"><?= $e($post['tag']) ?></span>
                            <h3><?= $e($post['title']) ?></h3>
                            <p><?= $e($post['excerpt']) ?></p>
                            <div class="blog-card-footer">
                                <div class="post-meta compact-meta">
                                    <span><?= $e($post['date']) ?></span>
                                    <span><?= $e($post['readTime']) ?></span>
                                </div>
                                <a href="#" class="text-link">Read more</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="blog-section blog-newsletter">
            <div class="container newsletter-box">
                <div>
                    <span class="eyebrow">Newsletter</span>
                    <h2>Get one useful style note every week.</h2>
                    <p>Quick advice, new arrivals, and care reminders. No clutter.</p>
                </div>
                <form class="newsletter-form" action="#" method="post">
                    <input type="email" placeholder="Your email address">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </section>
    </main>

    <?php include("includes/footer.php"); ?>
    <script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>
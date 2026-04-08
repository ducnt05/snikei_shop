<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Shop | Contact</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_contact.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_cart_shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/cart_shop.php"); ?>
    <?php $e = fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); ?>
    <main class="contact-page">
        <section class="contact-hero">
            <div class="container">
                <span class="eyebrow">Contact</span>
                <h1>Let’s talk about products, orders, or anything else.</h1>
                <p>We usually reply within one business day. Use the form below or reach us through the direct contact details.</p>
            </div>
        </section>

        <section class="contact-section">
            <div class="container contact-grid">
                <div class="contact-panel contact-info-panel">
                    <div class="section-head compact left-align">
                        <div>
                            <span class="eyebrow">Reach us</span>
                            <h2>Direct contact details</h2>
                        </div>
                        <p>Choose the fastest channel and we will route your message to the right person.</p>
                    </div>

                    <div class="info-card-list">
                        <?php foreach ($contactInfo as $item): ?>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fa-solid <?= $e($item['icon']) ?>"></i>
                                </div>
                                <div>
                                    <h3><?= $e($item['title']) ?></h3>
                                    <p><?= $e($item['text']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="hours-card">
                        <h3>Working hours</h3>
                        <p>Monday - Friday: 8:00 AM - 6:00 PM</p>
                        <p>Saturday: 9:00 AM - 2:00 PM</p>
                        <p>Sunday: Closed</p>
                    </div>
                </div>

                <div class="contact-panel contact-form-panel">
                    <div class="section-head compact left-align">
                        <div>
                            <span class="eyebrow">Send a message</span>
                            <h2>Tell us what you need</h2>
                        </div>
                    </div>

                    <?php if (($status ?? null) === 'success'): ?>
                        <div class="alert alert-success">Your message has been sent successfully.</div>
                    <?php elseif (($status ?? null) === 'error'): ?>
                        <div class="alert alert-error">Something went wrong. Please try again.</div>
                    <?php endif; ?>

                    <form class="contact-form" action="<?= BASE_URL ?>/process_contact" method="post">
                        <div class="field-grid">
                            <div class="form-field">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-field">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="form-field full-width">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Tell us about your question or request" rows="6" required></textarea>
                        </div>

                        <button type="submit" class="btn-primary">Send Message <i class="fa-solid fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </section>

        <section class="contact-section contact-map-section">
            <div class="container contact-map-card">
                <div>
                    <span class="eyebrow">Location</span>
                    <h2>Find us in Garden City</h2>
                    <p>We are available for product questions, bulk inquiries, and support-related follow-up.</p>
                </div>
                <div class="map-placeholder">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Store and support hub</span>
                </div>
            </div>
        </section>
    </main>

    <?php include("includes/footer.php"); ?>
    <script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei - Contact</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_contact.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <div class="heading">
            <h1>Contact Now</h1>
        </div>
        <div class="form-contact">
            <div class="form-left">
                <form action="<?= BASE_URL ?>/process_contact" method="post">
                    <h2>Send a line about your project</h2>
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Enter your name">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email">
                    <label for="message">Your Message</label>
                    <input type="text" name="message" placeholder="Enter your message">
                    <button type="submit">Send now <i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
            <div class="form-right">
                <img src="https://cdn.prod.website-files.com/6890fbf29f28b7089b169c21/68a203981ddc2dc9b5f33b8d_Rectangle%2053.png" alt="">
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
    <script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>
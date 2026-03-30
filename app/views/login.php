<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Shop | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_login.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_cart_shop.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/cart_shop.php"); ?>

    <div class="login-form">
        <h1>Sign in</h1>
        <form action="<?= BASE_URL ?>/process_login" method="post">
            <span>Email:</span>
            <input type="email" name="email" placeholder="Enter your email">
            <span>Password</span>
            <input id="password" type="password" name="password" placeholder="Enter your password">
            <input id="show-password" type="checkbox" onclick="password.type= this.checked ? 'text' : 'password'">
            <label class="form-check-label" for="show-password">Show Password ?</label>
            <button>Sign In</button>
            <p>Don't have an account? <a href="<?= BASE_URL ?>/register">Sign up</a></p>
        </form>
    </div>

    <?php include("includes/footer.php"); ?>
    <script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>
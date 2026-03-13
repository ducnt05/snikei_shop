<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style_main/style_login.css">
    <link rel="stylesheet" href="assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="assets/css/style_main/style_footer.css">
</head>

<body>
    <?php include("includes/header.php"); ?>

    <div class="login-form">
        <h1>Sign in</h1>
        <form action="./process/process_login.php" method="post">
            <span>Email:</span>
            <input type="email" name="email" placeholder="Enter your email">
            <span>Password:</span>
            <input type="password" name="password" placeholder="Enter your password">
            <button type="submit">Sign In</button>
            <p>Don't have an account? <a href="./register.php">Sign up</a></p>
        </form>
    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei - Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style_main/style_register.css">
    <link rel="stylesheet" href="assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="assets/css/style_main/style_footer.css">
</head>

<body>
    <?php include("includes/header.php"); ?>

    <div class="sign-up-form">
        <h1>Sign up</h1>
        <form action="./process/process_register.php" method="post">
            <span>Name:</span>
            <input type="text" name="name" placeholder="Enter your name">
            <span>Email:</span>
            <input type="email" name="email" placeholder="Enter your email">
            <span>Password</span>
            <input type="password" name="password" placeholder="Enter your password">

            <button>Sign Up</button>
            <p>Already have an account?
                <a href="./login.php">Sign in</a>
            </p>

        </form>
    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin &#8211; Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_dashboard.css">
</head>

<body>
    <?php
    include("../includes/sidebar.php")
    ?>
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

                <a href="../index.php">Home</a>
            </div>

        </div>

    </div>

    <script src="../assets/js/admin.js"></script>
</body>

</html>
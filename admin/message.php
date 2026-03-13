<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin &#8211; Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_message.css">
</head>

<body>
    <?php
    include("../includes/sidebar.php");
    include("../config/config.php");
    $sql = "SELECT * FROM contacts";
    $result = mysqli_query($conn,$sql);
    
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
        <div class="mess-container">
            <div class="mess-header">
                <h2>Message</h2>
            </div>
            <div class="mess-table">
                <div class="table-head">

                    <span class="id">Id</span>
                    <span class="name">Name</span>
                    <span class="email">Email</span>

                    <span class="message">Message</span>
                    <span class="registered-on">Registered On</span>

                    <span class="action">Action</span>
                </div>
                <?php   while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="table-form">

                    <span class="id"><?php echo $row["id"]; ?></span>

                    <span class="name"><?php echo $row["name"]; ?></span>

                    <span class="email"><?php echo $row["email"]; ?></span>

                    <span class="message"><?php echo $row["message"]; ?></span>

                    <span class="registered-on">
                        <?php echo $row["created_at"]; ?>
                    </span>



                    <span class="action">
                        <a href="">Reply</a>
                        <a href="">Delete</a>
                    </span>
                </div>
                <?php 
            }
            ?>
            </div>
        </div>
    </div>
    <script src="../assets/js/admin.js"></script>
</body>

</html>
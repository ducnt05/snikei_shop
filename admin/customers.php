<?php
include("../config/config.php");
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_customers.css">
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
        <div class="users-container">
            <div class="users-header">
                <h2>Users Details</h2>
                <button class="btn-add">+ Add User</button>
            </div>
            <div class="users-table">
                <div class="table-head">
                    <span class="name">Name</span>
                    <span class="email">Email</span>

                    <span class="role">Role</span>
                    <span class="registered-on">Registered On</span>

                    <span class="action">Action</span>
                </div>
                <?php   while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="table-form">


                    <span class="name"><?php echo $row["name"]; ?></span>

                    <span class="email"><?php echo $row["email"]; ?></span>

                    <span class="role"><?php echo $row["role"]; ?></span>

                    <span class="registered-on">
                        <?php echo $row["created_at"]; ?>
                    </span>



                    <span class="action">
                        <a href="">Edit</a>
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
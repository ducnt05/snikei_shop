<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style_sidebar.css">
    <link rel="stylesheet" href="../assets/css/style_customers.css">
</head>

<body>
    <?php 
    include("../includes/sidebar.php");
    ?>
    <div class="main">
        <h1>User Table</h1>

        <div class="table-header">
            <span class="id">Id</span>
            <span class="name">Name</span>
            <span class="email">Email</span>
            <span class="password">Password</span>
            <span class="role">Role</span>
            <span class="created-date">Creation Date</span>
            <span class="action">Action</span>
        </div>

        <?php 
    include("../config/config.php");

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>

        <div class="table-form">

            <span class="id"><?php echo $row["id"]; ?></span>

            <span class="name"><?php echo $row["name"]; ?></span>

            <span class="email"><?php echo $row["email"]; ?></span>

            <span class="password"><?php echo $row["password"]; ?></span>

            <span class="role"><?php echo $row["role"]; ?></span>

            <span class="created-date"><?php echo $row["created_at"]; ?></span>

            <span class="action">
                <a href="edit_user.php?id=<?php echo $row["id"]; ?>">Edit</a>
                <a href="../process/delete_user.php?id=<?php echo $row["id"]; ?>"
                    onclick="return confirm('Are you sure?')">Delete</a>
            </span>

        </div>

        <?php 
    }
    ?>
    </div>
    </div>
</body>

</html>
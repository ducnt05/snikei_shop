<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_products.css">
</head>

<body>
    <?php
    include("../includes/sidebar.php");
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
        <div class="table-product">
            <div class="table-header">
                <span class="id">Id</span>
                <span class="image">Image</span>
                <span class="name">Name</span>
                <span class="description">Description</span>
                <span class="category">Category</span>
                <span class="price">Price</span>
                <span class="discount-price">Discount Price</span>
                <span class="quantity">Quantity</span>
                <span class="action">Action</span>

            </div>
            <?php 
            include("../config/config.php");
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="table-form">
                <span class="id"><?php echo $row["id"]; ?></span>

                <span class="image">
                    <img src="../uploads/<?php echo $row["image"]; ?>" width="150px">
                </span>

                <span class="name"><?php echo $row["name"]; ?></span>

                <span class="description"><?php echo $row["description"]; ?></span>

                <span class="category"><?php echo $row["category"]; ?></span>

                <span class="price">$
                    <?php echo number_format($row["price"],0,",","."); ?>
                </span>

                <span class="discount-price">$
                    <?php echo number_format($row["discount_price"],0,",","."); ?>
                </span>

                <span class="quantity"><?php echo $row["quantity"]; ?></span>

                <span class="action">
                    <a href="edit_product.php?id=<?php echo $row["id"]; ?>">Edit</a>
                    <a href="../process/delete_product.php?id=<?php echo $row["id"]; ?>">Delete</a>
                </span>
            </div>
            <?php 
            }
            ?>
            <div class="add-product">
                <button class="btn-add">Add product</button>
            </div>
        </div>
    </div>
    <script src="../assets/js/admin.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin &#8211; Add Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_product_add.css">
    <link rel="stylesheet" href="../assets/css/style_admin/style_sidebar.css">
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
        <div class="main-content">
            <form action="../process/process_product_add.php" method="post" enctype="multipart/form-data">
                <div class="left-form">
                    <label for="name">Product name</label>
                    <input name="name" type="text">
                    <label for="description">Description</label>
                    <input name="description" type="text">
                    <label for="category">Category</label>
                    <select name="category">
                        <option value="">Select Category</option>
                        <option value="Sneakers">Sneakers</option>
                        <option value="Boots">Boots</option>
                        <option value="Formal">Formal</option>
                        <option value="Running">Running</option>
                        <option value="Oxford">Oxford</option>
                        <option value="Sports Shoe">Sports Shoe</option>
                        <option value="High Neck">High Neck</option>
                        <option value="Loafers">Loafers</option>
                    </select>
                    <div class="price">
                        <div>
                            <label for="price">Price</label>
                            <input type="number" name="price">
                        </div>
                        <div>
                            <label for="discount_price">Discount Price</label>
                            <input type="number" name="discount_price">
                        </div>
                    </div>
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity">
                </div>
                <div class="right-image">

                    <label>Product Image</label>
                    <input type="file" name="image">
                    <button type="submit">Save Product</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/js/admin.js"></script>
</body>

</html>
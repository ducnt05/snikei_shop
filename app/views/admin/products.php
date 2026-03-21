<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin &#8211; Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_products.css">
</head>

<body>
    <?php include __DIR__ . "/../includes/sidebar.php"; ?>

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
                <a href="<?= BASE_URL ?>">Home</a>
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
            <?php foreach ($products as $product): ?>
            <div class="table-form">
                <span class="id"><?php echo $product["id"]; ?></span>
                <span class="image">
                    <img src="<?= BASE_URL ?>/uploads/<?php echo $product["image"]; ?>" width="150px">
                </span>
                <span class="name"><?php echo $product["name"]; ?></span>
                <span class="description"><?php echo $product["description"]; ?></span>
                <span class="category"><?php echo $product["category"]; ?></span>
                <span class="price">$<?php echo number_format($product["price"], 0, ",", "."); ?></span>
                <span class="discount-price">$<?php echo number_format($product["discount_price"], 0, ",", "."); ?></span>
                <span class="quantity"><?php echo $product["quantity"]; ?></span>
                <span class="action">
                    <a href="<?= BASE_URL ?>/admin/edit_product?id=<?php echo $product["id"]; ?>">Edit</a>
                    <a href="<?= BASE_URL ?>/admin/delete_product?id=<?php echo $product["id"]; ?>">Delete</a>
                </span>
            </div>
            <?php endforeach; ?>
            <div class="add-product">
                <a href="<?= BASE_URL ?>/admin/product_add"><button class="btn-add">Add product</button></a>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
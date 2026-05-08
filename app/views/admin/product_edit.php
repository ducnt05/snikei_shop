<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_admin_extra.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_product_edit.css">
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
        <?php $product = $product ?? []; ?>
        <div class="main-content">
            <form action="<?= BASE_URL ?>/admin/update_product" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= (int) ($product['id'] ?? 0) ?>">
                <input type="hidden" name="current_image" value="<?= htmlspecialchars((string) ($product['image'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">

                <div class="left-form">
                    <label for="name">Product name</label>
                    <input id="name" name="name" type="text" value="<?= htmlspecialchars((string) ($product['name'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">

                    <label for="description">Description</label>
                    <input id="description" name="description" type="text" value="<?= htmlspecialchars((string) ($product['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">

                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <?php $currentCategory = (string) ($product['category'] ?? ''); ?>
                        <option value="">Select Category</option>
                        <option value="sneakers" <?= $currentCategory === 'sneakers' ? 'selected' : '' ?>>Sneakers</option>
                        <option value="boots" <?= $currentCategory === 'boots' ? 'selected' : '' ?>>Boots</option>
                        <option value="formal" <?= $currentCategory === 'formal' ? 'selected' : '' ?>>Formal</option>
                        <option value="running" <?= $currentCategory === 'running' ? 'selected' : '' ?>>Running</option>
                        <option value="oxford" <?= $currentCategory === 'oxford' ? 'selected' : '' ?>>Oxford</option>
                        <option value="sports-shoe" <?= $currentCategory === 'sports-shoe' ? 'selected' : '' ?>>Sports Shoe</option>
                        <option value="high-neck" <?= $currentCategory === 'high-neck' ? 'selected' : '' ?>>High Neck</option>
                        <option value="loafers" <?= $currentCategory === 'loafers' ? 'selected' : '' ?>>Loafers</option>
                    </select>

                    <div class="price">
                        <div>
                            <label for="price">Price</label>
                            <input id="price" type="number" name="price" value="<?= htmlspecialchars((string) ($product['price'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                        <div>
                            <label for="discount_price">Discount Price</label>
                            <input id="discount_price" type="number" name="discount_price" value="<?= htmlspecialchars((string) ($product['discount_price'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                    </div>

                    <label for="quantity">Quantity</label>
                    <input id="quantity" type="number" name="quantity" value="<?= htmlspecialchars((string) ($product['quantity'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="right-image">
                    <label>Current Image</label>
                    <?php if (!empty($product['image'])): ?>
                    <div style="margin-bottom: 12px;">
                        <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars((string) $product['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Product image" style="max-width: 180px;">
                    </div>
                    <?php endif; ?>
                    <label for="image">Replace Image</label>
                    <input id="image" type="file" name="image">
                    <button type="submit">Update Product</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= BASE_URL ?>/assets/js/admin.js"></script>
</body>

</html>
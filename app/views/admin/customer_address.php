<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snikei Admin | Customer Address</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_admin/style_customer_address.css">
</head>

<body>
    <?php $avatarPath = !empty($address['img_avatar']) ? BASE_URL . '/' . ltrim($address['img_avatar'], '/') : null; ?>
    <h1>Customer Address</h1>

    <div class="container">
        <div class="box-left">
            <?php if ($avatarPath): ?>
            <img src="<?= htmlspecialchars($avatarPath, ENT_QUOTES, 'UTF-8') ?>" alt="Profile image">
            <?php else: ?>
            <i class="fa-solid fa-user"></i>
            <?php endif; ?>
            <p>Name: <?php echo htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Email: <?php echo htmlspecialchars($customer['email'], ENT_QUOTES, 'UTF-8'); ?></p>

        </div>
        <div class="box-right">
            <?php if ($address): ?>
            <h2>Address Details</h2>
            <p>Type: <?php echo htmlspecialchars($address['address_type'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Country: <?php echo htmlspecialchars($address['country'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>State: <?php echo htmlspecialchars($address['state'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>City: <?php echo htmlspecialchars($address['city'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Postal Code: <?php echo htmlspecialchars($address['postal_code'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Street: <?php echo htmlspecialchars($address['street'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php else: ?>
            <p>No address found for this customer.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
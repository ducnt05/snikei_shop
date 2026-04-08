<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_profile.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_footer.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style_main/style_cart_shop.css">
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/cart_shop.php"); ?>
    <?php
    $address = $address ?? [];
    $avatarPath = !empty($address['img_avatar']) ? BASE_URL . '/' . ltrim($address['img_avatar'], '/') : null;
    ?>
    <main class="profile-page">
        <div class="container">
            <section class="profile-shell">
                <div class="profile-head">
                    <h1>Address Profile</h1>
                    <p>Enter your address details based on the addresses table structure for easy system storage.</p>
                </div>

                <form class="profile-form" action="process_add_profile" method="POST" enctype="multipart/form-data">
                    <div class="avatar-block">
                        <div class="avatar-preview">
                            <?php if ($avatarPath): ?>
                                <img src="<?= htmlspecialchars($avatarPath, ENT_QUOTES, 'UTF-8') ?>" alt="Profile image">
                            <?php else: ?>
                                <i class="fa-solid fa-user"></i>
                            <?php endif; ?>
                        </div>
                        <label class="avatar-upload" for="img_avatar">Profile Image</label>
                        <input type="file" id="img_avatar" name="img_avatar" accept="image/*" hidden>
                    </div>

                    <input type="hidden" name="address_id" value="<?= htmlspecialchars((string)($address['id'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">

                    <div class="grid-fields">
                        <div class="form-field">
                            <label for="address_type">Address Type</label>
                            <select id="address_type" name="address_type" required>
                                <option value="">Select address type</option>
                                <option value="home" <?= (($address['address_type'] ?? '') === 'home') ? 'selected' : '' ?>>Home</option>
                                <option value="office" <?= (($address['address_type'] ?? '') === 'office') ? 'selected' : '' ?>>Office</option>
                                <option value="billing" <?= (($address['address_type'] ?? '') === 'billing') ? 'selected' : '' ?>>Billing</option>
                                <option value="shipping" <?= (($address['address_type'] ?? '') === 'shipping') ? 'selected' : '' ?>>Shipping</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" placeholder="Vietnam" required value="<?= htmlspecialchars($address['country'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="form-field">
                            <label for="state">State/Province</label>
                            <input type="text" id="state" name="state" placeholder="Hanoi" required value="<?= htmlspecialchars($address['state'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="form-field">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Ba Dinh District" required value="<?= htmlspecialchars($address['city'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="form-field">
                            <label for="postal_code">Postal code</label>
                            <input type="text" id="postal_code" name="postal_code" placeholder="100000" required value="<?= htmlspecialchars($address['postal_code'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="form-field full-width">
                            <label for="street">Street</label>
                            <input type="text" id="street" name="street" placeholder="House number, street name"
                                required value="<?= htmlspecialchars($address['street'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="form-field full-width check-field">
                            <label for="is_default" class="check-wrap">
                                <input type="checkbox" id="is_default" name="is_default" value="1" <?= !empty($address['is_default']) ? 'checked' : '' ?>>
                                <span>Set as default address</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn-outline">Reset Form</button>
                        <button type="submit" class="btn-primary">Save Address</button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <?php include("includes/footer.php"); ?>
    <script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>

</html>
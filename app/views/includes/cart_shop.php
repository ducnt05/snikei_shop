<div class="cart-shop">
    <div class="cart-head">
        <div>
            <h2>Your Cart</h2>
        </div>
        <div><button><i class="fa-solid fa-xmark"></i></button></div>

    </div>
    <div class="cart-product">
        <?php
        $sessionUserId = $_SESSION['user_id'] ?? null;
        $cart = $cart ?? [];
        $cartItems = $cartItems ?? [];
        $products = $products ?? [];
        $userCartItems = [];

        if ($sessionUserId === null) {
            echo '<p>Please sign in to view your cart.</p>';
        } else {
            $userCartIds = [];
            foreach ($cart as $cartRow) {
                if ((int)($cartRow['user_id'] ?? 0) === (int)$sessionUserId) {
                    $userCartIds[] = (int)($cartRow['id'] ?? 0);
                }
            }

            $userCartItems = [];
            foreach ($cartItems as $cartItem) {
                if (in_array((int)($cartItem['cart_id'] ?? 0), $userCartIds, true)) {
                    $userCartItems[] = $cartItem;
                }
            }

            if (empty($userCartItems)) {
                echo '<p>Your cart is empty.</p>';
            } else {
                foreach ($userCartItems as $cartItem) {
                    $image = htmlspecialchars((string)($cartItem['image'] ?? ''), ENT_QUOTES, 'UTF-8');
                    $productId = (int)($cartItem['product_id'] ?? 0);
                    $productLabel = $products[$productId] ?? [];
                    $quantity = (int)($cartItem['quantity'] ?? 0);
                    $price = (float)($cartItem['discount_price'] ?? 0);
                    ?>
        <div class="cart-product-item">
            <div class="cart-product-left">
                <img src="<?= BASE_URL ?>/uploads/<?= $image ?>" alt="" width="150px">
            </div>
            <div class="cart-product-right">
                <h3><?= $productLabel['name'] ?? 'Unknown Product' ?></h3>
                <p>Quantity: <?= $quantity ?></p>
                <p>Price: $<?= number_format($price, 0, ',', '.') ?></p>
            </div>
        </div>
        <?php
                }
            }
        }
        ?>
    </div>
    <div class="cart-total">
        <p>Subtotal</p>
        <p>Total:
            $<?= number_format(array_sum(array_map(function($item) { return (float)($item['discount_price'] ?? 0) * (int)($item['quantity'] ?? 0); }, $userCartItems)), 0, ',', '.') ?>
        </p>
    </div>
    <div class="btn-checkout">
        <form action="<?= BASE_URL ?>/checkout" method="POST">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? 0 ?>">
            <input type="hidden" name="total_price"
                value="<?= array_sum(array_map(function($item) { return (float)($item['discount_price'] ?? 0) * (int)($item['quantity'] ?? 0); }, $userCartItems)) ?>">
            <input type="hidden" name="status" value="processing">
            <button type="submit">Checkout</button>
        </form>
    </div>
</div>
<div class="overlay"></div>
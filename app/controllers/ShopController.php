<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Reviews;
use App\Models\User;
use App\Models\Vertex;
class ShopController extends Controller {
    public function index() {
        $productModel = new Product();
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();

        $products = $productModel->getAllProducts();
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();

        $this->view('shop', compact('products', 'cart', 'cartItems'));
    }
    public function show($id) {
        
        $productModel = new Product();
        $product = $productModel->getProductById($id);
        if (!$product) {
            http_response_code(404);
            echo 'Product not found';
            return;
        }

        $similarProduct = $productModel->getProductByCategory($product['category']);
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();
        $reviewsModel = new Reviews();
        $reviews = $reviewsModel->getReviewsByProductId($id);
        $userModel = new User();
        $user = $userModel->getAllUsers();
        

        $this->view('product_detail', compact('product', 'similarProduct', 'cart', 'cartItems', 'reviews', 'user'));
    }
    public function addToCart() {
        $productModel = new Product();
        $userId = $_POST['user_id'] ?? null;
        $productId = $_POST['product_id'] ?? null;
        $product = $productModel->getProductById($productId);
        $quantity = $_POST['quantity'] ?? 1;
        if ($productId && $userId) {
            $cartModel = new Cart();
            $cartItemModel = new Cart_item();
            $cartModel->addCart($userId);
            $cart_id = $cartModel->getIdCart($userId);
            $cartItemModel ->addCartItem($cart_id, $productId, $quantity, $product['image'], $product['discount_price']);
            $this->redirect('/shop');
        } else {
            http_response_code(400);
            echo 'Invalid product or user';
        }
    }
    public function checkout() {
        $this->requireAuth();

        $userId = (int) ($_SESSION['user_id'] ?? ($_POST['user_id'] ?? 0));
        $totalPrice = (float) ($_POST['total_price'] ?? 0);

        if ($userId <= 0 || $totalPrice <= 0) {
            http_response_code(400);
            echo 'Invalid checkout data';
            return;
        }

        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        // Get cart ID for user
        $cartId = $cartModel->getIdCart($userId);
        if (!$cartId) {
            http_response_code(400);
            echo 'Cart not found for user';
            return;
        }

        // Get all cart items once
        $cartItems = $cartItemModel->getCartItemsByCartId($cartId);
        if (empty($cartItems)) {
            http_response_code(400);
            echo 'Cart is empty';
            return;
        }

        $_SESSION['payment_qr'] = [
            'user_id' => $userId,
            'cart_id' => $cartId,
            'total_price' => $totalPrice,
            'bank_name' => 'TECHCOMBANK',
            'account_name' => 'NGUYEN ANH DUC',
            'account_number' => '33027102005',
            'note' => 'Thanh toan don hang SNIKEI',
            'cart_items' => $cartItems,
        ];

        $this->redirect('/checkout/qr');
    }

    public function checkoutQr() {
        $this->requireAuth();

        $paymentQr = $_SESSION['payment_qr'] ?? null;
        if (empty($paymentQr)) {
            $this->redirect('/');
            return;
        }

        $this->view('payment_qr', [
            'paymentQr' => $paymentQr,
        ]);
    }

    public function checkoutPaid() {
        $this->requireAuth();

        $paymentQr = $_SESSION['payment_qr'] ?? null;
        if (empty($paymentQr) || empty($paymentQr['user_id']) || empty($paymentQr['cart_id'])) {
            $this->redirect('/');
            return;
        }

        $userId = (int) $paymentQr['user_id'];
        $cartId = (int) $paymentQr['cart_id'];
        $totalPrice = (float) ($paymentQr['total_price'] ?? 0);
        $cartItems = $paymentQr['cart_items'] ?? [];

        if ($userId <= 0 || $cartId <= 0 || $totalPrice <= 0 || empty($cartItems)) {
            unset($_SESSION['payment_qr']);
            $this->redirect('/');
            return;
        }

        $ordersModel = new Orders();
        $orderItemsModel = new OrderItems();
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        $productModel = new Product();

        $orderId = $ordersModel->createOrder($userId, $totalPrice, 'paid');

        if ($orderId > 0) {
            foreach ($cartItems as $item) {
                $orderItemsModel->createOrderItem(
                    $orderId,
                    $item['product_id'] ?? null,
                    $item['quantity'] ?? 0,
                    $item['discount_price'] ?? 0
                );

                $productId = $item['product_id'] ?? null;
                if ($productId) {
                    $currentQuantity = $productModel->getQuantityProduct($productId);
                    $newQuantity = max(0, $currentQuantity - (int) ($item['quantity'] ?? 0));
                    $productModel->updateQuantityProduct($productId, $newQuantity);
                }
            }

            $cartItemModel->clearCartItemsByCartId($cartId);
            $cartModel->clearCart($userId);
        }

        unset($_SESSION['payment_qr']);
        $this->redirect('/');
    }
    public function addReview() {
        $userId = $_POST['user_id'] ?? null;
        $productId = $_POST['product_id'] ?? null;
        $rating = $_POST['rating'] ?? null;
        $comment = $_POST['comment'] ?? null;
       
        if (!$userId || !$productId || !$rating) {
            http_response_code(400);
            echo 'Invalid review data';
            return;
        }
        $reviewModel = new Reviews();
        $reviewModel->addReview($userId, $productId, $rating, $comment);
        // Here you would typically save the review to the database
        // For this example, we'll just redirect back to the product page

        $this->redirect('/shop?id=' . $productId);
    }
}
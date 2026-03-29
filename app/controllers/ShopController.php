<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Orders;
use App\Models\OrderItems;
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
        $similarProduct = $productModel->getProductByCategory($product['category']);
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();
        if (!$product) {
            http_response_code(404);
            echo 'Product not found';
            return;
        }
        

        $this->view('product_detail', compact('product', 'similarProduct', 'cart', 'cartItems'));
    }
    public function addToCart() {
        $productModel = new Product();
        $userId = $_POST['user_id'] ?? null;
        $productId = $_POST['product_id'] ?? null;
        $product = $productModel->getProductById($productId);
        $quantity = $_POST['quantity'] ?? 1;
        if ($productId) {
            $cartModel = new Cart();
            $cartItemModel = new Cart_item();
            $cartModel->addCart($userId);
            $cart_id = $cartModel->getIdCart($userId);
            $cartItemModel ->addCartItem($cart_id, $productId, $quantity, $product['image'], $product['discount_price']);
            $this->redirect('/shop');
        }
    }
    public function checkout() {
        $userId = $_POST['user_id'] ?? null;
        $totalPrice = $_POST['total_price'] ?? null;
        $status = $_POST['status'] ?? 'processing';

        if (!$userId || !$totalPrice) {
            http_response_code(400);
            echo 'Invalid checkout data';
            return;
        }

        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        $ordersModel = new Orders();
        $orderItemsModel = new OrderItems();

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

        // Create order
        $orders = $ordersModel->createOrder($userId, $totalPrice, $status);
        $orderId = $ordersModel->getOrdersByUserId($userId);
        
        if (!empty($orderId)) {
            $orderId = $orderId[0]['id'] ?? null;
            
            
            if ($orderId) {
                foreach ($cartItems as $item) {
                    $orderItemsModel->createOrderItem(
                        $orderId,
                        $item['product_id'] ?? null,
                        $item['quantity'] ?? 0,
                        $item['discount_price'] ?? 0
                    );
                }
            }
        }

        // Clear cart
        $cartItemModel->clearCartItemsByCartId($cartId);
        $cartModel->clearCart($userId);

        // Redirect to confirmation page
        $this->redirect('/shop');
    }
}
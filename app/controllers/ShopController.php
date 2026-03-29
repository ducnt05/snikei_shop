<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_item;

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
}
<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cart;
use App\Models\Cart_item;

class CategoriesController extends Controller {
    public function index() {
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();
        
        $this->view('categories', compact('cart', 'cartItems'));
    }
    public function create() {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = explode('/', trim($uri, '/'));
        $category = end($parts);
        
        $productModel = new \App\Models\Product();
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        
        $products = $productModel->getProductByCategory($category);
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();
        
        $this->view('shop', compact('products', 'cart', 'cartItems'));
    }
}
?>
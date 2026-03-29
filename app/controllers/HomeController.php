<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_item;

class HomeController extends Controller {
    public function index() {
        $productModel = new Product();
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        
        $products = $productModel->getAllProducts();
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();

        $this->view('home', compact('products', 'cart', 'cartItems'));
    }
}
?>
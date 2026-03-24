<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class ShopController extends Controller {
    public function index() {
        $productModel = new Product();
        $products = $productModel->getAllProducts();

        $this->view('shop', compact('products'));
    }
}
?>
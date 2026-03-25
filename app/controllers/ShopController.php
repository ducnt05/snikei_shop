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
    public function show($id) {
        
        $productModel = new Product();
        $product = $productModel->getProductById($id);
        $similarProduct = $productModel->getProductByCategory($product['category']);

        if (!$product) {
            http_response_code(404);
            echo 'Product not found';
            return;
        }

        $this->view('product_detail', compact('product', 'similarProduct'));
    }
}
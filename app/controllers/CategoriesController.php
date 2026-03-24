<?php
namespace App\Controllers;

use App\Core\Controller;

class CategoriesController extends Controller {
    public function index() {
        $this->view('categories');
    }
    public function create() {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = explode('/', trim($uri, '/'));
        $category = end($parts);
        
        $productModel = new \App\Models\Product();
        $products = $productModel->getProductByCategory($category);
        $this->view('shop', ['products' => $products]);
    }
}
?>
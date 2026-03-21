<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller {
    public function dashboard() {
        $this->requireAdmin();
        $this->view('admin/dashboard');
    }

    public function products() {
        $this->requireAdmin();
        $productModel = new Product();
        $products = $productModel->getAllProducts();
        $this->view('admin/products', compact('products'));
    }

    public function addProduct() {
        $this->requireAdmin();
        $this->view('admin/product_add');
    }

    public function processAddProduct() {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productModel = new Product();
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $category = $_POST['category'] ?? null;
            $price = $_POST['price'] ?? null;
            $discount_price = $_POST['discount_price'] ?? null;

            // Handle file upload
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . '/../../public/uploads/';
                $filename = basename($_FILES['image']['name']);
                $targetFile = $targetDir . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $image = $filename;
                }
            }

            if ($productModel->addProduct($name, $description, $category, $price, $discount_price, $image)) {
                $this->redirect('admin/products');
            }

            $this->redirect('admin/product_add?error=1');
        }
    }

    public function deleteProduct($id) {
        $this->requireAdmin();

        $id = (int) $id;
        if ($id <= 0) {
            $this->redirect('admin/products?error=1');
        }

        $productModel = new Product();
        if ($productModel->deleteProduct($id)) {
            $this->redirect('admin/products');
        }

        $this->redirect('admin/products?error=1');
    }

    public function customers() {
        $this->requireAdmin();
        $userModel = new User();
        $customers = $userModel->getAllUsers();
        $this->view('admin/customers', compact('customers'));
    }

    public function messages() {
        $this->requireAdmin();
        $contactModel = new Contact();
        $messages = $contactModel->getAllMessages();
        $this->view('admin/message', compact('messages'));
    }
}
?>
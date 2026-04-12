<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use App\Models\Orders;


class AdminController extends Controller {
    public function dashboard() {
        $this->requireAdmin();

        $userModel = new User();
        $productModel = new Product();
        $orderModel = new Orders();
        $contactModel = new Contact();

        $users = $userModel->getAllUsers();
        $products = $productModel->getAllProducts();
        $orders = $orderModel->getAllOrders();
        $messages = $contactModel->getAllMessages();

        $stats = [
            'users' => count($users),
            'products' => count($products),
            'orders' => count($orders),
            'messages' => count($messages),
            'revenue' => 0,
        ];

        foreach ($orders as $order) {
            $stats['revenue'] += (float) ($order['total_price'] ?? 0);
        }

        $latestOrders = array_slice($orders, 0, $stats['orders']);

        $userNamesById = [];
        foreach ($users as $user) {
            $userNamesById[(int) $user['id']] = $user['name'] ?? 'Unknown';
        }

        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $key = date('Y-m', strtotime("-{$i} months"));
            $monthlyRevenue[$key] = 0;
        }

        foreach ($orders as $order) {
            if (empty($order['created_at'])) {
                continue;
            }

            $monthKey = date('Y-m', strtotime($order['created_at']));
            if (!array_key_exists($monthKey, $monthlyRevenue)) {
                continue;
            }

            $monthlyRevenue[$monthKey] += (float) ($order['total_price'] ?? 0);
        }

        $monthlyChart = [];
        $monthlyMax = 1;
        foreach ($monthlyRevenue as $monthKey => $total) {
            if ($total > $monthlyMax) {
                $monthlyMax = $total;
            }

            $monthlyChart[] = [
                'label' => date('m/Y', strtotime($monthKey . '-01')),
                'total' => $total,
            ];
        }

        $this->view('admin/dashboard', compact('stats', 'latestOrders', 'userNamesById', 'monthlyChart', 'monthlyMax'));
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
            $quantity = $_POST['quantity'] ?? null;
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

            if ($productModel->addProduct($name, $description, $category, $price, $discount_price, $quantity, $image)) {
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
    public function editProduct($id) {
        $this->requireAdmin();

        $id = (int) $id;
        if ($id <= 0) {
            $this->redirect('admin/products?error=1');
        }

        $productModel = new Product();
        $product = $productModel->getProductById($id);
        if (!$product) {
            $this->redirect('admin/products?error=1');
        }

        $this->view('admin/product_edit', compact('product'));
    }
    public function overview() {
        $userModel = new User();
        $orderModel = new Orders();  
        $user = $userModel->getAllUsers();
        $orders = $orderModel->getAllOrders();
        $this->requireAdmin();
        $this->view('admin/overview', compact('user', 'orders'));
    }
    public function payment() {
        $this->view('admin/payment');   

    }
    public function changeCustomerRole($id, $role) {
        $this->requireAdmin();

        $id = (int) $id;
        if ($id <= 0 || !in_array($role, ['user', 'admin'], true)) {
            $this->redirect('admin/customers?error=1');
        }

        $userModel = new User();
        $user = $userModel->getUserById($id);
        if (!$user) {
            $this->redirect('admin/customers?error=1');
        }
        // Toggle from current stored role.
        $currentRole = $user['role'] ?? 'user';
        $newRole = ($currentRole === 'admin') ? 'user' : 'admin';

        if ($userModel->updateUserRole($id, $newRole)) {
            $this->redirect('admin/customers');
        }

        $this->redirect('admin/customers?error=1');
    }
}
?>
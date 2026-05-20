<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Contact;
use App\Models\Database;
use App\Models\Product;
use App\Models\User;
use App\Models\Orders;
use App\Models\Addresses;
use App\Models\Coupon;


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
    public function updateProduct() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/products');
        }

        $id = (int) ($_POST['id'] ?? 0);
        $name = trim((string) ($_POST['name'] ?? ''));
        $description = trim((string) ($_POST['description'] ?? ''));
        $category = trim((string) ($_POST['category'] ?? ''));
        $price = (float) ($_POST['price'] ?? 0);
        $discount_price = (float) ($_POST['discount_price'] ?? 0);
        $quantity = (int) ($_POST['quantity'] ?? 0);
        $currentImage = (string) ($_POST['current_image'] ?? '');

        if ($id <= 0 || $name === '' || $category === '') {
            $this->redirect('admin/edit_product?id=' . $id . '&error=1');
        }

        $image = $currentImage;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $filename = basename($_FILES['image']['name']);
            $targetFile = $targetDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = $filename;
            }
        }

        $db = Database::getInstance()->getConnection();
        if ($image !== null && $image !== '') {
            $stmt = $db->prepare('UPDATE products SET name = ?, description = ?, category = ?, price = ?, discount_price = ?, quantity = ?, image = ? WHERE id = ?');
            $updated = $stmt->execute([$name, $description, $category, $price, $discount_price, $quantity, $image, $id]);
        } else {
            $stmt = $db->prepare('UPDATE products SET name = ?, description = ?, category = ?, price = ?, discount_price = ?, quantity = ? WHERE id = ?');
            $updated = $stmt->execute([$name, $description, $category, $price, $discount_price, $quantity, $id]);
        }

        if ($updated) {
            $this->redirect('admin/products');
        }

        $this->redirect('admin/edit_product?id=' . $id . '&error=1');
    }
    public function overview() {
        $this->requireAdmin();

        $userModel = new User();
        $orderModel = new Orders();  
        $user = $userModel->getAllUsers();
        $orders = $orderModel->getAllOrders();
        $this->view('admin/overview', compact('user', 'orders'));
    }
    public function payment() {
        $this->requireAdmin();

        $orderModel = new Orders();
        $userModel = new User();

        $payments = $orderModel->getAllOrders();
        $users = $userModel->getAllUsers();

        $userNamesById = [];
        foreach ($users as $user) {
            $userNamesById[(int) $user['id']] = $user['name'] ?? 'Unknown';
        }

        $paymentSummary = [
            'total_orders' => count($payments),
            'paid' => 0,
            'pending' => 0,
            'revenue' => 0,
        ];

        foreach ($payments as $payment) {
            $status = strtolower((string) ($payment['status'] ?? 'pending'));
            if (isset($paymentSummary[$status])) {
                $paymentSummary[$status]++;
            }
            $paymentSummary['revenue'] += (float) ($payment['total_price'] ?? 0);
        }

        $this->view('admin/payment', compact('payments', 'userNamesById', 'paymentSummary'));

    }
    public function taxes() {
        $this->requireAdmin();

        $orderModel = new Orders();
        $orders = $orderModel->getAllOrders();

        $taxRate = 0.1;
        $taxableRevenue = 0;
        $taxSummary = [];

        foreach ($orders as $order) {
            $amount = (float) ($order['total_price'] ?? 0);
            $taxableRevenue += $amount;

            if (!empty($order['created_at'])) {
                $monthKey = date('Y-m', strtotime((string) $order['created_at']));
                if (!isset($taxSummary[$monthKey])) {
                    $taxSummary[$monthKey] = 0;
                }
                $taxSummary[$monthKey] += $amount * $taxRate;
            }
        }

        krsort($taxSummary);

        $this->view('admin/taxes', compact('orders', 'taxRate', 'taxableRevenue', 'taxSummary'));
    }

    public function contactList() {
        $this->requireAdmin();

        $userModel = new User();
        $customers = $userModel->getAllUsers();

        $this->view('admin/contact_list', compact('customers'));
    }

    public function calendar() {
        $this->requireAdmin();

        $orderModel = new Orders();
        $contactModel = new Contact();
        $orders = $orderModel->getAllOrders();
        $messages = $contactModel->getAllMessages();

        $events = [];
        foreach ($orders as $order) {
            if (!empty($order['created_at'])) {
                $events[] = [
                    'date' => (string) $order['created_at'],
                    'title' => 'Order #' . (int) ($order['id'] ?? 0),
                    'type' => 'order',
                    'status' => $order['status'] ?? 'pending',
                    'amount' => (float) ($order['total_price'] ?? 0),
                ];
            }
        }

        foreach ($messages as $message) {
            if (!empty($message['created_at'])) {
                $events[] = [
                    'date' => (string) $message['created_at'],
                    'title' => 'Message from ' . ($message['name'] ?? 'Guest'),
                    'type' => 'message',
                ];
            }
        }

        usort($events, function ($left, $right) {
            return strcmp($right['date'] ?? '', $left['date'] ?? '');
        });

        $this->view('admin/calendar', compact('events'));
    }

    public function invoice() {
        $this->requireAdmin();

        $orderModel = new Orders();
        $userModel = new User();

        $orders = $orderModel->getAllOrders();
        $users = $userModel->getAllUsers();

        $userNamesById = [];
        foreach ($users as $user) {
            $userNamesById[(int) $user['id']] = $user['name'] ?? 'Unknown';
        }

        $this->view('admin/invoice', compact('orders', 'userNamesById'));
    }

    public function transaction() {
        $this->requireAdmin();

        $orderModel = new Orders();
        $orders = $orderModel->getAllOrders();
        $selectedOrderId = (int) ($_GET['order_id'] ?? 0);

        $this->view('admin/transaction', compact('orders', 'selectedOrderId'));
    }

    public function processTransaction() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/transaction');
        }

        $orderId = (int) ($_POST['order_id'] ?? 0);
        $status = trim((string) ($_POST['status'] ?? ''));

        if ($orderId <= 0 || !in_array($status, ['pending', 'processing', 'paid', 'completed', 'cancelled'], true)) {
            $this->redirect('admin/transaction?error=1');
        }

        $orderModel = new Orders();
        if ($orderModel->updateOrderStatus($orderId, $status)) {
            $this->redirect('admin/transaction?success=1');
        }

        $this->redirect('admin/transaction?error=1');
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
    public function deleteCustomer($id) {
        $this->requireAdmin();

        $id = (int) $id;
        if ($id <= 0) {
            $this->redirect('admin/customers?error=1');
        }

        $userModel = new User();
        if ($userModel->deleteUser($id)) {
            $this->redirect('admin/customers');
        }

        $this->redirect('admin/customers?error=1');
    }
    public function viewCustomerAddress($id) {
        $this->requireAdmin();

        $id = (int) $id;
        if ($id <= 0) {
            $this->redirect('admin/customers?error=1');
        }

        $userModel = new User();
        $customer = $userModel->getUserById($id);
        $addressModel = new Addresses();
        $address = $addressModel->getLatestAddressByUserId($id);
        if (!$customer) {
            $this->redirect('admin/customers?error=1');
        }

        $this->view('admin/customer_address', compact('customer', 'address'));
    }

    public function coupons() {
        $this->requireAdmin();

        $couponModel = new Coupon();
        $coupons = $couponModel->getAllCoupons();

        $this->view('admin/coupons', compact('coupons'));
    }

    public function processAddCoupon() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/coupons');
        }

        $code = trim((string)($_POST['code'] ?? ''));
        $discount_percent = (float) ($_POST['discount_percent'] ?? 0);
        $discount_amount = (float) ($_POST['discount_amount'] ?? 0);
        $valid_from = trim((string)($_POST['valid_from'] ?? ''));
        $valid_until = trim((string)($_POST['valid_until'] ?? ''));
        // convert HTML5 datetime-local (e.g. 2026-05-18T20:00) to MySQL DATETIME
        if ($valid_from !== '') {
            $valid_from = str_replace('T', ' ', $valid_from) . ':00';
        } else {
            $valid_from = null;
        }
        if ($valid_until !== '') {
            $valid_until = str_replace('T', ' ', $valid_until) . ':00';
        } else {
            $valid_until = null;
        }
        $usage_limit = (int) ($_POST['usage_limit'] ?? 0);
        $status = trim((string)($_POST['status'] ?? 'active'));

        if ($code === '') {
            $this->redirect('admin/coupons?error=1');
        }

        $couponModel = new Coupon();
        if ($couponModel->addCoupon($code, $discount_percent, $discount_amount, $valid_from, $valid_until, $usage_limit, $status)) {
            $this->redirect('admin/coupons?success=1');
        }

        $this->redirect('admin/coupons?error=1');
    }

    public function deleteCoupon($id) {
        $this->requireAdmin();

        $id = (int) $id;
        if ($id <= 0) {
            $this->redirect('admin/coupons?error=1');
        }

        $couponModel = new Coupon();
        if ($couponModel->deleteCoupon($id)) {
            $this->redirect('admin/coupons');
        }

        $this->redirect('admin/coupons?error=1');
    }
}
?>
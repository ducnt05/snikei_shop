<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_item;

class AuthController extends Controller {
    public function login() {
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();
        
        $this->view('login', compact('cart', 'cartItems'));
    }

    public function processLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $userModel = new User();
        $user = $userModel->authenticate($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                $this->redirect('admin/dashboard');
            }

            $this->redirect('');
        }

        $this->redirect('login?error=invalid');
    }
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        $this->redirect('');
    }
}
?>
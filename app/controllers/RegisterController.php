<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_item;

class RegisterController extends Controller {
    public function index() {
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();
        
        $this->view('register', compact('cart', 'cartItems'));
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($userModel->register($name, $email, $password)) {
                $this->redirect('login?success=1');
            }

            $this->redirect('register?error=1');
        }
    }
}
?>
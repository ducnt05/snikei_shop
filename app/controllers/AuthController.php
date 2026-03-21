<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {
    public function login() {
        $this->view('login');
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
}
?>
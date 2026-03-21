<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class RegisterController extends Controller {
    public function index() {
        $this->view('register');
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
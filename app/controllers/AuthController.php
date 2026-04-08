<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Addresses;

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
                echo "<script>
                alert('Login successful! Welcome, Admin.');
                window.location.href = 'admin/dashboard';   
                </script>";
                exit;
               
            } if ($user['role'] === 'user') {
                echo "<script>
                alert('Login successful! Welcome, " . htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') . "');
                window.location.href = 'shop';
                </script>";
                exit;
            }
        }

        echo "<script>
        alert('Invalid email or password');
        window.location.href = 'login';
        </script>";
        exit;
        
    }
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        echo "<script>
        alert('Logged out successfully');
        window.location.href = 'login';
        </script>";
        exit;
        

     
    }
    public function profile() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user_id'] ?? null;
        $address = null;

        if ($userId) {
            $addressesModel = new Addresses();
            $address = $addressesModel->getLatestAddressByUserId($userId);
        }

        $this->view('profile', compact('address'));
    }
    public function processAddProfile() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            echo "<script>
            alert('You must be logged in to add a profile.');
            window.location.href = 'login';
            </script>";
            exit;
        }

        $addressType = $_POST['address_type'] ?? null;
        $country = $_POST['country'] ?? null;
        $state = $_POST['state'] ?? null;
        $city = $_POST['city'] ?? null;
        $postalCode = $_POST['postal_code'] ?? null;
        $street = $_POST['street'] ?? null;
        $isDefault = isset($_POST['is_default']) ? 1 : 0;

        $addressesModel = new Addresses();
        $existingAddress = $addressesModel->getLatestAddressByUserId($userId);
        $existingImgAvatar = $existingAddress['img_avatar'] ?? null;

        // Handle file upload
        $imgAvtPath = $existingImgAvatar;
        if (isset($_FILES['img_avatar']) && $_FILES['img_avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/avatars/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileTmpPath = $_FILES['img_avatar']['tmp_name'];
            $fileName = basename($_FILES['img_avatar']['name']);
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                $imgAvtPath = 'uploads/avatars/' . $fileName; 
            } else {
                echo "<script>
                alert('Failed to upload avatar image.');
                window.location.href = 'profile';
                </script>";
                exit;
            }
        }

        $saved = false;
        if ($existingAddress && !empty($existingAddress['id'])) {
            $saved = $addressesModel->updateAddress($existingAddress['id'], $imgAvtPath, $addressType, $country, $state, $city, $postalCode, $street, $isDefault);
        } else {
            $saved = $addressesModel->createAddress($userId, $imgAvtPath, $addressType, $country, $state, $city, $postalCode, $street, $isDefault);
        }

        if ($saved) {
            echo "<script>
            alert('Profile saved successfully!');
            window.location.href = 'profile';
            </script>";
            exit;
        } else {
            echo "<script>
            alert('Failed to save profile. Please try again.');
            window.location.href = 'profile';
            </script>";
            exit;
        }
    }
}   
?>
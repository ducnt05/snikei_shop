<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Contact;

class ContactController extends Controller {
    public function index() {
        $this->view('contact');
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactModel = new Contact();
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $message = $_POST['message'] ?? null;

            if ($contactModel->saveMessage($name, $email, $message)) {
                $this->redirect('contact?success=1');
            } else {
                $this->redirect('contact?error=1');
            }
        }
    }
}
?>
<?php
namespace App\Controllers;

use App\Core\Controller;

class BlogController extends Controller {
    public function index() {
        $this->view('blog');
    }
}
?>
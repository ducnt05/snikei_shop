<?php
// Minimal MVC front controller

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AboutController;
use App\Controllers\AdminController;
use App\Controllers\BlogController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\RegisterController;
use App\Controllers\ShopController;
use App\Controllers\CategoriesController;

// Base URL for redirects and links. It points to the directory containing index.php.
define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

// Start session for auth handling (only once per request)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Normalize request path (remove query string and base directory)
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$route = '/' . trim(substr($requestUri, strlen($basePath)), '/');
if ($route === '//') {
    $route = '/';
}

switch ($route) {
    case '/':
        (new HomeController())->index();
        break;
    case '/login':
        (new AuthController())->login();
        break;
    case '/process_login':
        (new AuthController())->processLogin();
        break;
    case '/register':
        (new RegisterController())->index();
        break;
    case '/process_register':
        (new RegisterController())->process();
        break;
    case '/contact':
        (new ContactController())->index();
        break;
    case '/process_contact':
        (new ContactController())->process();
        break;
    case '/about':
        (new AboutController())->index();
        break;
    case '/blog':
        (new BlogController())->index();
        break;
    case '/admin/dashboard':
        (new AdminController())->dashboard();
        break;
    case '/admin/products':
        (new AdminController())->products();
        break;
    case '/admin/product_add':
        (new AdminController())->addProduct();
        break;
    case '/admin/process_add_product':
        (new AdminController())->processAddProduct();
        break;
    case '/admin/customers':
        (new AdminController())->customers();
        break;
    case '/admin/messages':
        (new AdminController())->messages();
        break;
    case '/admin/delete_product':
        (new AdminController())->deleteProduct((int)($_GET['id'] ?? 0));
        break;
    case '/shop':
        (new ShopController())->index();
        break;
    case '/categories':
        (new CategoriesController())->index();
        break;
    case '/category/sneakers' :
    case '/category/boots' :
    case '/category/formal' :
    case '/category/running' :
    case '/category/oxford' :
    case '/category/sports-shoe' :
    case '/category/high-neck' :
    case '/category/loafers' :
        (new CategoriesController())->create();
        break;
    default:
        http_response_code(404);
        echo '404 Not Found';
        break;
}
<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cart;
use App\Models\Cart_item;

class AboutController extends Controller {
    public function index() {
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();

        $stats = [
            ['value' => '10K+', 'label' => 'pairs delivered'],
            ['value' => '6', 'label' => 'curated collections'],
            ['value' => '98%', 'label' => 'customer satisfaction'],
            ['value' => '24h', 'label' => 'support response']
        ];

        $values = [
            [
                'icon' => 'fa-gem',
                'title' => 'Quality first',
                'text' => 'We focus on materials, fit, and long-term wear instead of chasing short-lived hype.'
            ],
            [
                'icon' => 'fa-seedling',
                'title' => 'Curated selection',
                'text' => 'Every product is picked to balance style, comfort, and daily practicality.'
            ],
            [
                'icon' => 'fa-truck-fast',
                'title' => 'Reliable delivery',
                'text' => 'Orders are packed carefully and shipped with a simple, transparent process.'
            ]
        ];

        $timeline = [
            ['year' => '2022', 'title' => 'Store launched', 'text' => 'Started as a small sneaker-focused shop with a clear eye for everyday essentials.'],
            ['year' => '2023', 'title' => 'Collection expanded', 'text' => 'Added boots, formal shoes, and running pairs to serve more styles and use cases.'],
            ['year' => '2026', 'title' => 'Better service flow', 'text' => 'Improved the shopping experience with cleaner navigation and faster support.']
        ];

        $team = [
            [
                'name' => 'Curations',
                'role' => 'Product selection',
                'text' => 'We choose items with a focus on daily wearability and clean silhouettes.'
            ],
            [
                'name' => 'Support',
                'role' => 'Customer care',
                'text' => 'We keep replies direct, helpful, and fast so issues do not sit unresolved.'
            ],
            [
                'name' => 'Logistics',
                'role' => 'Order handling',
                'text' => 'We pack, confirm, and track orders with a simple workflow that reduces friction.'
            ]
        ];
        
        $this->view('about', compact('cart', 'cartItems', 'stats', 'values', 'timeline', 'team'));
    }
}
?>
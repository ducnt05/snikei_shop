<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cart;
use App\Models\Cart_item;

class BlogController extends Controller {
    public function index() {
        $cartModel = new Cart();
        $cartItemModel = new Cart_item();
        
        $cart = $cartModel->getAllCart();
        $cartItems = $cartItemModel->getAllCartItems();

        $featuredPost = [
            'tag' => 'Style Guide',
            'title' => 'How to build a timeless sneaker rotation',
            'excerpt' => 'A practical guide to choosing versatile pairs that work for weekdays, weekends, and everything in between.',
            'author' => 'Sni Kei Editorial',
            'date' => 'Apr 9, 2026',
            'readTime' => '6 min read',
            'accent' => 'From neutral runners to heritage court shoes, start with silhouettes that stay relevant across seasons.'
        ];

        $blogPosts = [
            [
                'tag' => 'Buying Guide',
                'title' => 'What makes a sneaker worth the price?',
                'excerpt' => 'We break down materials, comfort, outsole durability, and why construction matters more than hype.',
                'date' => 'Apr 6, 2026',
                'readTime' => '4 min read'
            ],
            [
                'tag' => 'Trend Watch',
                'title' => 'The comeback of clean white leather',
                'excerpt' => 'Minimal white leather is back in rotation because it pairs with almost every fit without looking forced.',
                'date' => 'Apr 3, 2026',
                'readTime' => '5 min read'
            ],
            [
                'tag' => 'Care Tips',
                'title' => 'Keep your shoes fresh with three simple habits',
                'excerpt' => 'Small routines like drying properly, using shoe trees, and rotating pairs make a big difference over time.',
                'date' => 'Mar 29, 2026',
                'readTime' => '3 min read'
            ]
        ];

        $topics = [
            'Sneakers',
            'Boots',
            'Formal Shoes',
            'Running',
            'Care & Cleaning'
        ];
        
        $this->view('blog', compact('cart', 'cartItems', 'featuredPost', 'blogPosts', 'topics'));
    }
}
?>
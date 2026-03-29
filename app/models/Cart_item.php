<?php
namespace App\Models;

class Cart_item {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getAllCartItems() {
        $stmt = $this->db->query("SELECT * FROM cart_items");
        return $stmt->fetchAll();
    }
    public function addCartItem($cart_id, $product_id, $quantity, $image, $discount_price) {
        $stmt = $this->db->prepare("INSERT INTO cart_items (cart_id, product_id, quantity, image, discount_price) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$cart_id, $product_id, $quantity, $image, $discount_price]);
    }
    public function clearCartItemsByCartId($cart_id) {
        $stmt = $this->db->prepare("DELETE FROM cart_items WHERE cart_id = ?");
        return $stmt->execute([$cart_id]);
    }
}?>
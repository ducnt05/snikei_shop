<?php
namespace App\Models;

class OrderItems {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function createOrderItem($order_id, $product_id, $quantity, $price) {
        $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$order_id, $product_id, $quantity, $price]);
    }
    public function getOrderItemsByOrderId($order_id) {
        $stmt = $this->db->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt->execute([$order_id]);
        return $stmt->fetchAll();
    }

}
?>
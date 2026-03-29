<?php
namespace App\Models;

class Orders {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function createOrder($user_id, $total_price, $status) {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $total_price, $status]);
    }
    public function getOrdersByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

}
?>
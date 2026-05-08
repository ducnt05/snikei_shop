<?php
namespace App\Models;

class Orders {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function createOrder($user_id, $total_price, $status) {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, ?)");
        if ($stmt->execute([$user_id, $total_price, $status])) {
            return (int) $this->db->lastInsertId();
        }

        return 0;
    }
    public function getOrdersByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
    public function getAllOrders() {
        $stmt = $this->db->query("SELECT * FROM orders ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getOrderById($id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateOrderStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
?>
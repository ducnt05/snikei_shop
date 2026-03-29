<?php
namespace App\Models;

class Cart {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getAllCart() {
        $stmt = $this->db->query("SELECT * FROM cart");
        return $stmt->fetchAll();
    }
    public function addCart($user_id) {
        // Check if cart already exists for this user
        $checkStmt = $this->db->prepare("SELECT id FROM cart WHERE user_id = ?");
        $checkStmt->execute([$user_id]);
        if ($checkStmt->fetch()) {
            return true; // Cart already exists
        }
        
        // Create new cart only if it doesn't exist
        $stmt = $this->db->prepare("INSERT INTO cart (user_id) VALUES (?)");
        return $stmt->execute([$user_id]);
    }
    public function getIdCart($user_id) {
        $stmt = $this->db->prepare("SELECT id FROM cart WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch();
        return $result ? $result['id'] : null;
    }
    public function clearCart($user_id) {
        $id = $this->getIdCart($user_id);
        if ($id) {
            $stmt = $this->db->prepare("DELETE FROM cart WHERE id = ?");
            return $stmt->execute([$id]);
        }
        return false;
    }

}
?>
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
    

}
?>
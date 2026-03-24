<?php
namespace App\Models;

class Product {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllProducts() {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }
    public function getProductByCategory($category) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category = ?");
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    }

    public function addProduct($name,$description,$category, $price, $discount_price, $image) {
        $stmt = $this->db->prepare("INSERT INTO products (name, description, category, price, discount_price, image) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $description, $category, $price, $discount_price, $image]);
    }

    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
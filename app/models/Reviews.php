<?php
namespace App\Models;

class Reviews {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function addReview($user_id, $product_id, $rating, $comment) {
        $stmt = $this->db->prepare("INSERT INTO reviews (user_id, product_id, rating, comment) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $product_id, $rating, $comment]);
    }
    public function getReviewsByProductId($product_id) {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE product_id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetchAll();
    }

}
?>
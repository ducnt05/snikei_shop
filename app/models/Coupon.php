<?php
namespace App\Models;

use App\Models\Database;
use PDO;

class Coupon {
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllCoupons()
    {
        $stmt = $this->db->prepare('SELECT * FROM coupons ORDER BY id DESC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCouponByCode(string $code)
    {
        $stmt = $this->db->prepare('SELECT * FROM coupons WHERE code = ? LIMIT 1');
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCoupon($code, $discount_percent, $discount_amount, $valid_from, $valid_until, $usage_limit, $status)
    {
        $stmt = $this->db->prepare('INSERT INTO coupons (code, discount_percent, discount_amount, valid_from, valid_until, usage_limit, used_count, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 0, ?, NOW())');
        return $stmt->execute([$code, $discount_percent, $discount_amount, $valid_from, $valid_until, $usage_limit, $status]);
    }

    public function deleteCoupon($id)
    {
        $stmt = $this->db->prepare('DELETE FROM coupons WHERE id = ?');
        return $stmt->execute([(int)$id]);
    }

    public function incrementUsedCount($id)
    {
        $stmt = $this->db->prepare('UPDATE coupons SET used_count = used_count + 1 WHERE id = ?');
        return $stmt->execute([(int)$id]);
    }
}

?>

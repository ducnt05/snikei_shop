<?php
namespace App\Models;

class Addresses {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getLatestAddressByUserId($userId) {
        $sql = "SELECT * FROM addresses
                WHERE user_id = :user_id
                ORDER BY is_default DESC, created_at DESC, id DESC
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetch();
    }

    public function createAddress($userId, $img_avt, $addressType, $country, $state, $city, $postalCode, $street, $isDefault = 0) {
        $sql = "INSERT INTO addresses (user_id, img_avatar, address_type, country, state, city, postal_code, street, is_default)
                VALUES (:user_id, :img_avatar, :address_type, :country, :state, :city, :postal_code, :street, :is_default)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':img_avatar' => $img_avt,
            ':address_type' => $addressType,
            ':country' => $country,
            ':state' => $state,
            ':city' => $city,
            ':postal_code' => $postalCode,
            ':street' => $street,
            ':is_default' => $isDefault
        ]);
    }

    public function updateAddress($addressId, $imgAvt, $addressType, $country, $state, $city, $postalCode, $street, $isDefault = 0) {
        $sql = "UPDATE addresses
                SET img_avatar = :img_avatar,
                    address_type = :address_type,
                    country = :country,
                    state = :state,
                    city = :city,
                    postal_code = :postal_code,
                    street = :street,
                    is_default = :is_default
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':img_avatar' => $imgAvt,
            ':address_type' => $addressType,
            ':country' => $country,
            ':state' => $state,
            ':city' => $city,
            ':postal_code' => $postalCode,
            ':street' => $street,
            ':is_default' => $isDefault,
            ':id' => $addressId
        ]);
    }
}?>
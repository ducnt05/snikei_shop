<?php
namespace App\Models;

class Contact {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function saveMessage($name, $email, $message) {
        $stmt = $this->db->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $message]);
    }

    public function getAllMessages() {
        $stmt = $this->db->query("SELECT * FROM contacts ORDER BY id DESC");
        return $stmt->fetchAll();
    }
}
?>
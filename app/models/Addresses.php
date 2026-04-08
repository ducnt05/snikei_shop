<?php
namespace App\Models;

class Addresses {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
}?>
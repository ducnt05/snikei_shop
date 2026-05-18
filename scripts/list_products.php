<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Database;

try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->query("SELECT id, name FROM products ORDER BY id ASC");
    $rows = $stmt->fetchAll();
    if (!$rows) {
        echo "NO_PRODUCTS\n";
        exit(0);
    }
    foreach ($rows as $r) {
        echo $r['id'] . '|' . ($r['name'] ?? '') . "\n";
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
}

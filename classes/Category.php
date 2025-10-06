<?php
require_once __DIR__ . '/../db.php';

class Category {
    public static function getAll() {
        $db = DB::getConnection();
        $stmt = $db->query("
            SELECT c.id, c.name, COUNT(p.id) as product_count
            FROM categories c
            LEFT JOIN products p ON c.id = p.category_id
            GROUP BY c.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

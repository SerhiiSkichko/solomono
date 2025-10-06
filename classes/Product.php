<?php
require_once __DIR__ . '/../db.php';

class Product {
    public static function getByCategory($categoryId = null, $sort = null) {
        $db = DB::getConnection();

        $sql = "SELECT * FROM products";
        $params = [];

        if ($categoryId) {
            $sql .= " WHERE category_id = :cid";
            $params[':cid'] = $categoryId;
        }

        switch ($sort) {
            case 'price':
                $sql .= " ORDER BY price ASC";
                break;
            case 'name':
                $sql .= " ORDER BY name ASC";
                break;
            case 'new':
                $sql .= " ORDER BY created_at DESC";
                break;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

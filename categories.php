<?php
require_once "db.php";

$db = DB::getConnection();
$categories = $db->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

function buildTree(array $elements, $parentId = 0) {
    $branch = [];
    foreach ($elements as $el) {
        if ($el['parent_id'] == $parentId) {
            $children = buildTree($elements, $el['category_id']);
            if ($children) {
                $branch[$el['category_id']] = $children;
            } else {
                $branch[$el['category_id']] = $el['category_id'];
            }
        }
    }
    return $branch;
}

$tree = buildTree($categories);
print_r($tree);

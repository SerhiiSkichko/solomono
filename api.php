<?php
require_once "classes/Category.php";
require_once "classes/Product.php";

header("Content-Type: application/json");

$action = $_GET['action'] ?? '';

if ($action === "getProducts") {
    $categoryId = $_GET['category_id'] ?? null;
    $sort = $_GET['sort'] ?? null;
    echo json_encode(Product::getByCategory($categoryId, $sort));
} elseif ($action === "getCategories") {
    echo json_encode(Category::getAll());
}

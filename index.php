<?php require_once "classes/Category.php"; ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Магазин</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/solomono/css/main.css">
</head>
<body class="container mt-3">

<div class="row">

    <div class="col-3">
        <ul class="list-group" id="categories">
            <?php foreach (Category::getAll() as $cat): ?>
                <li class="list-group-item category" data-id="<?= $cat['id'] ?>">
                    <?= $cat['name'] ?> (<?= $cat['product_count'] ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="col-9">
        <div class="mb-3">
            <select id="sort" class="form-select w-25">
                <option value="">Без сортування</option>
                <option value="price">Спочатку дешевші</option>
                <option value="name">По алфавіту</option>
                <option value="new">Спочатку нові</option>
            </select>
        </div>
        <div id="products" class="row"></div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 id="modalTitle"></h5></div>
            <div class="modal-body"><p id="modalBody"></p></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

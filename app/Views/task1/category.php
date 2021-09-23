<?php if (!empty($products)) { ?>
    Посилання для перевірки роботи додатку без ajax та запитів з get-данними:<br>
    <a href="/task_1/category/<?= $category_id ?>?order=price">Спочатку дешевші</a>&nbsp;|
    <a href="/task_1/category/<?= $category_id ?>?order=title">По алфавіту</a>&nbsp;|
    <a href="/task_1/category/<?= $category_id ?>?order=date">Спочатку нові</a>
    <select class="form-select" aria-label="Default select example" onchange="orderProducts(this, <?= $category_id ?>)">
        <option value="price">Спочатку дешевші</option>
        <option value="title">По алфавіту</option>
        <option value="date">Спочатку нові</option>
    </select>
    <div id="products_wrapper">
        <div id="products">
            <?php foreach ($products as $product) { ?>
                <div class="card">
                    <img src="<?= $product['img'] ?>" class="card-img-top" alt="<?= $product['title'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['title'] ?></h5>
                        <p class="card-text">Додано: <?= $product['date'] ?><br>
                            Ціна: <?= $product['price'] ?> UAH</p>
                        <textarea hidden><?= json_encode($product) ?></textarea>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" onclick="popupProduct(this)">Придбати</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<!--
//////////////////////
// Product modal
//////////////////////
-->

    <div class="modal" id="productModal" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pm_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="pm_body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <p>В Розділі немає жодного продукту..(</p>
<?php } ?>

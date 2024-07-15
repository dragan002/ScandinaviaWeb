<body>
    <div class="product-list">
        <div class="product-list__header">
            <h1 class="product-list__title">Product List</h1>
            <div class="product-list__buttons">
                <button class="product-list__button product-list__button--add">ADD</button>
                <button class="product-list__button product-list__button--delete" onclick="massDelete()">MASS DELETE</button>
            </div>
        </div>
        <form class="product-list__form" id="product-list" method="POST" action="index.php?action=delete">
            <?php if (isset($products) && count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-list__item">
                        <input type="checkbox" name="delete[]" value="<?= $product->getSku() ?>" class="product-list__checkbox">
                        <p class="product-list__sku"><?= $product->getSku() ?></p>
                        <p class="product-list__name"><?= $product->getName() ?></p>
                        <p class="product-list__price">$<?= $product->getPrice() ?></p>
                        <p class="product-list__attribute"><?= $product->getAttribute() ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="product-list__no-products">No products found.</p>
            <?php endif; ?>
        </form>
    </div>
    <script>
        function massDelete() {
            document.getElementById('product-list').submit();
        }
    </script>
</body>

<body>
    <div class="product-list wrapper">
        <form class="product-list__form mt-3 grid" id="product-list" method="POST">
            <h3 class="product-list__title mb-0 col-span-6 sm-col-span-8 lg-col-span-9">Product List</h3>
            <button class="product-list__button product-list__button-add p-small c-button--primary col-span-3 sm-col-span-2 lg-col-span-1"><a href="../App/views/add_product.php">ADD</a></button>
            <button class="product-list__button product-list__button-delete c-button--primary p-small col-span-3 sm-col-span-2 lg-col-span-2" type="submit">MASS DELETE</button>
            <div class="product-list__items pt-2 pb-2 grid">
                <?php if (isset($products) && count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-list__item p-1 pb-6 pt-2 col-span-12 xs-col-span-6 md-col-span-4 lg-col-span-3">
                            <input type="checkbox" name="deleteSku[]"    value="<?= $product->getSku() ?>" class="product-list__delete-checkbox">
                            <p class="product-list__sku mb-0">                       <?= $product->getSku() ?></p>
                            <p class="product-list__name mb-0">                      <?= $product->getName() ?></p>
                            <p class="product-list__price mb-0">$                    <?= $product->getPrice() ?></p>
                            <p class="product-list__attribute mb-0">                 <?= $product->getAttribute() ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="product-list__no-products">No products found.</p>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>

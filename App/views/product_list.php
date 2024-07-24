<?php
$notification = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deletingList = $_POST['deleteSku'] ?? [];
    if (count($deletingList) > 0) {
        $notification = "<div class='notification mt-3 p-2 background-grey-100' style='border-left: 5px solid #5cb85c;'>";
        $notification .= "<p class='notification-text p-large'>Are you sure you want to delete the selected products? Review the list below and click 'Mass Delete' again to confirm.</p>";
        $notification .= "<ul style='list-style-type: none; padding: 0;'>";
        foreach ($deletingList as $list) {
            $notification .= "<li style='padding: 5px; border-bottom: 1px solid #ccc;'>$list</li>";
        }
        $notification .= "</ul></div>";
    } 
}
?>

<body>
    <div class="product-list wrapper">
    <?php echo $notification; ?>
        <form class="product-list__form mt-10 mb-10 grid" id="product-list" method="POST" action="../index.php">
            <h3 class="product-list__title mb-0 col-span-6 sm-col-span-8 lg-col-span-9">Product List</h3>
            <button class="product-list__button product-list__button-add p-small c-button--primary col-span-3 sm-col-span-2 lg-col-span-1"><a href="../App/views/add_product.php">ADD</a></button>
            <button type="submit" class="product-list__button product-list__button-delete c-button--primary p-small col-span-3 sm-col-span-2 lg-col-span-2" id="delete-product-btn">MASS DELETE</button>
            <div class="product-list__items pt-5 pb-10 grid">
                <?php if (isset($products) && count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-list__item p-1 pb-6 pt-2 col-span-12 xs-col-span-6 md-col-span-4 lg-col-span-3">
                            <input type="checkbox" name="deleteSku[]" value="<?= $product->getSku() ?>" class="delete-checkbox">
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


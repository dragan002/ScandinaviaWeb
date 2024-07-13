
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Product List</h1>
    <form id="product-list" method="POST" action="index.php?action=delete">
        <?php if (isset($products) && count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <input type="checkbox" name="delete[]" value="<?= $product->getSku() ?>" class="delete-checkbox">
                    <p>SKU: <?= $product->getSku() ?></p>
                    <p>Name: <?= $product->getName() ?></p>
                    <p>Price: $<?= $product->getPrice() ?></p>
                    <p><?= $product->getAttribute() ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
        <button type="button" onclick="massDelete()">MASS DELETE</button>
    </form>
    <script>
        function massDelete() {
            document.getElementById('product-list').submit();
        }
    </script>
</body>
</html>

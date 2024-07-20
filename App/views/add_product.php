<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Add</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> 
</head>
<body>
    <div class="containerAddProduct wrapper">
        <form action="../../public/add_product.php" method="POST" class="form" id="product_form">
            <div class="form__header grid mt-10 mb-1">
                    <h1 class="form__title mb-0 h3 col-span-6 ">Product Add</h1>
                    <button type="submit" class="form__button form__button--submit col-span-3 md-col-span-2 lg-col-start-11 c-button--primary">Save</button>
                    <button class="form__button form__button--cancel col-span-3 md-col-span-2 lg-col-start-12 c-button--primary"><a href="../../public/index.php">Cancel</a></button>
            </div>
            <div class="form__wrapper grid pt-4 pb-4 xs-p-2 sm-p-4 md-p-5 lg-p-6">
                <div class="form__group grid sm-pb-2" id="product_form-sku">
                    <label for="sku" class="form__label col-start-1">SKU</label>
                    <input type="text" id="sku" name="sku" class="form__input col-start-2 c-input" value="<?= htmlspecialchars($_POST['sku'] ?? '') ?>">
                    <?php if (isset($errors['sku'])): ?>
                        <div class="form__error"><?= htmlspecialchars($errors['sku']) ?></div>
                    <?php endif; ?>
                </div>
    
                <div class="form__group grid sm-pb-2">
                    <label for="name" class="form__label col-start-1 ">Name</label>
                    <input type="text" id="name" name="name" class="form__input col-start-2 c-input" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    <?php if (isset($errors['name'])): ?>
                        <div class="form__error"><?= htmlspecialchars($errors['name']) ?></div>
                    <?php endif; ?>
                </div>
    
                <div class="form__group grid sm-pb-2">
                    <label for="price" class="form__label col-start-1">Price ($)</label>
                    <input type="number" id="price" name="price" class="form__input col-start-2 c-input" value="<?= htmlspecialchars($_POST['price'] ?? '') ?>">
                    <?php if (isset($errors['price'])): ?>
                        <div class="form__error"><?= htmlspecialchars($errors['price']) ?></div>
                    <?php endif; ?>
                </div>
    
                <div class="form__group--switcher mb-4 mt-4">
                    <label for="type" class="form__label">Type Switcher</label>
                    <select id="productType" name="type" class="form__select c-select" required onchange="showAttributes()">
                        <option value="">Type Switcher</option>
                        <option value="Book" <?= isset($_POST['type']) && $_POST['type'] === 'Book' ? 'selected' : '' ?>>Book</option>
                        <option value="DVD" <?= isset($_POST['type']) && $_POST['type'] === 'DVD' ? 'selected' : '' ?>>DVD</option>
                        <option value="Furniture" <?= isset($_POST['type']) && $_POST['type'] === 'Furniture' ? 'selected' : '' ?>>Furniture</option>
                    </select>
                    <?php if (isset($errors['type'])): ?>
                        <div class="form__error"><?= htmlspecialchars($errors['type']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form__group form__group--hidden">
                    <div class="form__group form__group--hidden-item pt-2 pb-2 pl-1 pr-1 xs-p-2 md-p-3 lg-pt-5 lg-pb-5" id="Book">
                        <div class="form__item grid sm-pb-2 pb-2">
                            <label for="weight" class="form__label col-start-1">Weight (Kg):</label>
                            <input type="text" id="weight" name="weight" class="form__input col-start-2 lg-col-span-9 c-input" step="0.01" value="<?= htmlspecialchars($_POST['weight'] ?? '') ?>">
                        </div>
                        <p class="form__description">Please enter the Width</p>
                        <?php if (isset($errors['weight'])): ?>
                            <div class="form__error"><?= htmlspecialchars($errors['weight']) ?></div>
                        <?php endif; ?>
                    </div>
        
                    <div class="form__group form__group--hidden-item pt-1 pb-1 pt-2 pb-2 pl-1 pr-1 xs-p-2 md-p-3 lg-pt-5 lg-pb-5" id="DVD">
                        <div class="form__item grid sm-pb-2 pb-2">
                            <label for="size" class="form__label col-start-1">Size (MB):</label>
                            <input type="text" id="size" name="size" class="form__input col-start-2 c-input" value="<?= htmlspecialchars($_POST['size'] ?? '') ?>">
                        </div>
                        <p class="form__description">Please enter the size of the DVD in megabytes (MB).</p>
                        <?php if (isset($errors['size'])): ?>
                            <div class="form__error"><?= htmlspecialchars($errors['size']) ?></div>
                        <?php endif; ?>
                    </div>
        
                    <div class="form__group form__group--hidden-item grid pt-2 pb-2 pl-1 pr-1 xs-p-2 md-p-3 lg-pt-5 lg-pb-5" id="Furniture">
                        <div class="form__item col-start-1 grid sm-pb-2">
                            <label for="height" class="form__label col-start-1">Height (CM)</label>
                            <input type="text" id="height" name="height" class="form__input col-start-2 c-input" step="0.01" value="<?= htmlspecialchars($_POST['height'] ?? '') ?>">
                        </div>
                        <div class="form__item col-start-1 grid sm-pb-2">
                            <label for="width" class="form__label col-start-1 pr-1">Width (CM)</label>
                            <input type="text" id="width" name="width" class="form__input col-start-2 c-input" step="0.01" value="<?= htmlspecialchars($_POST['width'] ?? '') ?>">
                        </div>
                        <div class="form__item col-start-1 grid sm-pb-2">
                            <label for="length" class="form__label col-start-1">Length (CM)</label>
                            <input type="text" id="length" name="length" class="form__input col-start-2 c-input" step="0.01" value="<?= htmlspecialchars($_POST['length'] ?? '') ?>">
                        </div>
                        <p class="form__description p-small">Please enter dimensions: Height x Width x Length</p>
                        <?php if (isset($errors['dimensions'])): ?>
                            <div class="form__error"><?= htmlspecialchars($errors['dimensions']) ?></div>
                        <?php endif; ?>
                </div>
                </div>
            </div>

        </form>
    </div>

    <script>
    function showAttributes() {
        const type = document.getElementById('productType').value;
        document.getElementById('Book').style.display = 'none';
        document.getElementById('DVD').style.display = 'none';
        document.getElementById('Furniture').style.display = 'none';

        if (type === 'Book') {
            document.getElementById('Book').style.display = 'block';
        } else if (type === 'DVD') {
            document.getElementById('DVD').style.display = 'block';
        } else if (type === 'Furniture') {
            document.getElementById('Furniture').style.display = 'grid';
        }
    }
    document.addEventListener('DOMContentLoaded', showAttributes);
</script>
</body>
</html>

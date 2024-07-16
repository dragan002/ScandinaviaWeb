<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Replace with your actual CSS file path -->
</head>
<body>
    <div class="container">
        <h1>Add Product</h1>
        <form action="../../public/add_product.php" method="POST">
            <div class="form-group">
                <label for="sku">SKU:</label>
                <input type="text" id="sku" name="sku" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <select id="type" name="type" required onchange="showAttributes()">
                    <option value="">Select Type</option>
                    <option value="Book">Book</option>
                    <option value="DVD">DVD</option>
                    <option value="Furniture">Furniture</option>
                </select>
            </div>

            <div class="form-group" id="book-attributes" style="display: none;">
                <label for="weight">Weight (Kg):</label>
                <input type="number" id="weight" name="weight" step="0.01">
            </div>

            <div class="form-group" id="dvd-attributes" style="display: none;">
                <label for="size">Size (MB):</label>
                <input type="number" id="size" name="size">
            </div>

            <div class="form-group" id="furniture-attributes" style="display: none;">
                <label for="height">Height (cm):</label>
                <input type="number" id="height" name="height" step="0.01">
                <label for="width">Width (cm):</label>
                <input type="number" id="width" name="width" step="0.01">
                <label for="length">Length (cm):</label>
                <input type="number" id="length" name="length" step="0.01">
            </div>

            <button type="submit">Add Product</button>
        </form>
    </div>

    <script>
        function showAttributes() {
            const type = document.getElementById('type').value;
            document.getElementById('book-attributes').style.display = 'none';
            document.getElementById('dvd-attributes').style.display = 'none';
            document.getElementById('furniture-attributes').style.display = 'none';

            if (type === 'Book') {
                document.getElementById('book-attributes').style.display = 'block';
            } else if (type === 'DVD') {
                document.getElementById('dvd-attributes').style.display = 'block';
            } else if (type === 'Furniture') {
                document.getElementById('furniture-attributes').style.display = 'block';
            }
        }
    </script>
</body>
</html>

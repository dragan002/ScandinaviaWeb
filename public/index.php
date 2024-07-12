<?php
// Autoload dependencies
require_once '/../vendor/autoload.php';

// Include database configuration
require_once '../config/Database.php';

use App\repositories\ProductRepository;
use App\services\ProductService;
use App\controllers\ProductController;

// Initialize repository, service, and controller
$productRepository = new ProductRepository($pdo);
$productService = new ProductService($productRepository);
$productController = new ProductController($productService);

// Determine the action to take based on the request
$action = $_GET['action'] ?? 'list';

// Route the request to the appropriate controller method
switch ($action) {
    case 'list':
        $productController->listProducts();
        break;
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $productController->addProduct($data);
        } else {
            include __DIR__ . '/../views/add_product.php';
        }
        break;
    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $skus = $_POST['delete'] ?? [];
            $productController->deleteProducts($skus);
        }
        break;
    default:
        echo "Unknown action: $action";
        break;
}

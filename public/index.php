<?php
require_once '../config/Database.php';
require_once '../vendor/autoload.php';
echo "OK";
use App\controllers\ProductController;
use App\repositories\ProductRepository;
use App\services\ProductService;

$pdo = Database::getInstance()->getConnection();
$productRepository = new ProductRepository($pdo);
$productService = new ProductService($productRepository);
$productController = new ProductController($productService);

    $products = $productController->listProducts();
?>

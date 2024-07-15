<?php

require_once '../config/Database.php';
require_once '../vendor/autoload.php';

use App\controllers\ProductController;
use App\repositories\ProductRepository;
use App\services\ProductService;

$pdo = Database::getInstance()->getConnection();
$productRepository = new ProductRepository($pdo);
$productService = new ProductService($productRepository);
$productController = new ProductController($productService);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $product = $productController->addProduct($data);
}
var_dump($product);
?>

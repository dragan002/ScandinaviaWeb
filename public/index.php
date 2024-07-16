
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../app/assets/css/styles.css">
</head>

<?php
require_once '../config/Database.php';
require_once '../vendor/autoload.php';

use App\controllers\ProductController;
use App\repositories\ProductRepository;
use App\services\ProductService;

$pdo = Database::getInstance()->getConnection();
$productRepository  = new ProductRepository($pdo);
$productService     = new ProductService($productRepository);
$productController  = new ProductController($productService);

$productController->listProducts();

?>

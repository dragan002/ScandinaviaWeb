<?php
require_once 'config/Database.php';
require_once 'vendor/autoload.php';

use App\controllers\ProductController;
use App\models\DVD;
use App\models\Book;
use App\models\Furniture;
use App\repositories\ProductRepository;
use App\services\ProductService;

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = Database::getInstance()->getConnection();
    $productRepository = new ProductRepository($pdo);
    $productService = new ProductService($productRepository);
    $productController = new ProductController($productService);

    $listServices = $productController->listProducts();
    print_r($listServices);

    // $dvd = new DVD('SKU123', 'DVD Product', 19.99, 700);
    $book = new Book('SKU124', 'Book Product', 9.99, 1.5);
    // $furniture = new Furniture('SKU1sasa2dsa5', 'Furniture Product', 9999, 502, 10032, 20032);


    $productRepository->save($furniture);
    $productRepository->save($book);

    echo "Dummy data inserted successfully.";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


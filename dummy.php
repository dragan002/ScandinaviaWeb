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

    $dvd = new DVD('msmssasams', 'DVD Product', 19.99, 700);
    $book = new Book('smsasasms', 'Book Product', 9.99, 1);
    $furniture = new Furniture('okkksasssam', 'Furniture Product', 99.99, 50.0, 100.0, 200.0);

    $productRepository->save($dvd);
    $productRepository->save($book);
    $productRepository->save($furniture);

    echo "Dummy data inserted successfully.";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


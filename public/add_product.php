<?php

require_once '../config/Database.php';
require_once '../vendor/autoload.php';

use App\controllers\ProductController;
use App\repositories\ProductRepository;
use App\services\ProductService;

$pdo = Database::getInstance()->getConnection();

$productRepository   = new ProductRepository($pdo);
$productService      = new ProductService($productRepository);
$productController   = new ProductController($productService);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       try {
           // Sanitize and validate $_POST data before use
           $data = filter_input_array(INPUT_POST, [
               'sku' => FILTER_SANITIZE_STRING,
               'name' => FILTER_SANITIZE_STRING,
               'price' => FILTER_SANITIZE_NUMBER_FLOAT,
               'type' => FILTER_SANITIZE_STRING,
               'weight' => FILTER_SANITIZE_NUMBER_FLOAT,
               'size' => FILTER_SANITIZE_NUMBER_FLOAT,
               'height' => FILTER_SANITIZE_NUMBER_FLOAT,
               'width' => FILTER_SANITIZE_NUMBER_FLOAT,
               'length' => FILTER_SANITIZE_NUMBER_FLOAT,
           ]);
       //     print_r($data);
           $productController->addProduct($data);
           // Redirect or provide success feedback
       //     header('Location: index.php'); // Change to your success page
           exit;
       } catch (Exception $e) {
           // Handle error appropriately
           echo "Error during adding product: " . $e->getMessage();
       }
   }
?>

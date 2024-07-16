<?php

require_once '../Config/Database.php';
require_once '../vendor/autoload.php';

use App\Controllers\ProductController;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use App\Validators\NewProductValidator;

$pdo = Database::getInstance()->getConnection();

$productRepository   = new ProductRepository($pdo);
$productService      = new ProductService($productRepository);
$productController   = new ProductController($productService);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Sanitize $_POST data
        $data = filter_input_array(INPUT_POST, [
            'sku'    => FILTER_SANITIZE_STRING,
            'name'   => FILTER_SANITIZE_STRING,
            'price'  => FILTER_SANITIZE_NUMBER_FLOAT,
            'type'   => FILTER_SANITIZE_STRING,
            'weight' => FILTER_SANITIZE_NUMBER_FLOAT,
            'size'   => FILTER_SANITIZE_NUMBER_FLOAT,
            'height' => FILTER_SANITIZE_NUMBER_FLOAT,
            'width'  => FILTER_SANITIZE_NUMBER_FLOAT,
            'length' => FILTER_SANITIZE_NUMBER_FLOAT,
        ]);

        $validator = new NewProductValidator();
        $validatedData = $validator->validateData($data); 

        $productController->addProduct($validatedData);

        header('Location: index.php'); 
        exit;
    } catch (Exception $e) {
        echo "Error during adding product: " . $e->getMessage();
    }
}

?>

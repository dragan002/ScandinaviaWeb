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


$errors = [];  // Ensure errors are always initialized
$data = $_POST;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Sanitize $_POST data using more secure methods
        $data = filter_input_array(INPUT_POST, [
            'sku'    => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'name'   => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'price'  => [
                'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags'  => FILTER_FLAG_ALLOW_FRACTION
            ],
            'type'   => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'weight' => [
                'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags'  => FILTER_FLAG_ALLOW_FRACTION
            ],
            'size'   => [
                'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags'  => FILTER_FLAG_ALLOW_FRACTION
            ],
            'height' => [
                'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags'  => FILTER_FLAG_ALLOW_FRACTION
            ],
            'width'  => [
                'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags'  => FILTER_FLAG_ALLOW_FRACTION
            ],
            'length' => [
                'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags'  => FILTER_FLAG_ALLOW_FRACTION
            ],
        ]);

        $validator      = new NewProductValidator();
        $validatedData  = $validator->validateData($data); 

        $productController->addProduct($validatedData);
        header('Location: index.php'); 
        exit;
    } catch (Exception $e) {
        echo "Error during adding produccct: " . $e->getMessage();        
    }
}

?>

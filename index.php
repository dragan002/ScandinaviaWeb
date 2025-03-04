
<?php 

include_once 'App/Repositories/ProductRepository.php';
include_once 'App/Services/ProductService.php';
include_once 'App/Repositories/CategoryRepository.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../App/assets/css/styles.css">
</head>

<?php
require_once 'Config/Database.php';
require_once 'vendor/autoload.php';

use Database;

use App\Repositories\ProductRepository;
use App\Services\ProductService;
use App\Controllers\ProductController;

    $pdo = Database::getInstance()->getConnection();
    
    $productRepository  = new ProductRepository($pdo);
    $productService     = new ProductService($productRepository);
    $productController  = new ProductController($productService);

    $productController->listProducts();
    $productController->deleteProducts();


?>

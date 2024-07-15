<?php

namespace App\controllers;

use App\models\DVD;
use App\models\Book;
use App\models\Furniture;
use App\services\ProductService;

class ProductController 
{
    public $products;

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function listProducts()
    {
        try {
            $products = $this->productService->listProducts();
            
            include __DIR__ . '/../views/product_list.php';
        } catch (\Exception $e) {
            echo "Error listing products: " . $e->getMessage();
        }
    }

    public function addProduct(array $data) {
        try {
            $data = $_POST;
            
            $product = $this->productService->addProduct($data);
            
            header('Location: /public/index.php');
        } catch(\Exception $e) {
            echo "Error during adding product: " . $e->getMessage();
        }
    }
}
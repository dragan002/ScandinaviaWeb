<?php

namespace App\Controllers;

use App\Services\ProductService;


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
                        
            header('Location: index.php');
        } catch(\Exception $e) {
            echo "Error during adding product: " . $e->getMessage();
        }
    }

    public function deleteProducts() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteSku'])) {
            $skusToDelete = $_POST['deleteSku'];
            if (!empty($skusToDelete)) {
                $this->productService->deleteProducts($skusToDelete);
            } 
        }
    }
}
<?php

namespace App\controllers;

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
            include '../views/product_list.php';
        } catch (\Exception $e) {
            echo "Error listing products: " . $e->getMessage();
        }
    }

    public function addProduct(array $data) {
        try {
            $product = $this->productService->addProduct($data);
            include __DIR__ . 'public/index.php';
        } catch(\Exception $e) {
            echo "Error during adding product: " . $e->getMessage();
        }
    }

    public function deleteProducts(array $skus)
    {
        try {
            $success = $this->productService->deleteProducts($skus);
            if(!$success) {
                echo "Could not delete the products";
            }
            header('Location: public/index.php');
        } catch(\Exception $e) {
            echo "Error deleting products " . $e->getMessage();
        }
    }
}
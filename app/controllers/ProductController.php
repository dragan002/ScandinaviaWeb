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

            // $products = [
            //     new DVD('SKU00sasasa1', 'DVD Product 1', 14.99, 700),
            //     new Book('SKU002', 'Book Product 1', 9.99, 1.2),
            //     new Furniture('SKU003', 'Furniture Product 1', 299.99, 120, 60, 80),
            //     new DVD('SKU004', 'DVD Product 2', 19.99, 850),
            //     new Book('SKU005', 'Book Product 2', 15.99, 2.0),
            // ];

            // include '../views/product_list.php';
            include __DIR__ . '/../views/product_list.php';
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
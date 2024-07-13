<?php

namespace App\services;

use App\repositories\ProductRepository;

class ProductService 
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProducts(): array 
    {
        $products = $this->productRepository->findAll();
        var_dump($products);
        return $products;
    }

    public function addProduct(array $data): void
    {
        $this->productRepository->createAndSave($data);
    }

    public function deleteProducts(array $skus): bool 
    {
        return $this->productRepository->delete($skus);
    }
}
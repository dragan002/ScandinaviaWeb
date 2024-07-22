<?php

namespace App\Services;

use App\Factories\ProductFactory;
use App\Repositories\ProductRepository;
use App\Validators\NewProductValidator;

class ProductService 
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProducts(): array 
    {
        return $this->productRepository->findAll();
    }

    public function addProduct(array $data): void
    {
        $validator = new NewProductValidator;
        
        $validatedData = $validator->validateData($data);
        
        $product = ProductFactory::create($validatedData);
        
        $save = $this->productRepository->save($product);
    }

    public function deleteProducts(array $sku): bool
    {
        return $this->productRepository->deleteProductsBySkus($sku);
    }
}
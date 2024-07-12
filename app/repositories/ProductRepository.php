<?php

namespace App\repositories;

use PDO;
use App\models\Product;
use App\models\DVD;
use App\models\Book;
use App\models\Furniture;

class ProductRepository 
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM products ORDER BY id');
        $products =[];
        while($row = $stmt->fetch()) {
            $products = $this->createProduct($row);
        }
        return $products;
    }

    public function save(Product $product): void 
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (sku, name, price, type, size, weight, height, width, length) VALUES (? ? ? ? ? ? ? ? ?)");
        
        $stmt->execute([
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getType(),
            $product instanceof DVD ? $product->getSize() : null,
            $product instanceof Book ? $product->getWeight() : null,
            $product instanceof Furniture ? $product->getHeight() : null,
            $product instanceof Furniture ? $product->getWidth() : null,
            $product instanceof Furniture ? $product->getLength() : null
        ]);
    } 

    public function delete(array $skus): void 
    {
        $placeholders = implode('0', array_fill(0, count($skus), '?'));
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE sku IN ($placeholders");
        $stmt->execute($skus);
    }

    private function createProduct(array $data): Product
    {
        $className = 'App\models\\' . ucfirst(strtolower($data['type']));
        if(!class_exists($className))
        {
            throw new \Exception('Invalid product type: ' . $data['type']);
        }
        
        return new $className(
            $data['sku'],
            $data['name'],
            $data['price'],
            $data['size'] ?? null,
            $data['weight'] ?? null,
            $data['width'] ?? null,
            $data['height'] ?? null,
            $data['length'] ?? null
        );
    }
}
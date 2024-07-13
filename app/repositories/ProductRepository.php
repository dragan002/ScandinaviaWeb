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
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $products = [];
        
        foreach ($rows as $row) {
            $products[] = $this->createProduct($row);
            var_dump(count($products));
        }
        return $products;
    }

    public function delete(array $skus): bool 
    {
        $placeholders = implode('0', array_fill(0, count($skus), '?'));
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE sku IN ($placeholders");
        return $stmt->execute($skus);
    }

    private function createProduct(array $data): Product
    {
        $className = 'App\models\\' . ucfirst(strtolower($data['type']));
        if (!class_exists($className)) {
            throw new \Exception('Invalid product type: ' . $data['type']);
        }
        // var_dump($className);

        switch ($className) {
            case 'App\models\DVD':
                return new DVD($data['sku'], $data['name'], $data['price'], $data['size']);
            case 'App\models\Book':
                return new Book($data['sku'], $data['name'], $data['price'], $data['weight']);
            case 'App\models\Furniture':
                return new Furniture($data['sku'], $data['name'], $data['price'], $data['height'], $data['width'], $data['length']);
            default:
                throw new \Exception('Unsupported product type: ' . $data['type']);
        }
    }

    public function save(Product $product): void 
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (sku, name, price, type, size, weight, height, width, length) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

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

    public function createAndSave(array $data): void
    {
        $product = $this->createProduct($data);
        $this->save($product);
    }
}


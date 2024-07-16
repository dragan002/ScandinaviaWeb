<?php

namespace App\Repositories;

use PDO;
use App\Models\DVD;
use App\Models\Book;
use App\Models\Product;
use App\Models\Furniture;
use App\Factories\ProductFactory;
use PDOException;

class ProductRepository 
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt       = $this->pdo->query('SELECT * FROM products ORDER BY id');
        $rows       = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $products   = [];
        
        foreach ($rows as $row) {
        $products[] = ProductFactory::create($row);
        }
        return $products;
    }

    public function save(Product $product): bool 
    {
        try {
            $this->pdo->beginTransaction();
    
            $stmt = $this->pdo->prepare("INSERT INTO products (sku, name, price, type, size, weight, height, width, length) VALUES (:sku, :name, :price, :type, :size, :weight, :height, :width, :length)");
            
            $sku    = $product->getSku();
            $name   = $product->getName();
            $price  = $product->getPrice();
            $type   = $product->getType();
            $size   = $product instanceof DVD ? $product->getSize() : null;
            $weight = $product instanceof Book ? $product->getWeight() : null;
            $height = $product instanceof Furniture ? $product->getHeight() : null;
            $width  = $product instanceof Furniture ? $product->getWidth() : null;
            $length = $product instanceof Furniture ? $product->getLength() : null;
        
            $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':size', $size);
            $stmt->bindParam(':weight', $weight);
            $stmt->bindParam(':height', $height);
            $stmt->bindParam(':width', $width);
            $stmt->bindParam(':length', $length);
    
            $stmt->execute();
            $this->pdo->commit();
    
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            // Consider logging this error or handling it more robustly
            return false;
        }
    }
}

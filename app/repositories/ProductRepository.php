<?php

namespace App\repositories;

use PDO;
use App\models\DVD;
use App\models\Book;
use App\models\Product;
use App\models\Furniture;
use App\factories\ProductFactory;
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
            $stmt = $this->pdo->prepare("INSERT INTO products (sku, name, price, type, size, weight, height, width, length) VALUES (:sku, :name, :price, :type, :size, :weight, :height, :width, :length)");
            
            $stmt->bindParam(':sku',    $product->getSku());
            $stmt->bindParam(':name',   $product->getName());
            $stmt->bindParam(':price',  $product->getPrice());
            $stmt->bindParam(':type',   $product->getType());
            $stmt->bindParam(':size',   $product instanceof DVD         ? $product->getSize()    : null);
            $stmt->bindParam(':weight', $product instanceof Book        ?  $product->getWeight() : null);
            $stmt->bindParam(':height', $product instanceof Furniture   ? $product->getHeight()  : null);
            $stmt->bindParam(':width',  $product instanceof Furniture   ? $product->getWidth()   : null);
            $stmt->bindParam(':length', $product instanceof Furniture   ? $product->getLength()  : null);

            $stmt->execute();
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();

            return false;
        }
    }
}

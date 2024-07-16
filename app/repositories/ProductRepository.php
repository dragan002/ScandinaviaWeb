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
            $this->pdo->beginTransaction();
    
            $stmt = $this->pdo->prepare("INSERT INTO products (sku, name, price, type, size, weight, height, width, length) VALUES (:sku, :name, :price, :type, :size, :weight, :height, :width, :length)");
            
            $stmt->bindParam(':sku', $product->getSku(), PDO::PARAM_STR);
            $stmt->bindParam(':name', $product->getName(), PDO::PARAM_STR);
            $stmt->bindParam(':price', $product->getPrice(), PDO::PARAM_STR);
            $stmt->bindParam(':type', $product->getType(), PDO::PARAM_STR);
            $stmt->bindParam(':size', $product instanceof DVD ? $product->getSize() : null, PDO::PARAM_INT);
            $stmt->bindParam(':weight', $product instanceof Book ? $product->getWeight() : null, PDO::PARAM_INT);
            $stmt->bindParam(':height', $product instanceof Furniture ? $product->getHeight() : null, PDO::PARAM_INT);
            $stmt->bindParam(':width', $product instanceof Furniture ? $product->getWidth() : null, PDO::PARAM_INT);
            $stmt->bindParam(':length', $product instanceof Furniture ? $product->getLength() : null, PDO::PARAM_INT);
    
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

// try {
//     $this->pdo->beginTransaction();

//     $stmt = $this->pdo->prepare("INSERT INTO products (sku, name, price, type, size, weight, height, width, length) VALUES (:sku, :name, :price, :type, :size, :weight, :height, :width, :length)");

//     $values = [
//         ':sku'    => $product->getSku(),
//         ':name'   => $product->getName(),
//         ':price'  => $product->getPrice(),
//         ':type'   => $product->getType(),
//         ':size'   => $product instanceof DVD? $product->getSize() : null,
//         ':weight' => $product instanceof Book? $product->getWeight() : null,
//         ':height' => $product instanceof Furniture? $product->getHeight() : null,
//         ':width'  => $product instanceof Furniture? $product->getWidth() : null,
//         ':length' => $product instanceof Furniture? $product->getLength() : null,
//     ];

//     $stmt->execute($values);

//     $this->pdo->commit();

//     return true;
// } catch (PDOException $e) {
//     $this->pdo->rollBack();
//     throw $e; // re-throw the exception
// }
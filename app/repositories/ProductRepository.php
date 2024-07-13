<?php

namespace App\repositories;

use PDO;
use App\models\DVD;
use App\models\Book;
use App\models\Product;
use App\models\Furniture;
use App\factories\ProductFactory;

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
        $products[] = ProductFactory::create($row);
        }
        return $products;
    }

    public function delete(array $skus): bool 
    {
        $placeholders = implode('0', array_fill(0, count($skus), '?'));
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE sku IN ($placeholders");
        return $stmt->execute($skus);
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

}

//  "App\models\Furniture" array(1) {
//      [0]=> object(App\models\Furniture)#9 
//      (7) { ["sku":protected]=> string(9) "YSHR763-C" 
//         ["name":protected]=> string(8) "KIA SOFA" 
//         ["price":protected]=> float(288) 
//         ["type":protected]=> string(9) "Furniture" 
//         ["height":"App\models\Furniture":private]=> float(200) 
//         ["width":"App\models\Furniture":private]=> float(300) 
//         ["length":"App\models\Furniture":private]=> float(400) } }
//          string(20) "App\models\Furniture" 
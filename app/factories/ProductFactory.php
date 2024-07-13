<?php

namespace App\factories;

use App\models\DVD;
use App\models\Book;
use App\models\Furniture;
use App\models\Product;

class ProductFactory
{
    public static function create(array $data): Product
    {
        $className = 'App\models\\' . ucfirst(strtolower($data['type']));
        
        if (!class_exists($className)) {
            throw new \Exception('Unsupported product type: ' . $data['type']);
        }

        return new $className(
            $data['sku'],
            $data['name'],
            (float) $data['price'],
            (float) ($data['size'] ?? 0),
            (float) ($data['weight'] ?? 0),
            (float) ($data['height'] ?? 0),
            (float) ($data['width'] ?? 0),
            (float) ($data['length'] ?? 0)
        );
    }
}

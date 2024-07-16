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
        
        $filteredData = array_filter([
            'size'      => $data['size']?? 0,
            'weight'    => $data['weight']?? 0,
            'height'    => $data['height']?? 0,
            'width'     => $data['width']?? 0,
            'length'    => $data['length']?? 0,
        ]);

        $floatValues = array_map('floatval', $filteredData);

        return new $className(
            $data['sku'],
            $data['name'],
            (float) $data['price'],
            ...$floatValues
        );
    }
}
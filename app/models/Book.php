<?php

namespace App\models;

use App\models\Product;

class Book extends Product
{
    private int $weight;
    
    public function __construct(string $sku, string $name, float $price, int $weight )
    {
        parent::__construct($sku, $name, $price, 'Book');
        $this->weight = $weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getAttribute(): string
    {
        return 'Weight: ' . $this->weight . ' Kg';
    }
}
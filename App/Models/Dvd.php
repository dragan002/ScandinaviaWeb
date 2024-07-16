<?php

namespace App\Models;

use App\Models\Product;

class Dvd extends Product
{
    private int $size;

    public function __construct(string $sku, string $name, float $price, int $size)
    {
        parent::__construct($sku, $name, $price, 'DVD');
        $this->size = $size;
    }

    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getAttribute(): string
    {
        return "Size {$this->size} MB";
    }
}
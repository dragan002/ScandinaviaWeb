<?php

namespace App\models;

class DVD extends Product
{
    private int $size;

    public function __construct(string $sku, string $name, float $price)
    {
        parent::__construct($sku, $name, $price, 'DVD');
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
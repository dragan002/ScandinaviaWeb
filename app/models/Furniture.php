<?php

namespace App\models;

class Furniture extends Product 
{
    private int $height;
    private int $width;
    private int $length;

    public function __construct(string $sku, string $name, float $price, int $height, int $width, int $length )
    {
        parent::__construct($sku, $name, $price, 'Furniture');
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getAttribute(): string
    {
        return "Dimensions: {$this->height}x{$this->width}x{$this->length} cm";
    }
}
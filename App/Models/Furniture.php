<?php

namespace App\Models;

use App\Models\Product;

class Furniture extends Product
{
    private float $height;
    private float $width;
    private float $length;

    public function __construct(string $sku, string $name, float $price, float $height, float $width, float $length)
    {
        parent::__construct($sku, $name, $price, 'Furniture');
            $this->height   = $height;
            $this->width    = $width;
            $this->length   = $length;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setWidth(float $width): void 
    {
        $this->width = $width;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setLength(float $length): void
    {
        $this->length = $length;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function getAttribute(): string
    {
        return "Dimensions: {$this->height}x{$this->width}x{$this->length} cm";
    }
}

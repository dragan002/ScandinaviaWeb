<?php

namespace App\models;

use App\models\Interface\ProductAttributeInterface;

abstract class Product implements ProductAttributeInterface
{
    protected string $sku;
    protected string $name;
    protected float $price;
    protected string $type;

    public function __construct(string $sku, string $name, float $price, string $type)
    {
        $this->sku      = $sku;
        $this->name     = $name;
        $this->price    = $price;
        $this->type     = $type;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    abstract public function getAttribute(): string;
}

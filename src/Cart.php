<?php

class Cart {
    public float $price;
    
    public static float $tax = 1.5;

    public function getNetPrice(): float {
        return $this->price * self::$tax;
    }
}
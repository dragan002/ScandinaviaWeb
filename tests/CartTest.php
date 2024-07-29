<?php

class CartTest extends \PHPUnit\Framework\TestCase 
{
    public function testNetPriceIsCalculatedCorrectly() 
    {
        //setup
        require 'src/Cart.php';

        $cart = new Cart();

        $cart->price = 10;
        // do something

        $netPrice = $cart->getNetPrice();

        //Make assertions

        $this->assertEquals(15, $netPrice);
    }
}
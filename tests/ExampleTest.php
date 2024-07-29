<?php

class ExampleTest extends \PHPUnit\Framework\TestCase {

   public function testTheTwoStringsAreTheSame() {
    $string1 = 'draganvujic';
    $string2 = 'draganvujic';

    $this->assertSame($string1, $string2);
   }

   public function testProductIsCalculatedCorrectly() {
    require 'exampleFunction.php';

    $product = product(10, 2);

    $this->assertEquals(20, $product);

    $this->assertNotEquals(10, $product);
   }
}
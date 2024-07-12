<?php

namespace App\controllers;

use App\models\Product;
use App\models\DVD;
use App\models\Book;
use App\models\Furniture;

class ProductController 
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  
}
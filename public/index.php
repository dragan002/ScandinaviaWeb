<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

echo "scandinaviasasa";

if($conn) {
    echo "Connection error: " . mysqli_connect_error();
}
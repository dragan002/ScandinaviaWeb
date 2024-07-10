<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/Database.php';

echo "scandinaviasasa";


try {
    $db = Database::getInstance();
    $pdo = $db->getConnection();
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}
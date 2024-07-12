<?php
require_once 'Database.php'; // Adjust the path as needed

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Get the database instance and connection
    $dbInstance = Database::getInstance();
    $pdo = $dbInstance->getConnection();

    // Perform a simple query to test the connection
    $stmt = $pdo->query('SELECT 1');
    $result = $stmt->fetch();

    if ($result) {
        echo 'Database connection is successful. Test query result: ' . $result[1];
    } else {
        echo 'Test query failed.';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

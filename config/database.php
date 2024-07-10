<?php
$servername = "127.0.0.1"; 
$username = "root";
$password = ""; 
$dbname = "products_base";

$conn = new mysqli($servername, $username, $password, $dbname);

if(!$conn) {
    echo "Connection error: " . mysqli_connect_error();
}

?>

<?php
$host = 'localhost'; carrito
$user = 'root'; 
$password = ''; 
$database = 'carrito'; 

$db = new mysqli($host, $user, $password, $database);

if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}
?>

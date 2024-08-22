<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'CARRITOO';

// Crear la conexión a la base de datos
$connection = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($connection->connect_error) {
    die("Error en la conexión: " . $connection->connect_error);
}

// Ejecutar la consulta para obtener los nombres de los docentes
$sql = "SELECT nombre, descripcion, precio, imagen FROM productos";
$result = $connection->query($sql);

// Crear un array para guardar los nombres
$nombres = [];

if ($result->num_rows > 0) {
    // Guardar los nombres en el array
    while ($row = $result->fetch_assoc()) {
        $nombres[] = $row['nombre', 'descripcion', 'precio', 'imagen'];
    }
}

// Devolver los nombres como JSON
echo json_encode($nombres);

// Cerrar la conexión
$connection->close();
?>

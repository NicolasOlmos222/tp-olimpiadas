<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CARRITOO";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre_producto = $_POST['nombre_producto'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? '';
$cantidad = $_POST['cantidad'] ?? '';
$imagen = $_POST['imagen'] ?? '';

// Preparar la sentencia SQL
$sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, imagen) VALUES (?, ?, ?, ?, ?)";

// Preparar y vincular
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre_producto, $descripcion, $precio, $cantidad, $imagen);

// Ejecutar la sentencia
if ($stmt->execute()) {
    echo "Carga completa";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
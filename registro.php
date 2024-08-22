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
$nombre_usuario = $_POST['usuario'] ?? '';
$correo = $_POST['correo'] ?? '';
$contrasena = $_POST['password'] ?? '';

// Encriptar la contraseña
$contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

// Preparar la sentencia SQL
$sql = "INSERT INTO clientes (nombre, correo, contrasena) VALUES (?, ?, ?)";

// Preparar y vincular
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre_usuario, $correo, $contrasena);

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
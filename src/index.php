<?php
session_start();
include('db.php'); // Archivo de conexión a la base de datos

// Consultar lista de productos
$query = "SELECT * FROM productos";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="cart.php">Ver Carrito</a> | <a href="order.php">Mis Pedidos</a> | <a href="logout.php">Cerrar Sesión</a>
    <?php else: ?>
        <a href="login.php">Iniciar Sesión</a> | <a href="register.php">Registrarse</a>
    <?php endif; ?>
    
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['codigo']); ?></td>
                    <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($row['precio']); ?></td>
                    <td><a href="product.php?codigo=<?php echo urlencode($row['codigo']); ?>">Ver</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit();
?>

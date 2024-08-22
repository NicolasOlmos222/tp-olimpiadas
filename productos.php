<?php
include('db.php');

$codigo = $_GET['codigo'];
$stmt = $db->prepare("SELECT * FROM productos WHERE codigo = ?");
$stmt->bind_param('s', $codigo);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['descripcion']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($product['descripcion']); ?></h1>
    <p>Precio: <?php echo htmlspecialchars($product['precio']); ?></p>
    <form action="cart.php" method="post">
        <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($product['codigo']); ?>">
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" min="1" required>
        <button type="submit">Añadir al carrito</button>
    </form>
    <a href="index.php">Volver a la lista de productos</a>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $cantidad = (int)$_POST['cantidad'];

    if (isset($_SESSION['cart'][$codigo])) {
        $_SESSION['cart'][$codigo] += $cantidad;
    } else {
        $_SESSION['cart'][$codigo] = $cantidad;
    }
}

$cart = $_SESSION['cart'];
include('db.php');

$items = [];
foreach ($cart as $codigo => $cantidad) {
    $stmt = $db->prepare("SELECT * FROM productos WHERE codigo = ?");
    $stmt->bind_param('s', $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $item['cantidad'] = $cantidad;
    $items[] = $item;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['codigo']); ?></td>
                    <td><?php echo htmlspecialchars($item['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($item['precio']); ?></td>
                    <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
                    <td><?php echo htmlspecialchars($item['precio'] * $item['cantidad']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="order.php">Realizar Pedido</a>
    <a href="index.php">Volver a la lista de productos</a>
</body>
</html>

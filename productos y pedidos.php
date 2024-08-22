<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        $stmt = $db->prepare("INSERT INTO productos (codigo, descripcion, precio) VALUES ($codigo,$descripcion,$precio)");
        $stmt->bind_param('ssd', $codigo, $descripcion, $precio);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Productos y Pedidos</title>
</head>
<body>
    <h1>Administrar Productos y Pedidos</h1>
    <h2>Cargar Nuevo Producto</h2>
    <form method="post">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" required><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" required><br>
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" required><br>
        <button type="submit" name="add_product">Agregar Producto</button>
    </form>

    <h2>Consultar Pedidos Pendientes</h2>
    <?php
    $query = "SELECT * FROM pedidos WHERE estado = 'pendiente'";
    $result = $db->query($query);
    ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente ID</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['cliente_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($row['estado']); ?></td>
                    <td>
                        <a href="delivery.php?pedido_id=<?php echo htmlspecialchars($row['id']); ?>">Marcar como Entregado</a>
                        <a href="cancel.php?pedido_id=<?php echo htmlspecialchars($row['id']); ?>">Cancelar Pedido</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

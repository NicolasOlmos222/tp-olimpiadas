<?php
session_start();
include('db.php');

if (isset($_GET['pedido_id'])) {
    $pedido_id = $_GET['pedido_id'];
    
    $stmt = $db->prepare("UPDATE pedidos SET estado = 'entregado' WHERE id = ?");
    $stmt->bind_param('i', $pedido_id);
    $stmt->execute();
    
    header('Location: admin.php');
    exit();
}
?>
<?php
session_start();
include('db.php');

if (isset($_GET['pedido_id'])) {
    $pedido_id = $_GET['pedido_id'];
    
    $stmt = $db->prepare("UPDATE pedidos SET estado = 'cancelado' WHERE id = ?");
    $stmt->bind_param('i', $pedido_id);
    $stmt->execute();
    
    header('Location: admin.php');
    exit();
}
?>

<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id']) && !empty($_SESSION['cart'])) {
        $user_id = $_SESSION['user_id'];
        $cart = $_SESSION['cart'];
        
        $stmt = $db->prepare("INSERT INTO pedidos (cliente_id, fecha) VALUES (?, NOW())");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $pedido_id = $db->insert_id;
        
        foreach ($cart as $codigo => $cantidad) {
            $stmt = $db->prepare("INSERT INTO pedido_items (pedido_id, codigo, cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param('isi', $pedido_id, $codigo, $cantidad);
            $stmt->execute();
        }
        
        $_SESSION['cart'] = []; // Vaciar el carrito después de realizar el pedido
        
        echo 'Pedido realizado con éxito.';
    } else {
        echo 'No hay productos en el carrito o no estás autenticado.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Pedido</title>
</head>
<body>
    <h1>Realizar Pedido</h1>
    <form method="

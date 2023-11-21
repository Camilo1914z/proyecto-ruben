<?php
session_start();
include('../base_datos.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $producto_id = $_POST['eliminar'];

    // Agrega el producto nuevamente al stock
    $sql = "UPDATE productos SET stock = stock + 1 WHERE producto_id = $producto_id";
    $conn->query($sql);

    // Elimina el producto del carrito
    if (($key = array_search($producto_id, $_SESSION['carrito'])) !== false) {
        unset($_SESSION['carrito'][$key]);
    }
}

$conn->close();

// Redirige de vuelta a la página del carrito
header('Location: mi_carrito.php');
exit();
?>

<?php
include('../base_datos.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM productos WHERE producto_id=?");
    $stmt->bind_param("i", $producto_id);

    if ($stmt->execute()) {
        $message = "Producto eliminado exitosamente";
    } else {
        $message = "Error al eliminar el producto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $message = "ID de producto no proporcionado o método incorrecto";
}

header("Location: index.php");
exit();
?>

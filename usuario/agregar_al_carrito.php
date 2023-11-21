<?php
include('../base_datos.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id']; 

    // Actualizar el stock del producto
    $sql = "UPDATE productos SET stock = stock - 1 WHERE producto_id = $producto_id";

    if ($conn->query($sql) === TRUE) {
        $response = [
            'success' => true,
            'stock' => obtenerNuevoStock($conn, $producto_id),
        ];

        // Agregar el producto al carrito en la sesión
        $_SESSION['carrito'][] = $producto_id;
    } else {
        $response = [
            'success' => false,
            'error' => $conn->error,
        ];
    }

    $conn->close();

    echo json_encode($response);
}

function obtenerNuevoStock($conn, $producto_id) {
    $sql = "SELECT stock FROM productos WHERE producto_id = $producto_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['stock'];
    }

    return null;
}
?>

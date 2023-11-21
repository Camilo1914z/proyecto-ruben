<?php
include('../../base_datos.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM metodopagos WHERE MetodoPago_id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: metodos_pago.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

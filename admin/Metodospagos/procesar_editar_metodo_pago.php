<?php
include('../../base_datos.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE metodopagos SET Nombre = '$nombre', Descripcion = '$descripcion' WHERE MetodoPago_id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: metodos_pago.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

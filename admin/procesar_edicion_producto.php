<?php
include('../base_datos.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio']); // Convertir a número flotante
    $stock = intval($_POST['stock']); // Convertir a entero

    // Validar precio y stock
    if (!is_numeric($precio) || !is_numeric($stock) || $precio < 0 || $stock < 0) {
        $message = "Precio y stock deben ser números positivos.";
    } else {
        // Verificar si se ha subido una nueva imagen
        if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $target_file = $target_dir . uniqid() . basename($_FILES["imagen"]["name"]);
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                $imagen = $target_file;
            } else {
                $message = "Error al mover la imagen.";
            }
        } else {
            // Si no se subió una nueva imagen, mantener la existente
            $imagen = $_POST['imagen_actual'];
        }

        $stmt = $conn->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=?, imagen=? WHERE producto_id=?");
        $stmt->bind_param("ssddsi", $nombre, $descripcion, $precio, $stock, $imagen, $producto_id);

        if ($stmt->execute()) {
            $message = "Producto editado exitosamente";
        } else {
            $message = "Error en la edición: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}

header("Location: index.php"); // Redirigir al index.php del administrador
exit();
?>

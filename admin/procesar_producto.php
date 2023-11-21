<?php
include('../base_datos.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio']); // Convertir a número flotante
    $stock = intval($_POST['stock']); // Convertir a entero

    // Validar precio y stock
    if (!is_numeric($precio) || !is_numeric($stock) || $precio < 0 || $stock < 0) {
        $message = "Precio y stock deben ser números positivos.";
    } else {
        // Ruta donde se guardarán las imágenes
        $target_dir = "uploads/";

        // Generar un nombre único para la imagen
        $target_file = $target_dir . uniqid() . basename($_FILES["imagen"]["name"]);

        // Mover la imagen al directorio de destino
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            // Guardar la ruta de la imagen en la base de datos
            $imagen = $target_file;

            $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, imagen) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdds", $nombre, $descripcion, $precio, $stock, $imagen);

            if ($stmt->execute()) {
                $message = "Producto creado exitosamente";

                // Redireccionar al usuario
                header("Location: index.php"); // Cambia "index.php" por la página a la que quieres redireccionar
                exit(); // Asegúrate de terminar el script después de la redirección
            } else {
                $message = "Error en la inserción: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Error al mover la imagen.";
        }
    }

    $conn->close();
}
?>

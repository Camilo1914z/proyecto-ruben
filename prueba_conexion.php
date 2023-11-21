<?php
include "base_datos.php";

if ($conn) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
}
?>

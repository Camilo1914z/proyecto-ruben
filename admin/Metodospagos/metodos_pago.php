<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tienda - Administrador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #FF0000; /* Cambiar a rojo (#FF0000) */
        }
        .navbar-dark .navbar-brand {
            color: #ffffff;
            font-size: 2em;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">
        <span style="font-size: 2em;">Tienda</span>
    </a>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
                <a class="nav-link" href="../index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productos.php">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="metodos_pagos.php">Métodos de Pago</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    session_start();
                    if (isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } else {
                        echo "Usuario";
                    }
                    ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Perfil</a>
                    <a class="dropdown-item" href="#">Configuraciones</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../login.php">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Contenido de la página para el administrador -->
<?php
include('../../base_datos.php');

$sql = "SELECT MetodoPago_id, Nombre, Descripcion FROM metodopagos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="container mt-4">';
    echo '<h2>Métodos de Pago</h2>';
    echo '<a href="agregar_metodo_pago.php" class="btn btn-primary">Agregar Método de Pago</a>';
    echo '<table class="table mt-3">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nombre</th>';
    echo '<th>Descripción</th>';
    echo '<th>Acciones</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["MetodoPago_id"] . '</td>';
        echo '<td>' . $row["Nombre"] . '</td>';
        echo '<td>' . $row["Descripcion"] . '</td>';
        echo '<td>';
        echo '<a href="editar_metodo_pago.php?id=' . $row["MetodoPago_id"] . '" class="btn btn-primary">Editar</a>';
        echo '<a href="eliminar_metodo_pago.php?id=' . $row["MetodoPago_id"] . '" class="btn btn-danger" onclick="confirmarEliminar(' . $row["MetodoPago_id"] . ')">Eliminar</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<div class="container mt-4">';
    echo '<h2>Métodos de Pago</h2>';
    echo '<p>No hay métodos de pago registrados</p>';
    echo '<a href="agregar_metodo_pago.php" class="btn btn-primary">Agregar Método de Pago</a>';
    echo '</div>';
}

$conn->close();
?>

<script>
function confirmarEliminar(metodoPago_id) {
    var confirmacion = confirm("¿Estás seguro de que deseas eliminar este método de pago?");
    if (confirmacion) {
        window.location.href = "eliminar_metodo_pago.php?id=" + metodoPago_id;
    }
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

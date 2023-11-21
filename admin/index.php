<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tienda - Administrador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #34e89e, #0f3443);
            color: #fff;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #FF0000; /* Cambiar a rojo (#FF0000) */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);
        }

        .navbar-dark .navbar-brand {
            color: #ffffff;
            font-size: 1em;
            transition: color 0.3s ease;
        }

        .navbar-dark .navbar-brand:hover {
            color: #ffffff;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-size: 16px;
            margin-right: 10px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff;
            opacity: 0.8;
        }

        .dropdown-menu {
            background-color: #FF0000; /* Cambiar a rojo (#FF0000) */
        }

        .dropdown-item {
            color: #ffffff;
        }

        .dropdown-item:hover {
            background-color: #b30000; /* Cambiar a un tono más oscuro de rojo (#b30000) */
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.3s ease; /* Añade transición al efecto de escala */
        }

        .card:hover {
            transform: scale(1.03); /* Efecto de escala al pasar el ratón */
        }

        .card-title {
            font-size: 18px;
            color: #000; /* Cambia el color del título a negro */
        }

        .card-text {
            font-size: 14px;
            color: #000; /* Cambia el color del texto a negro */
        }

        .btn-primary,
        .btn-danger {
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #b30000; /* Cambiar a un tono más oscuro de rojo (#b30000) */
            border-color: #b30000;
        }

        .btn-danger:hover {
            background-color: #990000; /* Cambiar a un tono aún más oscuro de rojo (#990000) */
            border-color: #990000;
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
                    <a class="nav-link" href="productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Metodospagos/metodos_pago.php">Métodos de Pago</a>
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
    include('../base_datos.php');

    $sql = "SELECT producto_id, Nombre, Precio, Descripcion, stock, imagen FROM productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container mt-5">';
        echo '<div class="row">';
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4">';
            echo '<div class="card" style="width: 18rem;">';
            echo '<img src="../admin/' . $row["imagen"] . '" class="card-img-top" alt="Imagen del producto">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row["Nombre"] . '</h5>';
            echo '<p class="card-text">' . $row["Descripcion"] . '</p>';
            echo '<p class="card-text">Precio: ' . $row["Precio"] . '</p>';
            echo '<p class="card-text">Stock: ' . $row["stock"] . '</p>';
            echo '<a href="editar_producto.php?id=' . $row["producto_id"] . '" class="btn btn-primary">Editar</a>';
            echo '<a href="#" class="btn btn-danger" onclick="confirmarEliminar(' . $row["producto_id"] . ')">Eliminar</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo "0 resultados";
    }

    $conn->close();
    ?>

    <script>
        function confirmarEliminar(producto_id) {
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar este producto?");
            if (confirmacion) {
                window.location.href = "eliminar_producto.php?id=" + producto_id;
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>


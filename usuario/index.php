<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tienda - Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #34e89e, #0f3443);
            color: #fff;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #000000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.8); /* Agrega sombra */
        }

        .navbar-brand {
            font-size: 1.5em;
            color: #fff;
            transition: color 0.2s ease; /* Agrega transición al color del texto */
        }

        .navbar-brand:hover {
            color: #fff; /* Cambia el color del texto al pasar el ratón */
        }

        .navbar-nav .nav-link {
            color: #fff;
            font-size: 16px;
            margin-right: 10px;
            transition: color 0.3s ease; /* Agrega transición al color del texto */
        }

        .navbar-nav .nav-link:hover {
            color: #fff;
            opacity: 0.8; /* Añade una ligera transparencia al pasar el ratón */
        }

        .navbar-nav .active {
            background-color: #0056b3; /* Cambia el fondo del enlace activo */
        }

        .user-name {
            font-size: 30px;
            color: #FFFFFF;
            background-color: #007BFF;
            padding: 6px;
            border-radius: 4px;
        }

        .dropdown-menu {
            background-color: #007BFF;
        }

        .dropdown-item {
            color: #ffffff;
        }

        .dropdown-item:hover {
            background-color: #0056b3;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
        }

        .card-text {
            font-size: 14px;
            color: #000;
        }

        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
            transition: background-color 0.3s ease, border-color 0.3s ease; /* Agrega transición al fondo y borde del botón */
        }

        .btn-primary:hover {
            background-color: #004080;
            border-color: #004080;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <span style="font-size: 2em;">Tienda</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="mi_carrito.php">Mi Carrito</a>
                </li>
                <li class="nav-item dropdown">
                    <!-- ... (código del dropdown) ... -->
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle user-name" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    <div class="container mt-3">
        <div class="row">
            <?php
            include('../base_datos.php');

            $sql = "SELECT producto_id, Nombre, Precio, Descripcion, stock, imagen FROM productos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-2">';
                    echo '<div class="card" style="width: 18rem;">';
                    echo '<img src="../admin/' . $row["imagen"] . '" class="card-img-top" alt="Imagen del producto">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["Nombre"] . '</h5>';
                    echo '<p class="card-text">' . $row["Descripcion"] . '</p>';
                    echo '<p class="card-text">Precio: ' . $row["Precio"] . '</p>';
                    echo '<p class="card-text">Stock: ' . $row["stock"] . '</p>';
                    echo '<a href="#" class="btn btn-primary" onclick="agregarAlCarrito(' . $row['producto_id'] . ');">Añadir al carrito</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "0 resultados";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function agregarAlCarrito(producto_id) {
            // Realiza una petición POST para agregar el producto al carrito
            fetch('agregar_al_carrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'producto_id=' + producto_id,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('El producto fue añadido al carrito.');
                        // Actualiza el stock en la vista actual (opcional)
                        const stockElement = document.getElementById('stock-' + producto_id);
                        if (stockElement) {
                            stockElement.textContent = 'Stock: ' + data.stock;
                        }
                    } else {
                        alert('Error al añadir el producto al carrito.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

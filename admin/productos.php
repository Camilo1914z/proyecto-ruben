<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tienda - Administrador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #34e89e, #0f3443);
            color: #000;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #FF0000; /* Cambiar a rojo (#FF0000) */
        }

        .navbar-dark .navbar-brand {
            color: #ffffff;
            font-size: 1em;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card-title {
            font-size: 24px;
            color: #000;
        }

        .card-text,
        .form-group label {
            font-size: 16px;
            color: #000;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid #555; /* Cambiado a un tono de gris más oscuro */
            color: #000;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .image-preview {
            margin-top: 10px;
        }

        #image-preview {
            max-width: 200px;
            max-height: 200px;
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Crear Nuevo Producto</h2>
                        <form action="procesar_producto.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen:</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                                <div class="image-preview mt-2">
                                    <img id="image-preview" src="#" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px;" />
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Crear Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('imagen').addEventListener('change', function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('image-preview').src = e.target.result;
            }

            reader.readAsDataURL(this.files[0]);
        });
    </script>

</body>

</html>

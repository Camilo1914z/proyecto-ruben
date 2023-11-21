<!DOCTYPE html>
<html lang="es">

<head>
    <title>Editar Producto - Administrador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #34e89e, #0f3443);
            color: #000;
            margin: 0;
            font-family: 'Arial', sans-serif;
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Editar Producto</h2>
                        <?php
                        include('../base_datos.php');
                        $producto_id = $_GET['id'];
                        $sql = "SELECT * FROM productos WHERE producto_id = $producto_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        ?>
                            <form action="procesar_edicion_producto.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="producto_id" value="<?php echo $row['producto_id']; ?>">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['Nombre']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo $row['Descripcion']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="precio">Precio:</label>
                                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" value="<?php echo $row['Precio']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock:</label>
                                    <input type="number" class="form-control" id="stock" name="stock" min="0" value="<?php echo $row['stock']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Nueva Imagen:</label>
                                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                                    <div class="image-preview mt-2">
                                        <img id="image-preview" src="<?php echo '../admin/' . $row["imagen"]; ?>" alt="Vista previa de la imagen">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                            </form>
                        <?php
                        } else {
                            echo "No se encontró el producto.";
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

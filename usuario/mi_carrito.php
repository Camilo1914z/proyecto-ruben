<!DOCTYPE html>
<html lang="es">

<head>
    <title>Mi Carrito - Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #34e89e, #0f3443);
            color: #fff;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border: 1px solid #d6d6d6;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .table th,
        .table td {
            color: #fff;
        }

        .table thead th {
            background-color: #007BFF;
            border-color: #007BFF;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004080;
            border-color: #004080;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #495057;
            border-color: #495057;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Mi Carrito</h2>

        <form action="procesar_compra.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../base_datos.php');
                    session_start();

                    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                        $total_precio = 0;

                        foreach ($_SESSION['carrito'] as $producto_id) {
                            $sql = "SELECT * FROM productos WHERE producto_id = $producto_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $precio = $row["Precio"];
                                $total_precio += $precio;

                                echo '<tr>';
                                echo '<td>';
                                echo '<div class="media">';
                                echo '<img src="../admin/' . $row["imagen"] . '" class="mr-3" alt="Imagen del producto" style="max-width: 80px;">';
                                echo '<div class="media-body">';
                                echo '<h5 class="mt-0">' . $row["Nombre"] . '</h5>';
                                echo '</div>';
                                echo '</div>';
                                echo '</td>';
                                echo '<td>$' . $precio . '</td>';
                                echo '<td>1</td>';
                                echo '<td>$' . $precio . '</td>';
                                echo '<td>';
                                echo '<button type="submit" name="eliminar" value="' . $producto_id . '" class="btn btn-danger">Eliminar</button>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }

                        echo '<tr>';
                        echo '<td colspan="3"></td>';
                        echo '<td>Total a Pagar: $' . $total_precio . '</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    } else {
                        echo '<tr><td colspan="5" class="text-center">No hay productos en el carrito</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <div class="text-right">
                <button type="submit" name="proceder_pago" class="btn btn-primary">Proceder al Pago</button>
                <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

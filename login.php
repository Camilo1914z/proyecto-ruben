<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #34e89e, #0f3443);
            color: #fff;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            padding: 20px;
            border: 1px solid #d6d6d6;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            font-size: 14px;
            color: #fff;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #fff;
            border-radius: 5px;
            background-color: transparent;
            color: #fff;
            margin-bottom: 15px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .form-container p {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }

        .form-container a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <form action="validar_login.php" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
            
            <label for="email" class="sr-only">Correo:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Correo" required autofocus>
            
            <label for="password" class="sr-only">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
            
            <p class="mt-4 mb-3"><a href="registro.php" style="color: #fff;">Registrarse</a></p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

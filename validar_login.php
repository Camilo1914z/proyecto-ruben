<?php
include('base_datos.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_user = "SELECT * FROM usuario WHERE email='$email'";
    $result = $conn->query($check_user);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['username'] = $row['username']; // Nuevo

            if ($row['rol'] == 'administrador') {
                header("Location: admin/index.php");
            } elseif ($row['rol'] == 'usuario') {
                header("Location: usuario/index.php");
            }
            exit();
        } else {
            $message = "Contraseña incorrecta. Intenta de nuevo.";
        }
    } else {
        $message = "Usuario no encontrado. Por favor, regístrate.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Validar Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Iniciar sesión</h2>
                        
                        <?php if ($message !== ""): ?>
                            <div class="alert <?php echo ($message === "Usuario no encontrado. Por favor, regístrate.") ? "alert-danger" : "alert-warning"; ?>" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="validar_login.php" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Correo" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
                        </form>
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

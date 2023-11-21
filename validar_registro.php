<?php
include('base_datos.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    $check_user = "SELECT * FROM usuario WHERE username='$username' OR email='$email'";
    $result = $conn->query($check_user);

    if ($result->num_rows > 0) {
        $message = "El usuario ya existe. Por favor, elige otro nombre de usuario o correo electrónico.";
    } else {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_user = "INSERT INTO usuario (username, password, email, rol) VALUES ('$username', '$hash_password', '$email', '$rol')";

        if ($conn->query($insert_user) === TRUE) {
            $message = "Registro exitoso";
        } else {
            $message = "Error en la inserción: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Validar Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Validar Registro</h2>
                        
                        <?php if ($message !== ""): ?>
                            <div class="alert <?php echo ($message === "Registro exitoso") ? "alert-success" : "alert-danger"; ?>" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="text-center mt-2">
                            <a href="login.php" class="btn btn-primary">Volver al Login</a>
                        </div>
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

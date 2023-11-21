<?php
session_start();
include 'base_datos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Verificar si el usuario ya existe
    $check_user = "SELECT * FROM usuarios WHERE username='$username'";
    $result = $conn->query($check_user);

    if ($result->num_rows == 0) {
        // Si el usuario no existe, lo registramos
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_user = "INSERT INTO usuarios (username, email, password, rol) VALUES ('$username', '$email', '$hashed_password', '$rol')";
        if ($conn->query($insert_user) === TRUE) {
            echo "Usuario registrado correctamente. <a href='login.php'>Iniciar sesión</a>";
        } else {
            echo "Error al registrar usuario: " . $conn->error;
        }
    } else {
        echo "El usuario ya existe. <a href='registro.php'>Volver</a>";
    }
} else {
    header("Location: registro.php"); // Redirige a la página de registro si se accede directamente a este script
}

$conn->close();
?>

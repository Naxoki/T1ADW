<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Incluir la configuración de la base de datos y el controlador de autenticación

// Asegúrate de que la ruta a database.php sea correcta
require_once '../../config/database.php';  // Correcta ruta relativa desde views/auth/
require_once '../../controllers/AuthController.php';  // Correcta ruta relativa desde views/auth/
require_once '../../models/User.php';  // Asegúrate de que el modelo User esté incluido


// Crear el controlador de autenticación
$authController = new AuthController($pdo);

// Llamar a la función de registro
$authController->register();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form method="POST" action="register.php">
        <label for="name">Nombre:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Registrar</button>
    </form>

    <?php
    // Si hay un error, lo mostramos aquí
    if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
</body>
</html>

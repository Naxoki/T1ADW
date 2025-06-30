<?php
// Iniciar la sesión
session_start();



// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, redirigir al login
    header("Location: login.php");
    exit;
}

// Si está logueado, mostrar el dashboard

echo "Verificando permisos de administrador...<br>";
echo 'User ID: ' . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'No user ID') . '<br>';
echo 'Role: ' . (isset($_SESSION['role']) ? $_SESSION['role'] : 'No role') . '<br>';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p>Este es tu panel de Admin.</p>

    <h2>Opciones</h2>
    <ul>
        <li><a href="/TD1ADW/views/products/list.php">Ver Productos</a></li>
        <li><a href="/TD1ADW/views/products/add.php">Agregar Producto</a></li>
        
    </ul>

    <a href="/TD1ADW/public/logout.php">Cerrar sesión</a>
</body>
</html>

<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: /TD1ADW/views/auth/login.php");
    exit;
}

// Verificar si se pasó un ID de producto
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Incluir el controlador de productos y la base de datos
    require_once '../../controllers/ProductController.php';
    require_once '../../config/database.php';

    // Crear el controlador de productos
    $productController = new ProductController($pdo);

    // Eliminar el producto del carrito
    $user_id = $_SESSION['user_id'];
    $productController->removeFromCart($user_id, $product_id);
}

// Redirigir al carrito después de eliminar el producto
if (isset($_GET['front']) && $_GET['front'] == 'true') {
    header("Location: /TD1ADW/carrito.php");
} else {
    header("Location: /TD1ADW/views/products/cart.php");
}
exit;


?>

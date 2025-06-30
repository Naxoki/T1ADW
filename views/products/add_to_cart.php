<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: /TD1ADW/views/auth/login.php");
    exit;
}

// Verificar si se ha pasado el ID del producto
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];  // Obtener el ID del usuario logueado
    $quantity = 1; // Cantidad predeterminada al agregar un producto al carrito

    // Incluir el controlador de productos y la base de datos
    require_once '../../controllers/ProductController.php';
    require_once '../../config/database.php';

    // Crear el controlador de productos
    $productController = new ProductController($pdo);

    // Llamar al método para agregar el producto al carrito
    $productController->addToCart($user_id, $product_id, $quantity);
    
    // Redirigir al carrito de compras
    header("Location: /TD1ADW/views/products/cart.php");
    exit;
} else {
    // Si no se pasa un ID de producto, redirigir al listado de productos
    header("Location: /TD1ADW/views/products/products.php");
    exit;
}
?>

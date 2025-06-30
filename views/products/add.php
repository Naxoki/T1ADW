<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Iniciar sesión para asegurarnos de que el administrador esté autenticado
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /TD1ADW/views/auth/login.php");
    exit;
}
// Incluir la configuración de la base de datos 
require_once '../../controllers/ProductController.php';

// Crear el controlador de productos
$productController = new ProductController();

// Llamar a la función de agregar producto
$productController->add();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
</head>
<body>
    <h2>Agregar Nuevo Producto</h2>
    
    <!-- Formulario para agregar producto -->
    <form method="POST" action="add.php">
        <label for="name">Nombre del Producto:</label>
        <input type="text" name="name" required><br><br>        

        <label for="description">Descripción:</label>
        <textarea name="description" required></textarea><br><br>

        <label for="brand">Marca:</label>       
        <select name="brand" required>
            <option value="">Seleccione un tipo</option>
            <option value="Samsung">Samsung</option>
            <option value="Asus">Asus</option>     
            <option value="Apple">Apple</option>
            <option value="Xiaomi">Xiaomi</option>
            <option value="Motorola">Motorola</option>
            <option value="Huawei">Huawei</option>
            <option value="LG">LG</option>
            <option value="Sony">Sony</option>
            <option value="Lenovo">Lenovo</option>
            <option value="Dell">Dell</option>
            <option value="HP">HP</option>
            <option value="Acer">Acer</option>                   
        </select>

        <label for="category">Categoría:</label>
        <select type="text" name="category" required>
            <option value="">Seleccione una categoría</option>
            <option value="Celulares">Celulares</option>
            <option value="Tablets">Tablets</option>
            <option value="Laptops">Laptops</option>
            <option value="Smartwatches">Smartwatches</option>
            <option value="Accesorios">Accesorios</option>
            <option value="Electrodomésticos">Electrodomésticos</option>
            <option value="Audio">Audio</option>
        </select>

        <label for="price">Precio:</label>
        <input type="number" name="price" step="0.01" required><br><br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" required><br><br>

        <label for="image_url">Imagen (URL):</label>
        <input type="text" name="image_url" required><br><br>

        <button type="submit">Agregar Producto</button>
    </form>

    <!-- Enlace para regresar a la lista de productos -->
    <br><br>
    <a href="list.php">Regresar a la lista de productos</a>
</body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Iniciar sesión para asegurarnos de que el administrador esté autenticado
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /TD1ADW/views/auth/login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

// Incluir la configuración de la base de datos  
require_once '../../controllers/ProductController.php';

// Crear el controlador de productos
$productController = new ProductController();

$arraycategorias = $productController->categories;

$arraymarcas = $productController->brands;

// Obtener el producto para editarlo
    $product = $productController->getProductById($id);
} else {
    // Si no se pasa un ID de producto, redirigir al listado
    header("Location: /TD1ADW/views/products/list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto <?php echo $_GET['id']; ?></title>
</head>
<body>
    <h2>Editar Producto <?php echo $_GET['id']; ?></h2>

    <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])): ?>

        <?php 
    
        //var_dump($_POST); 

        // Guardar en BD
        $productController->update();


        
        ?>    
    <?php else: ?>
    <!-- Formulario para editar el producto -->
    <form method="POST" action="edit.php?id=<?php echo $product['id']; ?>" >
        <label for="name">Nombre del Producto:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>
             
        <label for="brand">Marca:</label>       
        <select name="brand" required>
            <option value="">Seleccione un tipo</option>
            <?php foreach ($arraymarcas as $marca): ?>
                <option value="<?php echo $marca; ?>" <?php echo $product['brand'] == $marca ? "selected" : ""; ?>><?php echo $marca; ?></option>
            <?php endforeach; ?>                
        </select><br>

        
        <label for="category">Categoría:</label>
        <select type="text" name="category" required> 
            <option value="">Seleccione una categoría</option>
            <?php foreach ($arraycategorias as $categoria): ?>
                <option value="<?php echo $categoria; ?>" <?php echo $product['category'] == $categoria ? "selected" : ""; ?>><?php echo $categoria; ?></option>
             <?php endforeach; ?>  
        </select><br><br>      

        <label for="description">Descripción:</label>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br><br>

        <label for="price">Precio:</label>
        <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required><br><br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required><br><br>

        <label for="image_url">Imagen (URL):</label>
        <input type="text" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>"><br><br>

        <button type="submit">Actualizar Producto</button>
    </form>
    <a href="list.php">Regresar a la lista de productos</a>
    <?php endif; ?>

</body>
</html>
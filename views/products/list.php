<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión para asegurarnos de que el administrador esté autenticado
session_start();

// Verificar si el usuario es administrador (esto solo debería ser accesible para administradores)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /TD1ADW/views/auth/login.php");
    exit;
}

// Incluir el controlador de productos
require_once '../../controllers/ProductController.php';


$productController = new ProductController();
$products = $productController->list(); // Obtener la lista de productos

//elimiar producto
if (isset($_GET['delete'])) {
   if ($_GET['delete']== 'ok') {
        echo "<h4>producto eliminado correctamente.</h4>";    
    }
    else{
        $productController->delete($_GET['delete']);
    }
}   
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
</head>
<body>
    <h2>Lista de Productos</h2>
    
    <!-- Enlace para agregar un nuevo producto -->
    <a href="add.php">Agregar Nuevo Producto</a><br><br>

    <!-- Tabla para mostrar los productos -->
    <table border="1">
        <tr>
            <th>Nombre</th>            
            <th>Descripción</th>
            <th>Marca</th>
            <th>Categoria</th>            
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Verificar si hay productos y listarlos
        if (isset($products) && count($products) > 0):
            foreach ($products as $product):
        ?>
            <tr>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
                <td><?php echo htmlspecialchars($product['brand']); ?></td>
                <td><?php echo htmlspecialchars($product['category']); ?></td>
                <td><?php echo number_format($product['price'], 2); ?> $</td>
                <td><?php echo $product['stock']; ?></td>
                <td><img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="Imagen de producto" width="100"></td>
                <td>
                    <a href="edit.php?id=<?php echo $product['id']; ?>">Editar</a> |
                    <a href="list.php?delete=<?php echo $product['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php
            endforeach;
        else:
        ?>
            <tr>
                <td colspan="6">No hay productos disponibles.</td>
            </tr>
        <?php endif; ?>
    </table>

</body>
</html>

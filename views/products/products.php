<?php
session_start();

// Incluir el controlador de productos
require_once '../../controllers/ProductController.php';
require_once '../../config/database.php';

$productController = new ProductController();
$products = $productController->list(); // Obtener la lista de productos


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
    
    <!-- Enlace para agregar un nuevo producto (solo visible para administradores) -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="add.php">Agregar Nuevo Producto</a><br><br>
    <?php endif; ?>

    <!-- Tabla para mostrar los productos -->
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
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
                <td><?php echo number_format($product['price'], 2); ?> $</td>
                <td><?php echo $product['stock']; ?></td>
                <td><img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="Imagen de producto" width="100"></td>
                <td>
                    <!-- Enlace para agregar al carrito (visible para todos los usuarios) -->
                    <a href="add_to_cart.php?id=<?php echo $product['id']; ?>">Agregar al Carrito</a>
                    <!-- Acciones solo para administradores -->
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        | <a href="edit.php?id=<?php echo $product['id']; ?>">Editar</a> |
                        <a href="delete.php?id=<?php echo $product['id']; ?>">Eliminar</a>
                    <?php endif; ?>
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

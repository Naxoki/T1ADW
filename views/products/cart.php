<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: /TD1ADW/views/auth/login.php");
    exit;
}

// Incluir el controlador de productos y la base de datos
require_once '../../controllers/ProductController.php';
require_once '../../config/database.php';

// Crear el controlador de productos
$productController = new ProductController($pdo);

// Obtener los productos del carrito
$user_id = $_SESSION['user_id'];
$cart = $productController->getCart($user_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>
<body>
    <h2>Carrito de Compras</h2>

    <?php if (count($cart) > 0): ?>
        <table border="1">
            <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            <?php
            $total = 0;
            foreach ($cart as $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo htmlspecialchars($item['description']); ?></td>
                <td><?php echo number_format($item['price'], 2); ?> $</td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo number_format($subtotal, 2); ?> $</td>
                <td>
                    <a href="remove_from_cart.php?product_id=<?php echo $item['id']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <h3>Total: <?php echo number_format($total, 2); ?> $</h3>
    <?php else: ?>
        <p>Tu carrito está vacío.</p>
    <?php endif; ?>

    <a href="checkout.php">Proceder al pago</a>
</body>
</html>

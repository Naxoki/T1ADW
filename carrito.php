<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: /TD1ADW/views/auth/login.php");
    exit;
}

// Incluir el controlador de productos y la base de datos
require_once 'controllers/ProductController.php';
require_once 'config/database.php';

// Crear el controlador de productos
$productController = new ProductController();

// Obtener los productos del carrito
$user_id = $_SESSION['user_id'];
$cart = $productController->getCart($user_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carrito | TecStore</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css"/>
</head>
<body>
  <header class="navbar">
  <div class="logo">TecStore</div>
  <nav>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="productos.php">Productos</a></li>
      <li><a href="carrito.php">Carrito</a></li>
      <li><a href="#">Perfil</a></li>
    </ul>
  </nav>
  <div class="nav-right">
    <input type="text" placeholder="¿Qué estás buscando?" />
    <?php if (isset($_SESSION['user_id'])): ?>
          <!-- Si el usuario está logueado -->
          <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
          <a href="views/auth/logout.php" class="user-icon" title="Cerrar sesión">👤</a>
          <?php else: ?>
          <!-- Si el usuario no está logueado -->
          <a href="views/auth/login.php" class="user-icon" title="Iniciar sesión">👤</a>
        <?php endif; ?>
    <a href="carrito.php" class="cart-icon" title="Carrito">🛒</a>
  </div>
</header>

  <main class="carrito-compra">
    <section class="detalle-carrito">
      <h2>Carrito de compra</h2>
      <?php if (count($cart) > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Productos</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $total = 0;
            foreach ($cart as $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
          ?>
          <tr>
            <td><img src="<?php echo $item['image_url']; ?>"><div><p><?php echo $item['name']; ?></p><a href="views/products/remove_from_cart.php?product_id=<?php echo $item['id']; ?>&front=true">Remover</a></div></td>
   
            <td><button>-</button><?php echo $item['quantity']; ?><button>+</button></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $subtotal; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
      <p>Tu carrito está vacío.</p>
      <?php endif; ?>
    </section>

    <aside class="resumen">
      <h3>Resumen de compra</h3>
      <form>
        <label><input type="radio" name="envio" checked> Retiro en tienda — $0</label><br>
        <label><input type="radio" name="envio"> Retiro Chilexpress — $2.500</label><br>
        <label><input type="radio" name="envio"> Envío a domicilio — $3.500</label><br>
      </form>
      <p>Subtotal: <strong>$1.039.970</strong></p>
      <p>Total: <strong>$1.039.970</strong></p>
      <button class="pagar">Pagar</button>
    </aside>
  </main>
</body>
</html>

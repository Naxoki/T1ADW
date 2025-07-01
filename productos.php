<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Incluir el controlador de productos
require_once 'controllers/AuthController.php';
require_once 'controllers/ProductController.php';
require_once 'config/database.php';

  // Instanciar el controlador y obtener datos
  $productController = new ProductController();
  $allProducts      = $productController->list();
  $arraycategorias  = $productController->categories;
  $arraymarcas      = $productController->brands;

  // Leer filtros desde la URL
  $cats = $_GET['categoria'] ?? [];
  $brs  = $_GET['marca']    ?? [];
  $maxP = isset($_GET['max_price']) ? (int) $_GET['max_price'] : null;

  // Aplicar filtrado: OR dentro de cada dimensión, AND entre dimensiones
  $typo_avoider = function($p) use ($cats, $brs, $maxP) {
      $matchCat   = empty($cats)           || in_array($p['category'], $cats);
      $matchBrand = empty($brs)            || in_array($p['brand'],    $brs);
      $matchPrice = is_null($maxP)         || ((int) $p['price'] <= $maxP);
      return $matchCat && $matchBrand && $matchPrice;
  };

$products = array_filter($allProducts, $typo_avoider);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Productos | TecStore</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css"/>
</head>
<body>
  <header class="navbar">
    <div class="logo">TecStore</div>
    <nav>
      <ul>
        <li><a href="index.php">Inicio</a></li>
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

  <section class="accesos-rapidos">
    <div class="categorias-grid">
      <div class="categoria"><img src="assets/img/NOTEBOOK 1.jpg" alt="Laptops"><p>Laptops</p></div>
      <div class="categoria"><img src="assets/img/monitor2.jpg" alt="Monitores"><p>Monitores</p></div>
      <div class="categoria"><img src="assets/img/teclado2.jpg" alt="Teclados"><p>Teclados</p></div>
      <div class="categoria"><img src="assets/img/mouse2.jpg" alt="Mouses"><p>Mouses</p></div>
      <div class="categoria"><img src="assets/img/audifonos2.jpg" alt="Audífonos"><p>Audífonos</p></div>
    </div>
  </section>

  <main class="filtros-productos">
    <form class="filtros" method="GET" action="">
      <h2>Filtrar por</h2>
      <div>
        <h3>Categorías</h3>
        <?php foreach ($arraycategorias as $categoria): ?>
          <label>
            <input
              type="checkbox"
              name="categoria[]"
              value="<?= htmlspecialchars($categoria) ?>"
              <?= (!empty($_GET['categoria']) && in_array($categoria, $_GET['categoria'])) ? 'checked' : '' ?>
            >
            <?= $categoria ?>
          </label><br>
        <?php endforeach; ?>
      </div>

      <div>
        <h3>Precio Máximo</h3>
        <?php 
          $maxPrice = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 2500000;
        ?>
        <input
          type="range"
          name="max_price"
          min="10000"
          max="2500000"
          step="10000"
          value="<?= $maxPrice ?>"
          oninput="this.nextElementSibling.innerText = this.value"
        >
        <span><?= number_format($maxPrice, 0, ',', '.') ?></span>
      </div>

      <div>
        <h3>Marcas</h3>
        <?php foreach ($arraymarcas as $marca): ?>
          <label>
            <input
              type="checkbox"
              name="marca[]"
              value="<?= htmlspecialchars($marca) ?>"
              <?= (!empty($_GET['marca']) && in_array($marca, $_GET['marca'])) ? 'checked' : '' ?>
            >
            <?= $marca ?>
          </label><br>
        <?php endforeach; ?>
      </div>
      <div class="botones-filtro">
        <button type="submit">Aplicar filtro</button>
        <button type="button" onclick="window.location='productos.php'">Quitar filtros</button>
      </div>
    </form>


    <section class="resultados">
      <h2>Resultados</h2>
      <!-- Enlace para agregar un nuevo producto (solo visible para administradores) -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="add.php">Agregar Nuevo Producto</a><br><br>
        <?php endif; ?>

        
        <!-- Tabla para mostrar los productos -->
        <div class="grid">
          <?php
          // Verificar si hay productos y listarlos
          if (isset($products) && count($products) > 0):
             foreach ($products as $product):
          ?>
          <div class="producto">
            <img src="<?php echo $product['image_url']; ?>">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['price']; ?></p>
            <a href="views/products/add_to_cart.php?id=<?php echo $product['id']; ?>&front=true">Agregar al Carrito</a>
          </div>
          <?php
              endforeach;
          else:
          ?>         
            <h4>No hay productos disponibles.</h4>            
          <?php endif; ?>
      </div>
    </section>
  </main>
</body>
</html>

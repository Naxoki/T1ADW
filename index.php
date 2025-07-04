
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TecStore | Inicio</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
  <header class="navbar">
  <div class="logo">TecStore</div>
  <nav>
    <ul>      
      <li><a href="productos.php">Productos</a></li>
      <li><a href="#">Perfil</a></li>
    </ul>
  </nav>
  <div class="nav-right">
    <form action="productos.php" method="get" >     
       <input type="text" placeholder="Que estás buscando?"/>
    </form>
       <a href="views/auth/login.php" class="user-icon" title="Iniciar sesión">👤 </a>
    <a href="carrito.php" class="cart-icon" title="Ver carrito">
      🛒
    </a>
  </div>
</header>
     </header>

  <section class="cyber-banner">
    <h1>🔥 ¡CyberDay TecStore!</h1>
    <p>Aprovecha descuentos increíbles en computación. Solo por tiempo limitado.</p>
    <a href="productos.php" class="btn-banner">Ver productos</a>
  </section>
  <section class="accesos-rapidos">
  <h2>Accesos rápidos</h2>
  <div class="categorias-grid">
    <div class="categoria">
      <img src="assets/img/NOTEBOOK 1.jpg" alt="Laptops">
      <p>Notebooks</p>
    </div>
    <div class="categoria">
      <img src="assets/img/monitor2.jpg" alt="Monitores">
      <p>Monitores</p>
    </div>
    <div class="categoria">
      <img src="assets/img/teclado2.jpg" alt="Teclados">
      <p>Teclados</p>
    </div>
    <div class="categoria">
      <img src="assets/img/mouse2.jpg" alt="Mouses">
      <p>Mouse</p>
    </div>
    <div class="categoria">
      <img src="assets/img/audifonos2.jpg" alt="Audífonos">
      <p>Audífonos</p>
    </div>
  </div>
</section>

</body>

</html>

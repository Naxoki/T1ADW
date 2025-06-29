
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
      <li><a href="productos.html">Productos</a></li>
      <li><a href="carrito.php">Carrito</a></li>
      <li><a href="#">Perfil</a></li>
    </ul>
  </nav>
  <div class="nav-right">
    <input type="text" placeholder="¿Qué estás buscando?" />
    <a href="login.php" class="user-icon" title="Iniciar sesión">👤</a>
    <a href="carrito.php" class="cart-icon" title="Carrito">🛒</a>
  </div>
</header>

  <main class="carrito-compra">
    <section class="detalle-carrito">
      <h2>Carrito de compra</h2>
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
          <tr>
            <td><img src="assets/img/laptop.jpg" alt="Laptop"><div><p>Laptop ASUS Zenbook</p><a href="#">Remover</a></div></td>
            <td><button>-</button> 1 <button>+</button></td>
            <td>$899.990</td>
            <td>$899.990</td>
          </tr>
          <tr>
            <td><img src="assets/img/mouse.jpg" alt="Mouse"><div><p>Mouse Logitech G305</p><a href="#">Remover</a></div></td>
            <td><button>-</button> 1 <button>+</button></td>
            <td>$49.990</td>
            <td>$49.980</td>
          </tr>
          <tr>
            <td><img src="assets/img/audifonos.jpeg" alt="audifonos"><div><p>Mouse Logitech G305</p><a href="#">Remover</a></div></td>
            <td><button>-</button> 1 <button>+</button></td>
            <td>$89.990</td>
            <td>$89.990</td>
          </tr>
        </tbody>
      </table>
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

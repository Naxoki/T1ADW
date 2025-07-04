<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página de Login</title>
  <!-- Aquí van los archivos CSS -->
  <link rel="stylesheet" href="assets/css/styles.css">
  
</head>
<body>
  <div class="login-page">
    <div class="logo">   
        <img src="assets/img/logo.png" alt="Logo EGStore" width="150">
    </div>

    <div class="form">
      <form class="register-form" action="index.php" method="get">
        <input type="text" placeholder="name" />
        <input type="password" placeholder="password" />
        <input type="text" placeholder="email address" />
        <button type="submit">create</button>
        <p class="message">Already registered? <a href="#">Sign In</a></p>
      </form>
      <form class="login-form" action="index.php" method="get">
        <input type="text" placeholder="username" />
        <input type="password" placeholder="password" />
        <button type="submit">login</button>
        <p class="message">Not registered? <a href="#">Create an account</a></p>
      </form>
    </div>
  </div>

  <!-- Aquí van los archivos JS, normalmente al final del body -->
  <script src="assets/js/admin.js"></script>
 
</body>
</html>

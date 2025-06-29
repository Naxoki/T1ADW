<?php
// config/database.php
// Este archivo configura la conexión a la base de datos utilizando PDO.


// Configuración de la base de datos
$host = 'localhost';  // Cambia esto si tu servidor de base de datos está en otro lugar
$dbname = 'tecstore_db';  // El nombre de la base de datos
$username = 'root';  // Cambia esto por tu nombre de usuario de MySQL
$password = 'root';  // Cambia esto por tu contraseña de MySQL

// Configurar la conexión
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establecer el modo de errores de PDO a excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Establecer el charset a UTF-8
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Si hay un error en la conexión, muestra el mensaje de error
    die("Error de conexión: " . $e->getMessage());
}

?>

<?php
// Incluir la configuración de la base de datos
require_once 'config/database.php';

try {
    // Probar la conexión
    $pdo->query('SELECT 1'); // Intentamos ejecutar una consulta simple para verificar la conexión
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // Si hay un error, lo mostramos
    echo "Error de conexión: " . $e->getMessage();
}
?>

<?php
// Archivo: backend/test_connection.php

require_once '../config/global.php'; // Asegúrate de que la ruta es correcta

$database = new Database();             // Instancia la clase de conexión
$conn = $database->getConnection();       // Intenta conectarse a la base de datos

if ($conn) {
    echo "bien perrito";
} else {
    echo "mal, revisa la wea ql";
}
?>

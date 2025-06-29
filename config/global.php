<?php
/*
 * Global
 * ------
 * Archivo: backend/config/global.php
 * Este archivo contiene configuraciones globales
 * 
 */

// Obtener datos de configuración
try {
	// Crear archivo plantilla si no existe
	if (!file_exists(__DIR__ .'/config.php')) {
        copy(__DIR__ .'/.config', __DIR__ .'/config.php');
	}
	// Obtener variable de configuracion
	require_once('config.php');
	// Comprobar si no vienen los datos esenciales vacios
	if (empty($config['host']) || empty($config['db_name']) || empty($config['username'])) {
		throw new Exception('Debe indicar los datos conexión en el archivo config.php');
	}
} catch (Exception $e) {
	// Mostrar errores
	echo $e->getMessage();
	die();
}

// clase para manejar la conexión a la base de datos MySQL usando PDO.
class Database {
    // Parámetros de conexión a la base de datos
    private $host; // Dirección del servidor MySQL
    private $db_name; // Nombre de la base de datos
    private $username; // Usuario de la base de datos
    private $password; // Contraseña de la base de datos
    public $conn; // Propiedad que almacenará la conexión establecida

    public function __construct() {
        global $config;
        $this->host = $config['host'];
        $this->db_name = $config['db_name'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    // Función para obtener la conexión a la base de datos
    public function getConnection() {
        $this->conn = null; // Inicializamos la conexión en null

        try {
            // Se crea una nueva instancia de PDO con los parámetros definidos:
            // - "mysql:host=..." indica el servidor y base de datos a conectar
            // - $this->username y $this->password se utilizan para la autenticación
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, 
                                  $this->password);
            // Configuramos PDO para que lance excepciones en caso de error
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Habilitar utf8mb4 para emojis y otros (igual que la bd)
            $this->conn->exec("set names utf8mb4");
        } catch(PDOException $exception) {
            // Si ocurre un error, se imprime el mensaje y se detiene la ejecución
            echo "Connection error: " . $exception->getMessage();
            exit;
        }
        // Se retorna la conexión establecida
        return $this->conn;
    }
}
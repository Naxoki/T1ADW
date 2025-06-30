<?php

class User {
    private $pdo;

    // Constructor que recibe la conexión PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Función para registrar un nuevo usuario
    public function register($name, $email, $password) {
        // Verificar si el correo ya está registrado
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            throw new Exception("El correo ya está registrado.");
        }

        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, 'customer')");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }

    // Función para hacer login de un usuario
    public function login($email, $password) {
        // Buscar el usuario por correo electrónico
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user) {
            throw new Exception("Usuario no encontrado.");
        }

        // Verificar si la contraseña coincide
        if (!password_verify($password, $user['password'])) {
            throw new Exception("Contraseña incorrecta.");
        }

        return $user; // Devuelve el usuario si el login es exitoso
    }

    // Función para obtener un usuario por su ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Función para verificar si un usuario es administrador
    public function isAdmin($userId) {
        $stmt = $this->pdo->prepare("SELECT role FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch();

        return $user['role'] === 'admin'; // Devuelve true si es administrador
    }
}
?>


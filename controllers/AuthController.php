<?php

require_once '../../models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Función para manejar el registro de usuario
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            try {
                $this->userModel->register($name, $email, $password);
                echo "Registro exitoso. Ahora puedes iniciar sesión.";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    // Función para manejar el login de usuario
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            try {
                $user = $this->userModel->login($email, $password);
                echo "Bienvenido, " . $user['name'];
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}
?>

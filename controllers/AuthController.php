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
                // Verificar las credenciales
                $user = $this->userModel->login($email, $password);

                // Iniciar sesión y almacenar el ID, nombre y rol del usuario en la sesión
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['role'] = $user['role']; // Asignar el rol a la sesión

                // Redirigir al dashboard
                header("Location: /TD1ADW/views/dashboard.php");
                exit; // Asegurarse de detener la ejecución del script después de redirigir
            } catch (Exception $e) {
                // Si hay un error, mostrarlo
                $error_message = $e->getMessage();
                echo "<p style='color:red;'>$error_message</p>";
            }
        }
    }
}
?>

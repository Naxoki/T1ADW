<?php
require_once '../../models/Product.php';

class ProductController {
    private $productModel;
   


    public function __construct() { 
        global $pdo;    
        $this->productModel = new Product($pdo);
    }

    // Función para listar todos los productos
    public function list() {
        // Obtener todos los productos desde el modelo
        $products = $this->productModel->getAll();   
        // Pasar la variable $products a la vista list.php
        return $products;
        
       
    }

    // Función para agregar un producto
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $image_url = $_POST['image_url'];

            try {
                $this->productModel->add($name, $description, $price, $stock, $image_url);
                header("Location: /TD1ADW/views/products/list.php");  // Redirigir a la lista de productos
                exit;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    // Función para obtener un producto por su ID
    public function getProductById($id) {
        return $this->productModel->getById($id);
    }

    // Función para actualizar un producto
    public function update() {     

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {

            if ( empty($_POST['name']) || 
                empty($_POST['description']) ||
                empty($_POST['price']) ||
                empty($_POST['stock']) ||
                empty($_POST['image_url']) ){

                echo "<h4>Alguno de los campos estan vacios, intentelo nuevamente</h4>";
                echo '<a onclick="window.history.back()">&laquo; Volver</a>'; 
                return;
            }
            $id = $_GET['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $image_url = $_POST['image_url'];

            try {
                $this->productModel->update($id, $name, $description, $price, $stock, $image_url);
                //header("Location: /TD1ADW/views/products/list.php");  // Redirigir a la lista de productos
                echo "<h4>Datos guardados correctamente!</h4>";  
                echo '<a href="edit.php?id='.$_GET['id'].'">&laquo; Volver</a>';              
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }


    // Función para eliminar un producto
    public function delete($id) {
        if (empty($id)) {
            echo "<h4>ID de producto no proporcionado.</h4>";
            return;
        }
        
        try {
            $this->productModel->delete($id);
            header("Location: /TD1ADW/views/products/list.php?delete=ok");  // Redirigir a la lista de productos
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private $productModel;
    private $pdo;
    public $categories;
    public $brands;
   


    public function __construct() { 
        global $pdo;    
        $this->pdo = $pdo;
        $this->productModel = new Product($pdo);

        $this->categories = [
            "Celulares",
            "Tablets",
            "Laptops",
            "Smartwatches",
            "Accesorios",
            "Electrodomésticos",
            "Audio",
            "Monitores",
            "Impresoras",
            "Periféricos",
        ];

        $this->brands = [
            'Samsung',
            'Asus',
            'Apple',
            'Xiaomi',
            'Motorola',
            'Huawei',
            'LG',
            'Sony',
            'Lenovo',
            'Dell',
            'HP',
            'Acer',
            'Logitech'
        ];
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
            $brand = $_POST['brand'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $image_url = $_POST['image_url'];

            try {
                $this->productModel->add($name, $description, $brand, $category, $price, $stock, $image_url);
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
                empty($_POST['brand']) ||
                empty($_POST['category']) ||
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
            $brand = $_POST['brand'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $image_url = $_POST['image_url'];

            try {
                $this->productModel->update($id, $name, $description,  $brand, $category, $price, $stock, $image_url);
                //header("Location: /TD1ADW/views/products/list.php");  // Redirigir a la lista de productos
                echo "<h4>Datos guardados correctamente!</h4>";  
                echo '<a href="list.php">&laquo; Volver a la lista</a>';             
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
    // Agregar producto al carrito
    public function addToCart($user_id, $product_id, $quantity) {
        $stmt = $this->pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ]);
    }

    // Obtener los productos en el carrito de compras
    public function getCart($user_id) {
        $stmt = $this->pdo->prepare("SELECT products.*, cart.quantity FROM cart
                                    INNER JOIN products ON cart.product_id = products.id
                                    WHERE cart.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar producto del carrito
    public function removeFromCart($user_id, $product_id) {
        $stmt = $this->pdo->prepare("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);
    }






}
?>

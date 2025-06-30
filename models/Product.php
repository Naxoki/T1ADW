<?php
require_once __DIR__ .'/../config/database.php'; 


class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los productos
    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar un nuevo producto
    public function add($name, $description, $brand, $category, $price, $stock, $image_url) {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, description, brand, category, price, stock, image_url) VALUES (:name, :description, :brand, :category, :price, :stock, :image_url)");
        $stmt->execute([
            'name' => $name,
            'description' => $description,
            'brand' => $brand,
            'category' => $category,
            'price' => $price,
            'stock' => $stock,
            'image_url' => $image_url            
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve false si no encuentra
    }
    // Función para obtener un producto por su ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Función para actualizar un producto
    public function update($id, $name, $description, $brand, $category, $price, $stock, $image_url) {
        $stmt = $this->pdo->prepare("UPDATE products SET name = :name, description = :description, brand = :brand, category = :category, price = :price, stock = :stock, image_url = :image_url WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'brand' => $brand,
            'category' => $category,
            'price' => $price,
            'stock' => $stock,
            'image_url' => $image_url
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    // Eliminar un producto por ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve false si no encuentra
    }


    public function getAllBrands() {
    $stmt = $this->pdo->query("SELECT * FROM brands");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>

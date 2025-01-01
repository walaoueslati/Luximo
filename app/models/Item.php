<?php
require_once 'DataBase.php';

class Item {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addItem($name, $description, $price, $imagePath = null) {
        $stmt = $this->conn->prepare("INSERT INTO items (name, description, price, image_path) VALUES (:name, :description, :price, :image_path)");
        $stmt->execute([
            'name' => htmlspecialchars(trim($name)),
            'description' => htmlspecialchars(trim($description)),
            'price' => $price,
            'image_path' => $imagePath
        ]);
    }

    public function deleteItem($id) {
        $stmt = $this->conn->prepare("DELETE FROM items WHERE id = :id");
        $stmt->execute(['id' => intval($id)]);
    }
}
?>

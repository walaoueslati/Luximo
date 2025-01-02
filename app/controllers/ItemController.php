<?php

require_once __DIR__ . '/../models/Item.php'; 
require_once __DIR__ . '/../models/DataBase.php';

class ItemController {
    private $itemModel;

    public function __construct() {
        $this->itemModel = new Item();
    }

    public function add() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    
            if (!$name || !$description || !$price || $price <= 0) {
                die("Invalid input. Please fill in all fields correctly.");
            }
    
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . "/../../images/";
                $targetFile = $targetDir . basename($_FILES['image']['name']);
    
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = "/images/" . basename($_FILES['image']['name']);
                } else {
                    die("Erreur lors du téléchargement de l'image.");
                }
            }
    
            try {
                $this->itemModel->addItem($name, $description, floatval($price), $imagePath);
                echo "Item ajouté avec succès !";
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
        }
    }
    

    public function delete() {
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

            if (!$id || $id <= 0) {
                die("Invalid item ID.");
            }

            try {
                $this->itemModel->deleteItem($id);
                echo "Item deleted successfully!";
            } catch (Exception $e) {
                die("Error: " . $e->getMessage());
            }
        }
    }
}

$controller = new ItemController();

    $controller->add();

    $controller->delete();

?>

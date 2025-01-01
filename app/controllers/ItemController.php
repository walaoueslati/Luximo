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
    
            // Gérer l'upload de l'image
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . "/../../images/";
                $targetFile = $targetDir . basename($_FILES['image']['name']);
    
                // Vérifiez et déplacez le fichier uploadé
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = "/images/" . basename($_FILES['image']['name']);
                } else {
                    die("Erreur lors du téléchargement de l'image.");
                }
            }
    
            // Ajouter l'item dans la base de données
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
            // Sanitize and validate input
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

            if (!$id || $id <= 0) {
                die("Invalid item ID.");
            }

            // Delete item from the database
            try {
                $this->itemModel->deleteItem($id);
                echo "Item deleted successfully!";
            } catch (Exception $e) {
                die("Error: " . $e->getMessage());
            }
        }
    }
}

// Handle add or delete actions based on the request
$controller = new ItemController();

// Handle adding item
    $controller->add();

// Handle deleting item
    $controller->delete();

?>

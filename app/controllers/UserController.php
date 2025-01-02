<?php
require_once '../models/User.php';

class UserController {

    public function add() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = $_POST['password']; 
    
            if (!$name || !$email || !$password) {
                die("Veuillez remplir tous les champs.");
            }
    
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
    
            $userModel = new User();
            try {
                $userModel->addUser($name, $email, $hashedPassword);
                echo "Utilisateur ajouté avec succès!";
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
        }
    }
    

public function login() {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if (!$email || !$password) {
            die("Veuillez remplir tous les champs.");
        }

        $userModel = new User();
        try {
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {  
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name']; 
                echo "Connexion réussie!";
                header("Location: ../views/carts/add.php");
            } else {
                echo "Identifiants incorrects.";
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}
public function delete() {
    session_start(); 

    if (!isset($_SESSION['user_id'])) {
        die("Vous devez être connecté pour supprimer un utilisateur.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = intval($_POST['user_id']);

        $userModel = new User();

        $result = $userModel->deleteUser($userId);

        if ($result) {
            echo "Utilisateur supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'utilisateur.";
        }
    }
}

}

if (isset($_GET['action'])) {
    $controller = new UserController();
    if ($_GET['action'] === 'add') {
        $controller->add(); 
    } elseif ($_GET['action'] === 'login') {
        $controller->login(); 
    }
}

?>

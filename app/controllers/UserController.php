<?php
// controllers/UserController.php

// controllers/UserController.php

require_once '../models/User.php';

class UserController {

    // Méthode pour l'inscription
    public function add() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize et valider les données
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = $_POST['password']; // Le mot de passe
    
            if (!$name || !$email || !$password) {
                die("Veuillez remplir tous les champs.");
            }
    
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe
    
            // Ajouter l'utilisateur dans la base de données
            $userModel = new User();
            try {
                // Ajouter l'utilisateur avec le mot de passe haché
                $userModel->addUser($name, $email, $hashedPassword);
                echo "Utilisateur ajouté avec succès!";
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
        }
    }
    

    // Méthode pour la connexion
    // controllers/UserController.php
public function login() {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if (!$email || !$password) {
            die("Veuillez remplir tous les champs.");
        }

        // Vérification des informations de l'utilisateur
        $userModel = new User();
        try {
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {  // Utilisation de password_verify
                // Si l'email et le mot de passe correspondent
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name']; // Gardez le nom de l'utilisateur dans la session
                echo "Connexion réussie!";
                // Rediriger vers la page d'accueil ou le tableau de bord
                header("Location: ../views/carts/add.php");
            } else {
                echo "Identifiants incorrects.";
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}

}

// Vérification de l'action à effectuer
if (isset($_GET['action'])) {
    $controller = new UserController();
    if ($_GET['action'] === 'add') {
        $controller->add(); // Inscription
    } elseif ($_GET['action'] === 'login') {
        $controller->login(); // Connexion
    }
}

?>

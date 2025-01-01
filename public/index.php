<?php

require_once __DIR__ . '/../app/models/DataBase.php';

// Parse the URL
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Démarrer le tampon de sortie
ob_start();

// Default home page with links to add/delete items
echo '
    <div class="bienvenue">
        <h1>Bienvenue sur Luximo</h1>
        <a href="../app/views/users/add.php" class="sinscrire">
            <button type="submit">S\'inscrire</button>
        </a>
    </div>
';

// Capture le contenu du tampon dans une variable
$content = ob_get_clean();

$title = "Accueil"; // Définir un titre pour la page
include '../app/views/layout.php'; // Inclure le fichier layout.php
?>

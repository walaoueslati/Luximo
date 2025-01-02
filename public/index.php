<?php

require_once __DIR__ . '/../app/models/DataBase.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

ob_start();

echo '
    <div class="bienvenue">
        <h1>Bienvenue sur Luximo</h1>
        <a href="/../../app/views/users/add.php" class="sinscrire">
            <button type="submit">S\'inscrire</button>
        </a>
    </div>
';

$content = ob_get_clean();

$title = "Accueil"; 
include '../app/views/layout.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? "Luximo") ?></title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo-container">
                <img src="/../../images/home-sign-icon-front-side-white-background-removebg-preview.png" alt="Maison Logo" class="logo-image"/>
                <span class="site-name">Luximo</span>
            </div>
            <ul>
                <li><a href="/../../app/views/carts/add.php">Sommaire</a></li>
                <li><a href="https://www.mubawab.tn/" target="_blank" rel="noopener noreferrer">Notre partenaire</a></li>
                <li><a href="/../../app/views/carts/view_cart.php">Mon Panier</a></li>
                <li><a href="/../../app/views/items/add.php">Ajout Item</a></li>
                <li><a href="/../../app/views/users/add.php">SignUp</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?= $content ?? '<p>Aucun contenu disponible</p>' ?>
    </main>
    <footer>
        <div>
            <img src="/../../images/home-sign-icon-front-side-white-background-removebg-preview.png" alt="Maison Logo" class="logo-image"/>
        </div>
        <div>
            <p>Nous mettons à votre disposition une large sélection de biens immobiliers, que vous soyez à la recherche d\'une maison, d\'un appartement, d\'un terrain ou d\'un investissement immobilier. Notre expertise et notre accompagnement personnalisé font de nous votre partenaire immobilier de confiance.</p>
        </div>
        <div>
            <h3>Contactez-nous</h3>
            <p><strong>Adresse:</strong> 123 Rue de Taffela, Sousse, Tunisia</p>
            <p><strong>Téléphone:</strong> +216 52 752 055</p>
            <p><strong>Email:</strong> contact@Luximo.com</p>
            <p><strong>Horaires:</strong> Lundi - Vendredi: 9h00 - 18h00</p>
        </div>
        <div>
            <p>&copy; 2024 Luximo. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>

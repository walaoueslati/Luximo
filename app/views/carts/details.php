<?php
$title = "Détails";
ob_start();
?>
<?php
// Récupérer l'ID depuis l'URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Vérifier l'ID et obtenir les détails de la maison
if ($id > 0) {
    // Simuler une base de données avec des maisons en dur
    $houses = [
        1 => [
            'name' => 'Maison moderne avec vue sur mer',
            'description' => 'Cette maison moderne offre une vue imprenable sur la mer avec un design épuré et contemporain.',
            'price' => 500000,
            'image' => '/../../images/2-525x328.jpg'
        ],
        2 => [
            'name' => 'Villa luxueuse avec piscine',
            'description' => 'Une villa de luxe avec piscine privée et un grand jardin.',
            'price' => 1200000,
            'image' => '/../../images/2-525x328.jpg'
        ],
        3 => [
            'name' => 'Appartement spacieux au centre-ville',
            'description' => 'Appartement spacieux idéalement situé au centre-ville.',
            'price' => 300000,
            'image' => '/../../images/2-525x328.jpg'
        ],
        4 => [
            'name' => 'Maison traditionnelle en campagne',
            'description' => 'Maison charmante située dans un cadre calme et paisible.',
            'price' => 200000,
            'image' => '/../../images/2-525x328.jpg'
        ],
    ];

    // Vérifier si l'ID correspond à une maison existante
    if (isset($houses[$id])) {
        $house = $houses[$id];
        ?>
        <div class="details-container">
            <img src="<?php echo $house['image']; ?>" alt="<?php echo $house['name']; ?>" class="details-image" />
            <h1><?php echo $house['name']; ?></h1>
            <p class="description"><?php echo $house['description']; ?></p>
            <p class="price"><?php echo number_format($house['price'], 2) . ' TND'; ?></p>
            <button class="add-to-cart">Ajouter au panier</button>
        </div>
        <?php
    } else {
        echo "<p>Maison introuvable.</p>";
    }
} else {
    echo "<p>ID de maison invalide.</p>";
    }
?>
<?php
$content = ob_get_clean();
include '../layout.php';
?>

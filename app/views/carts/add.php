<?php
session_start();  

if (isset($_POST['logout'])) {
    session_destroy();
    if (isset($_SESSION['user_id'])) {
        setcookie('cart_' . $_SESSION['user_id'], '', time() - 3600, '/');  
    }
    header('Location: ../../../public/index.php');
    exit;
}

$title = "Cart";
ob_start();
?>
<div class="contenue">
<div class="container">
    <div class="card-container">
        <?php
        $houses = [
            1 => ['name' => 'Maison moderne avec vue sur mer', 'price' => 500000, 'image' => '/../../public/images/2-525x328.jpg'],
            2 => ['name' => 'Villa luxueuse avec piscine', 'price' => 1200000, 'image' => '/../../public/images/2-525x328.jpg'],
            3 => ['name' => 'Appartement spacieux au centre-ville', 'price' => 300000, 'image' => '/../../public/images/2-525x328.jpg'],
            4 => ['name' => 'Maison traditionnelle en campagne', 'price' => 200000, 'image' => '/../../public/images/2-525x328.jpg'],
            5 => ['name' => 'Ville style american ', 'price' => 600000, 'image' => '/../../public/images/2-525x328.jpg'],
            6 => ['name' => 'Maison contemporaine', 'price' => 150000, 'image' => '/../../public/images/2-525x328.jpg']
        ];

        $counter = 0;
        foreach ($houses as $id => $house) {
            if ($counter % 3 == 0 && $counter > 0) {
                echo '</div><div class="card-container">';
            }
        ?>
            <div class="card">
                <a href="./details.php?id=<?php echo $id; ?>">
                    <img src="<?php echo $house['image']; ?>" alt="Maison <?php echo $id; ?>" class="card-image" />
                    <p class="description"><?php echo $house['name']; ?></p>
                    <p class="price"><?php echo number_format($house['price'], 0, '.', ' ') . ' TND'; ?></p>
                </a>
                <a href="./add_to_cart.php?id=<?php echo $id; ?>" class="cart-link">Ajouter au panier</a>
            </div>
        <?php
            $counter++;
        }
        ?>
    </div> 

    
</div>
<br/>
   <form method="post">
        <button type="submit" name="logout">Se déconnecter</button>
    </form>

</div>

<?php
$content = ob_get_clean();
include '../layout.php';
?>

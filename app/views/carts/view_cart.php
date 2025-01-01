<?php

$title = "Cart";
ob_start();
session_start();

// Vérifier si un utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour voir votre panier.");
}

// Vérifier si un panier existe pour cet utilisateur dans le cookie
$userId = $_SESSION['user_id'];
$cartCookieName = "cart_$userId";  // Crée un nom de cookie unique pour chaque utilisateur
$cart = isset($_COOKIE[$cartCookieName]) ? json_decode($_COOKIE[$cartCookieName], true) : [];

if (empty($cart)) {
    echo "<p>Le panier est vide.</p>";
} else {
    echo "<h2>Votre Panier</h2>";
    echo "<table>";
    echo "<tr><th>Produit</th><th>Prix</th><th>Quantité</th><th>Total</th></tr>";
    $total = 0;
    foreach ($cart as $item_id => $item) {
        $item_total = $item['price'] * $item['quantity'];
        $total += $item_total;
        echo "<tr>
                <td>{$item['name']}</td>
                <td>{$item['price']} TND</td>
                <td>{$item['quantity']}</td>
                <td>{$item_total} TND</td>
              </tr>";
    }
    echo "<tr><td colspan='4'>Total</td><td>{$total} TND</td></tr>";
    echo "</table>";
}
$content = ob_get_clean();
include '../layout.php';
?>

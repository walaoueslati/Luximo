<?php
$item_id = intval($_GET['id']);

// Récupérer le panier actuel depuis le cookie
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Supprimer l'article si existant
if (isset($cart[$item_id])) {
    unset($cart[$item_id]);
}

// Mettre à jour le cookie
setcookie('cart', json_encode($cart), time() + (86400 * 7), "/");

echo "Article retiré du panier avec succès.";
?>

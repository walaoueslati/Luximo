<?php
$item_id = intval($_GET['id']);

$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

if (isset($cart[$item_id])) {
    unset($cart[$item_id]);
}

setcookie('cart', json_encode($cart), time() + (86400 * 7), "/");

echo "Article retiré du panier avec succès.";
?>

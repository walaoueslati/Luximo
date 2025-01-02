<?php
session_start(); 
if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour ajouter un produit au panier.");
}
if (isset($_GET['id'])) {
    $item_id = intval($_GET['id']); 
    $houses = [
        1 => ['name' => 'Maison moderne avec vue sur mer', 'price' => 500000],
        2 => ['name' => 'Villa luxueuse avec piscine', 'price' => 1200000],
        3 => ['name' => 'Appartement spacieux au centre-ville', 'price' => 300000],
        4 => ['name' => 'Maison traditionnelle en campagne', 'price' => 200000],
        5 => ['name' => 'Maison traditionnelle en campagne', 'price' => 200000],
        6 => ['name' => 'Maison traditionnelle en campagne', 'price' => 200000]
    ];

    if (isset($houses[$item_id])) {
        $user_id = $_SESSION['user_id'];
        $cart_cookie_name = "cart_$user_id";  

        $cart = isset($_COOKIE[$cart_cookie_name]) ? json_decode($_COOKIE[$cart_cookie_name], true) : [];

        if (isset($cart[$item_id])) {
            $cart[$item_id]['quantity'] += 1;
        } else {
            $cart[$item_id] = [
                'id' => $item_id,
                'name' => $houses[$item_id]['name'],
                'price' => $houses[$item_id]['price'],
                'quantity' => 1,
            ];
        }

        setcookie($cart_cookie_name, json_encode($cart), time() + (86400 * 7), "/"); // Le cookie expire dans 7 jours

        header('Location: view_cart.php');
        exit;
    } else {
        echo "Erreur : Maison introuvable.";
    }
} else {
    echo "Erreur : Aucun ID d'article fourni.";
}
?>

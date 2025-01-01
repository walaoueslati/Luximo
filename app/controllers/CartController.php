<?php

require_once __DIR__ . '/../models/Cart.php';

class CartController {
    private $cart;

    public function __construct() {
        $this->cart = new Cart();
    }

    // Afficher le panier
    public function index() {
        $cartItems = $this->cart->getCart();
        $total = $this->cart->getTotal();

        // Charger la vue du panier
        include __DIR__ . '/../views/cart.php';
    }

    // Ajouter un article au panier
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $price = $_POST['price'] ?? null;

            if ($id && $name && $price) {
                $this->cart->addItem($id, $name, $price);
            }

            header('Location: /cart');
            exit;
        }
    }

    // Supprimer un article du panier
    public function remove() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id) {
                $this->cart->deleteItem($id);
            }

            header('Location: /cart');
            exit;
        }
    }

    // Mettre à jour la quantité d'un article
   
}


$cartController = new CartController();


    $cartController->add();
    $cartController->remove();



?>

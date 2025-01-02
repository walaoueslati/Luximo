<?php

require_once __DIR__ . '/../models/Cart.php';

class CartController {
    private $cart;

    public function __construct() {
        $this->cart = new Cart();
    }

     
    public function index() {
        $cartItems = $this->cart->getCart();
        $total = $this->cart->getTotal();

        include __DIR__ . '/../views/cart.php';
    }

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

   
}


$cartController = new CartController();


    $cartController->add();
    $cartController->remove();



?>

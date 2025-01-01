<?php

class Cart
{
    private $cookieName = 'luximo_cart';

    // Récupérer le contenu du panier
    public function getCart()
    {
        if (!isset($_COOKIE[$this->cookieName])) {
            return [];
        }

        return json_decode($_COOKIE[$this->cookieName], true) ?? [];
    }

    // Ajouter un article au panier
    public function addItem($id, $name, $price, $quantity = 1)
    {
        $cart = $this->getCart();

        // Vérifier si l'article existe déjà dans le panier
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
            ];
        }

        $this->saveCart($cart);
    }

    // Mettre à jour la quantité d'un article
    public function updateItem($id, $quantity)
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                unset($cart[$id]); // Supprimer l'article si la quantité est 0
            }

            $this->saveCart($cart);
        }
    }

    // Supprimer un article du panier
    public function deleteItem($id)
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($cart);
        }
    }

    // Vider le panier
    public function clearCart()
    {
        setcookie($this->cookieName, '', time() - 3600, '/'); // Expire le cookie
    }

    // Calculer le total du panier
    public function getTotal()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    // Sauvegarder le panier dans les cookies
    private function saveCart($cart)
    {
        setcookie($this->cookieName, json_encode($cart), time() + (86400 * 30), '/'); // Expire dans 30 jours
    }
}

<?php

class Cart
{
    private $cookieName = 'luximo_cart';

    public function getCart()
    {
        if (!isset($_COOKIE[$this->cookieName])) {
            return [];
        }

        return json_decode($_COOKIE[$this->cookieName], true) ?? [];
    }

    public function addItem($id, $name, $price, $quantity = 1)
    {
        $cart = $this->getCart();

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

    public function updateItem($id, $quantity)
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                unset($cart[$id]); 
            }

            $this->saveCart($cart);
        }
    }

    public function deleteItem($id)
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($cart);
        }
    }

    public function clearCart()
    {
        setcookie($this->cookieName, '', time() - 3600, '/'); 
    }

    public function getTotal()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    private function saveCart($cart)
    {
        setcookie($this->cookieName, json_encode($cart), time() + (86400 * 30), '/'); // Expire dans 30 jours
    }
}

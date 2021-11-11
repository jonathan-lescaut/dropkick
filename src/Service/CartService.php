<?php

namespace App\Service;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTime;

class CartService {

    protected $session;
    protected $productsRepository;

    public function __construct(SessionInterface $session, ProductsRepository $productsRepository)
    {
        $this->session = $session;
        $this->productsRepository = $productsRepository;

    }

    function add(Products $product)
    {
        $cart = $this->session->get("cart", []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
            $cart[$id]++;
            
        }else {
            $cart[$id] = 1;
        }
        $this->session->set("cart", $cart);

    }
    function remove(Products $product)
    {
        $cart = $this->session->get("cart", []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            }else {
                unset($cart[$id]);
            }
            
        }
        $this->session->set("cart", $cart);


    }
    function getFullCart(): array
    {
        $cart = $this->session->get("cart", []);
        // on fabrique les données
        $dataCart = [];
        foreach ($cart as $id => $quantite) {
            $product = $this->productsRepository->find($id);
            $pub = $product->getPub();
            
            $dataCart[] = [
                "pub" => $pub,
                "product" => $product,
                "quantite" => $quantite,
            ];


        }
        return $dataCart;
    }



    function getTotal(): float
    {
        $total = 0;
        foreach ($this->getFullCart() as $item) {
            $total += $item['product']->getPriceProduct() * $item['quantite'];
        }
        return $total;

    }
}
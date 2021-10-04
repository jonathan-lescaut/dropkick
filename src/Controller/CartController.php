<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(SessionInterface $session, ProductsRepository $productsRepository)
    {

        $cart = $session->get("cart", []);

        // on fabrique les données

        $dataCart = [];
        $total = 0;

        foreach ($cart as $id => $quantite) {
            $product = $productsRepository->find($id);
            $dataCart[] = [
                "product" => $product,
                "quantite" => $quantite
            ];
            $total += $product->getPriceProduct() * $quantite;
        }

        

        return $this->render('cart/index.html.twig', compact("dataCart", "total"));
    }

        /**
         * @Route("/add/{id}", name="cart_add")
         */
    public function add(SessionInterface $session, Products $product)
    {
        // on recupere le panier actuel
        $cart = $session->get("cart", []);
        $id = $product->getId();

        if (!empty($cart[$id])) {
            $cart[$id]++;
            
        }else {
            // $cart = array();
            $cart[$id] = 1;
        }
        $session->set("cart", $cart);

        return $this->redirectToRoute('cart_index');
    }

            /**
         * @Route("/remove/{id}", name="cart_remove")
         */
        public function remove(SessionInterface $session, Products $product)
        {
            // on recupere le panier actuel
            $cart = $session->get("cart", []);
            $id = $product->getId();
    
            if (!empty($cart[$id])) {
                if ($cart[$id] > 1) {
                    $cart[$id]--;
                }else {
                    unset($cart[$id]);
                }
                
            }
            $session->set("cart", $cart);
    
            return $this->redirectToRoute('cart_index');
        }

        /**
         * @Route("/delete/{id}", name="cart_delete")
         */
        public function delete(SessionInterface $session, Products $product)
        {
            // on recupere le panier actuel
            $cart = $session->get("cart", []);
            $id = $product->getId();
    
            if (!empty($cart[$id])) {
                unset($cart[$id]);
            }
            $session->set("cart", $cart);
    
            return $this->redirectToRoute('cart_index');
        }


        /**
         * @Route("/delete", name="cart_delete_all")
         */
        public function deleteAll(SessionInterface $session)
        {

            $session->set("cart", []);
    
            return $this->redirectToRoute('cart_index');
        }
}

<?php

namespace App\Controller;

use App\Entity\Products;
use App\Entity\Pubs;
use App\Repository\ProductsRepository;
use App\Repository\PubsRepository;
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
            $pub = $product->getPub();

            $dataCart[] = [
                "pub" => $pub,
                "product" => $product,
                "quantite" => $quantite
            ];
            $total += $product->getPriceProduct() * $quantite;
        }

        

        return $this->render('cart/index.html.twig', compact("dataCart", "total"));
    }

        /**
         * @Route("/add/{product}/", name="cart_add", requirements={"product"="\d+"})
         */
    public function add(SessionInterface $session, Products $product)
    {
        // on recupere le panier actuel
        $cart = $session->get("cart", []);
        $id = $product->getId();
        $pub = $product->getPub();

        if (!empty($cart[$id])) {
            $cart[$id]++;
            
        }else {
            $cart[$id] = 1;
        }
        $session->set("cart", $cart);
 
        return $this->redirectToRoute('pubs_show', array('id' => $pub->getId()));


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

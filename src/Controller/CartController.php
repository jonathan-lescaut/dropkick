<?php

namespace App\Controller;

use App\Entity\Products;
use App\Service\CartService;
use GuzzleHttp\Psr7\Request;
use App\Service\SendMailService;
use App\Repository\ProductsRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(CartService $cartService)
    {
        return $this->render('cart/index.html.twig', [
            'dataCart' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()
        ]);
    }
        /**
        * @Route("/add/{product}/", name="cart_add", requirements={"product"="\d+"})
        */
    public function add(CartService $cartService, Products $product, FlashyNotifier $flashy)
    {
        // on recupere le panier actuel avec le service
        $cartService->add($product);

        $pub = $product->getPub();
        $flashy->success('Ajouté au panier !');
        if ($_SERVER["PATH_INFO"] === "/cart"){
            return $this->redirectToRoute('cart_index');
        }else {
            
            return $this->redirectToRoute('pubs_show', array('id' => $pub->getId()));
        }
        
    }

            /**
         * @Route("/remove/{id}", name="cart_remove")
         */
        public function remove(CartService $cartService, Products $product)
        {
            // on recupere le panier actuel
            $cartService->remove($product);
    
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


        /**
         * @Route("/commande", name="commande")
         */
        public function Commande(SessionInterface $session, ProductsRepository $productsRepository, SendMailService $mail, Request $request)
        {

            $form = $this->createForm(ContactType::class);

            $contact = $form->handleRequest($request);


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
                    "quantite" => $quantite,
                ];
                $total += $product->getPriceProduct() * $quantite;
            }
        }
}
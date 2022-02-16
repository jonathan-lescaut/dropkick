<?php


namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Products;
use App\Services\CartService;
use App\Manager\ContactManager;
use App\Manager\ProductManager;
use App\Services\MailerService;
use App\Services\MessageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DashboardController extends AbstractController
{
      /**
         * 
         * @Route("/cart/payment/{id}", name="payment", methods={"GET", "POST"})
         * @param Cart  $cartOrder
         * @param ProductManager $productManager
         * @return Response
         */

        public function payment(ProductManager $productManager, Cart $cartOrder): Response
        {
            if (!$this->getUser()) {
                return $this->redirectToRoute('login');
            }
    
            return $this->render('cart/payment.html.twig', [
                'user' => $this->getUser(),
                'intentSecret' => $productManager->intentSecret($cartOrder),
                'cart' => $cartOrder,
            ]);
        }

    /**
     * @Route("/cart/subscription/{id}/paiement/load", name="subscription_paiement", methods={"GET", "POST"})
     * @param Cart $cart
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     */
    public function subscription(
        Cart $cart,
        Request $request,
        ProductManager $productManager
    ){
        $user =$this->getUser();
        if ($request->getMethod() === "POST") {
            $resource = $productManager->stripe($_POST, $cart);

            if(null !== $resource) {
                $productManager->create_subscription($resource, $cart, $user);

                return $this->render('cart/reponse.html.twig', [
                    'product' => $cart
                ]);
            }
        }
        return $this->redirectToRoute('cart', ['id' => $cart->getId()]);
    }
    /**
     * @Route("/user/payment/orders", name="payment_orders", methods={"GET"})
     * @param ProductManager $productManager
     * @return Response
     */
    // public function payment_orders(ProductManager $productManager): Response
    // {
    //     if (!$this->getUser()) {
    //         return $this->redirectToRoute('login');
    //     }

    //     return $this->render('user/payment_story.html.twig', [
    //         'user' => $this->getUser(),
    //         'orders' => $productManager->getProducts($this->getUser()),
    //         'sumOrder' => $productManager->countSoldeOrder($this->getUser()),
    //     ]);
    // }




        /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MessageService $messageService
     * @param ContactManager $contactManager
     * @return Response
     */
    public function contact(
        Request $request,
        ContactManager $contactManager,
        MessageService $messageService,
        MailerService $mailerService
    ): Response
    {
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $contactManager->sendContact($contact);
            return $this->redirectToRoute('contact');
        }

        return $this->render('default/contact.html.twig', [
            'formContact' => $formContact->createView()
        ]);
    }

    /**
     * @Route("/card", name="card")
     * @param Request $request
     * @param CardRepository $cardRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function card(
        Request $request,
        CardRepository $cardRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        $card = new Card();
        $card->setUrl('https://devsprof.fr');

        $formProduct = $this->createForm(CardType::class, $card);
        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            $entityManager->persist($card);
            $entityManager->flush();

            return $this->redirectToRoute('card');
        }

        return $this->render('default/card.html.twig', [
            'formCard' => $formProduct->createView(),
            'cards' => $cardRepository->findAll()
        ]);
    }
}

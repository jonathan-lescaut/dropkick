<?php

namespace App\Manager;

use App\Entity\Cart;
use App\Entity\User;
use App\Entity\Order;
use App\Services\StripeService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OrderRepository;

class ProductManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var StripeService
     */

    protected $stripeService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param StripeService $stripeService
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        StripeService $stripeService
    ) {
        $this->em = $entityManager;
        $this->stripeService = $stripeService;
    }

    /**
     * @param User $user
     * @return mixed
     */

     
    // public function countSoldeOrder(User $user)
    // {
    //     return $this->em->getRepository(Order::class)
    //     ->countSoldeOrder($user);
    // }

    public function getProducts()
    {
        return $this->em->getRepository(Cart::class)
            ->findAll();
    }

    public function intentSecret(Cart $cart)
    {
        $intent = $this->stripeService->paymentIntent($cart);

        return $intent['client_secret'] ?? null;
    }
    /**
     *
     * @param array $stripeParameter
     * @param Cart $cart
     * @return array|null
     */
    public function stripe(array $stripeParameter, Cart $cart)
    {
        $resource = null;
        $data = $this->stripeService->stripe($stripeParameter, $cart);
        if ($data) {
            $resource = [
                'stripeBrand' => $data['charges']['data'][0]['payment_method_details']['card']['brand'],
                'stripeLast4' => $data['charges']['data'][0]['payment_method_details']['card']['last4'],
                'striteId' => $data['charges']['data'][0]['id'],
                'stripeStatus' => $data['charges']['data'][0]['status'],
                'stripeToken' => $data['client_secret']
            ];
        }
        return $resource;
    }


    /**
     *
     * @param array $resource
     * @param Cart $cart
     * @param User $user
     */
    public function create_subscription(array $resource, Cart $cart, User $user)   
    {
        $order = new Order();
        $order->setUser($user);
        $order->setCartOrder($cart);
        $order->setPriceOrder($cart->getTotalCart());
        $order->setReferenceOrder(uniqid(prefix:'', more_entropy:false));
        $order->setBrandStripe($resource['stripeBrand']);
        $order->setLast4Stripe($resource['stripeLast4']);
        $order->setIdChargeStripe($resource['striteId']);
        $order->setStripeToken($resource['stripeToken']);
        $order->setStatusStripe($resource['stripeStatus']);
        $order->setUpdatedAt(new \dateTime());
        $order->setCreatedAt(new \dateTime());
        $this->em->persist($order);
        $this->em->flush();


    }

}
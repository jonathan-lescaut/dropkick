<?php

namespace App\Services;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\Products;
use App\Services\CartService;
use Stripe\Order as StripeOrder;

class StripeService
{
    private $privateKey;

    public function __construct()
    {
        if ($_ENV['APP_ENV']  === 'dev') {
            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_TEST'];
        }else{
            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_LIVE'];

        }
    }
/**

 * @param Cart $cart
 * @return \Stripe\PaymentIntent
 * @throws \Stripe\Exception\ApiErrorException
 */
    public function paymentIntent(Cart $cart)
    {
        \Stripe\Stripe::setApiKey($this->privateKey);

        return \Stripe\PaymentIntent::create([
            'amount' => $cart->getTotalCart() * 100,
            'currency' => Order::DEVISE,
            'payment_method_types' => ['card']
        ]);
    }
    
    public function paiement($amount, $currency, $description, array $stripeParameter) {
        \Stripe\Stripe::setApiKey($this->privateKey);
        $payment_intent = null;

        if (isset($stripeParameter['stripeIntentId'])) {
            $payment_intent = \Stripe\PaymentIntent::retrieve($stripeParameter['stripeIntentId']);
        }
        if ($stripeParameter['stripeIntentStatus'] === 'succeeded') {
            
        }else {
            $payment_intent->cancel();
        }
        return $payment_intent;
    }

    /**
     * @param array $stripeParameter
     * @param Products $products
     * return \Stripe\PaymentIntent|null
     */

    public function stripe(array $stripeParameter, Cart $cart)
    {
        return $this->paiement(
            $cart->getTotalCart() *100,
            Order::DEVISE,
            $cart->getTotalCart(),
            $stripeParameter
        );
    }


}
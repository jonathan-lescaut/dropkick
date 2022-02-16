<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\User;
use App\Form\CartType;
use App\Services\CartService;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cart/order')]
class CartOrderController extends AbstractController
{
    #[Route('/', name: 'cart_order_index', methods: ['GET'])]
    public function index(CartRepository $cartRepository): Response
    {
        return $this->render('cart_order/index.html.twig', [
            'carts' => $cartRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin", name="cartAdmin_index", methods={"GET"})
     */
    public function indexAdmin(CartRepository $cartRepository): Response
    {
        return $this->render('cart_order/admin.html.twig', [
            'carts' => $cartRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'cart_order_new', methods: ['GET', 'POST'])]
    public function new(CartService $cartService, Request $request, EntityManagerInterface $entityManager): Response
    {

        $cart = new Cart();
        $user = $this->getUser();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);
        $cartContent = $cartService->getFullCart();
        $cartTotal = $cartService->getTotal();

        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setTotalCart($cartTotal);
            foreach ($cartContent as $val => $value)  {
                $cartResult[] = $cartContent[$val]['product']->getNameProduct($val);   
            }
            $cartResultSeparate = implode(", ", $cartResult);
            $cart->setContentCart($cartResultSeparate);
            $cart->setUserCart($user);
            $entityManager->persist($cart);
            $entityManager->flush();

            return $this->redirectToRoute('cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cart_order/new.html.twig', [
            'dataCart' => $cartService->getFullCart(),
            'cart' => $cart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'cart_order_show', methods: ['GET'])]
    public function show(Cart $cart): Response
    {
        return $this->render('cart_order/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/{id}/edit', name: 'cart_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('cart_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cart_order/edit.html.twig', [
            'cart' => $cart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'cart_order_delete', methods: ['POST'])]
    public function delete(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cart->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cart_order_index', [], Response::HTTP_SEE_OTHER);
    }
}

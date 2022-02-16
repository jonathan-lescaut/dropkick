<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use App\Repository\PubsRepository;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PubsRepository $pubsRepository, ProductsRepository $productsRepository, PresentationRepository $presentationRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'pubs' => $pubsRepository->findAll(),
            'products' => $productsRepository->findAll(),
            'presentation' => $presentationRepository->findAll()
        ]);
    }
        /**
     * @Route("/admin", name="homeAdmin")
     */
    public function indexAdmin(PubsRepository $pubsRepository, ProductsRepository $productsRepository, PresentationRepository $presentationRepository): Response

    {
        return $this->render('home/admin.html.twig', [
            'controller_name' => 'HomeController',
            'pubs' => $pubsRepository->findAll(),
            'products' => $productsRepository->findAll(),
            'presentation' => $presentationRepository->findAll(),
        ]);
    }
    
    #[Route('/rgpd', name: 'rgpd')]
    public function rgpd(): Response
    {
        return $this->render('home/rgpd.html.twig');
    }
}

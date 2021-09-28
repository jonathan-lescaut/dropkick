<?php

namespace App\Controller;

use App\Entity\Pubs;
use App\Form\PubsType;
use App\Repository\PubsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pubs")
 */
class PubsController extends AbstractController
{
    /**
     * @Route("/", name="pubs_index", methods={"GET"})
     */
    public function index(PubsRepository $pubsRepository): Response
    {
        return $this->render('pubs/index.html.twig', [
            'pubs' => $pubsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pubs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pub = new Pubs();
        $form = $this->createForm(PubsType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pub);
            $entityManager->flush();

            return $this->redirectToRoute('pubs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pubs/new.html.twig', [
            'pub' => $pub,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pubs_show", methods={"GET"})
     */
    public function show(Pubs $pub): Response
    {
        return $this->render('pubs/show.html.twig', [
            'pub' => $pub,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pubs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pubs $pub): Response
    {
        $form = $this->createForm(PubsType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pubs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pubs/edit.html.twig', [
            'pub' => $pub,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pubs_delete", methods={"POST"})
     */
    public function delete(Request $request, Pubs $pub): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pub->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pub);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pubs_index', [], Response::HTTP_SEE_OTHER);
    }
}

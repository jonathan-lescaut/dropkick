<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Form\PresentationType;
use App\Repository\PresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/presentation')]
class PresentationController extends AbstractController
{
    #[Route('/', name: 'presentation_index', methods: ['GET'])]
    public function index(PresentationRepository $presentationRepository): Response
    {
        return $this->render('presentation/index.html.twig', [
            'presentations' => $presentationRepository->findAll(),
        ]);
    }
    #[Route('/admin', name: 'presentationAdmin_index', methods: ['GET'])]
    public function indexAdmin(PresentationRepository $presentationRepository): Response
    {
        return $this->render('presentation/admin.html.twig', [
            'presentations' => $presentationRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'presentation_show', methods: ['GET'])]
    public function show(Presentation $presentation): Response
    {
        return $this->render('presentation/show.html.twig', [
            'presentation' => $presentation,
        ]);
    }

    #[Route('/{id}/edit', name: 'presentation_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Presentation $presentation): Response
    {
        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homeAdmin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presentation/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }
}

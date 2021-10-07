<?php

namespace App\Controller;

use App\Entity\Pubs;
use App\Form\PubsType;
use App\Repository\PubsRepository;
use App\Repository\EventsRepository;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


/**
 * @Route("/pubs")
 * @IsGranted("ROLE_USER", message="Vous n'avez pas les droits d'accés")
 */
class PubsController extends AbstractController
{
    /**
     * @Route("/", name="pubs_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits d'accés")
     */
    public function index(PubsRepository $pubsRepository): Response
    {
        return $this->render('pubs/index.html.twig', [
            'pubs' => $pubsRepository->findAll(),
            

        ]);
    }

    /**
     * @Route("/new", name="pubs_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droit d'accés")
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $pub = new Pubs();
        $form = $this->createForm(PubsType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $imgPub = $form->get('imgPub')->getData();
                if ($imgPub) {
                $originalFilename = pathinfo($imgPub->getClientOriginalName(),
                PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imgPub->guessExtension();

                try {
                $imgPub->move(
                $this->getParameter('photos_directory'),
                $newFilename
                );
                } catch (FileException $e) {}
                    
                
                $pub->setImgPub($newFilename);
            }

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
     * @IsGranted("ROLE_USER", message="Vous n'avez pas les droit d'accés")
     */
    public function show(Pubs $pub, EventsRepository $eventsRepository, ProductsRepository $productsRepository): Response
    {
        return $this->render('pubs/show.html.twig', [
            'pub' => $pub,
            'events' => $eventsRepository->findAll(),
            'products' => $productsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pubs_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits d'accés")
     */
    public function edit(Request $request, Pubs $pub, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PubsType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imgPub = $form->get('imgPub')->getData();
            if ($imgPub) {
            $originalFilename = pathinfo($imgPub->getClientOriginalName(),
            PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imgPub->guessExtension();

            try {
            $imgPub->move(
            $this->getParameter('photos_directory'),
            $newFilename
            );
            } catch (FileException $e) {}
                
            
            $pub->setImgPub($newFilename);
        }
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
     * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits d'accés")
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

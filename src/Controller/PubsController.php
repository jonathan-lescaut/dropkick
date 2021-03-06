<?php

namespace App\Controller;

use App\Entity\Pubs;
use App\Form\PubsType;
use App\Repository\PubsRepository;
use App\Repository\EventsRepository;
use App\Repository\ProductsRepository;
use App\Repository\CategoriesRepository;
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
     * @Route("/admin", name="pubsAdmin_index", methods={"GET"})
     */
    public function indexAdmin(PubsRepository $pubsRepository): Response
    {
        return $this->render('pubs/admin.html.twig', [
            'pubs' => $pubsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pubs_new", methods={"GET","POST"})
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
     */
    public function show(Pubs $pub, EventsRepository $eventsRepository, ProductsRepository $productsRepository, CategoriesRepository $categoryRepository): Response
    {
        return $this->render('pubs/show.html.twig', [
            'pub' => $pub,
            'events' => $eventsRepository->findAll(),
            'products' => $productsRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }


    #[Route('/{id}/edit', name: 'pubs_edit', methods: ['GET','POST'])]

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

            // ====================================


            $cardPdf = $form->get('cardPdf')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($cardPdf) {
                $originalFilename = pathinfo($cardPdf->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$cardPdf->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $cardPdf->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $pub->setCardPdf($newFilename);
            }
            $this->getDoctrine()->getManager()->flush();
            // ====================================


            return $this->redirectToRoute('homeAdmin', [], Response::HTTP_SEE_OTHER);
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

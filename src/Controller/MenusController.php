<?php

namespace App\Controller;

use App\Entity\Menus;
use App\Form\MenusType;
use App\Repository\MenusRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @Route("/menus")
 * @IsGranted("ROLE_ADMIN", message="Vous n'avez pas les droits d'accés")
 */
class MenusController extends AbstractController
{
    /**
     * @Route("/", name="menus_index", methods={"GET"})
     */
    public function index(MenusRepository $menusRepository): Response
    {
        return $this->render('menus/index.html.twig', [
            'menuses' => $menusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="menus_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $menu = new Menus();
        $form = $this->createForm(MenusType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgMenu = $form->get('imgMenu')->getData();
            if ($imgMenu) {
                $originalFilename = pathinfo($imgMenu->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imgMenu->guessExtension();


                try {
                    $imgMenu->move(
                $this->getParameter('photos_directory'), $newFilename
                    );
                } catch (FileException $e) {

                    }

                        $menu->setImgMenu($newFilename);
                    }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menu);
            $entityManager->flush();

            return $this->redirectToRoute('menus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menus/new.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="menus_show", methods={"GET"})
     */
    public function show(Menus $menu): Response
    {
        return $this->render('menus/show.html.twig', [
            'menu' => $menu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="menus_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Menus $menu): Response
    {
        $form = $this->createForm(MenusType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menus/edit.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="menus_delete", methods={"POST"})
     */
    public function delete(Request $request, Menus $menu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token'))) {







            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($menu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('menus_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Kinds;
use App\Form\KindsType;
use App\Repository\SiteRepository;
use App\Repository\KindsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/kinds")
 */
class KindsController extends AbstractController
{
    /**
     * @Route("/", name="kinds_index", methods={"GET"})
     */
    public function index(KindsRepository $kindsRepository, SiteRepository $siteRepository): Response
    {
        return $this->render('kinds/index.html.twig', [
            'kinds' => $kindsRepository->findAll(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="kinds_new", methods={"GET","POST"})
     */
    public function new(Request $request, SiteRepository $siteRepository): Response
    {
        $kind = new Kinds();
        $form = $this->createForm(KindsType::class, $kind);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kind);
            $entityManager->flush();

            return $this->redirectToRoute('kinds_index');
        }

        return $this->render('kinds/new.html.twig', [
            'kind' => $kind,
            'form' => $form->createView(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="kinds_show", methods={"GET"})
     */
    public function show(Kinds $kind, SiteRepository $siteRepository): Response
    {
        return $this->render('kinds/show.html.twig', [
            'kind' => $kind,
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kinds_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kinds $kind, SiteRepository $siteRepository): Response
    {
        $form = $this->createForm(KindsType::class, $kind);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kinds_index');
        }

        return $this->render('kinds/edit.html.twig', [
            'kind' => $kind,
            'form' => $form->createView(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="kinds_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Kinds $kind, SiteRepository $siteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kind->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kind);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kinds_index');
    }
}

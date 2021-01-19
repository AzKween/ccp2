<?php

namespace App\Controller;

use App\Entity\Ordered;
use App\Form\OrderedType;
use App\Repository\SiteRepository;
use App\Repository\OrderedRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/ordered")
 */
class OrderedController extends AbstractController
{
    /**
     * @Route("/", name="ordered_index", methods={"GET"})
     */
    public function index(OrderedRepository $orderedRepository, SiteRepository $siteRepository): Response
    {
        return $this->render('ordered/index.html.twig', [
            'ordereds' => $orderedRepository->findAll(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ordered_new", methods={"GET","POST"})
     */
    public function new(Request $request, SiteRepository $siteRepository): Response
    {
        $ordered = new Ordered();
        $form = $this->createForm(OrderedType::class, $ordered);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ordered);
            $entityManager->flush();

            return $this->redirectToRoute('ordered_index');
        }

        return $this->render('ordered/new.html.twig', [
            'ordered' => $ordered,
            'form' => $form->createView(),
            'site' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="ordered_show", methods={"GET"})
     */
    public function show(Ordered $ordered, SiteRepository $siteRepository): Response
    {
        return $this->render('ordered/show.html.twig', [
            'ordered' => $ordered,
            'site' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ordered_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ordered $ordered, SiteRepository $siteRepository): Response
    {
        $form = $this->createForm(OrderedType::class, $ordered);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ordered_index');
        }

        return $this->render('ordered/edit.html.twig', [
            'ordered' => $ordered,
            'form' => $form->createView(),
            'site' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="ordered_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ordered $ordered, SiteRepository $siteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordered->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ordered);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ordered_index');
    }
}

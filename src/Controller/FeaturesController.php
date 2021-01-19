<?php

namespace App\Controller;

use App\Entity\Features;
use App\Form\FeaturesType;
use App\Repository\SiteRepository;
use App\Repository\FeaturesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/features")
 */
class FeaturesController extends AbstractController
{
    /**
     * @Route("/", name="features_index", methods={"GET"})
     */
    public function index(FeaturesRepository $featuresRepository, SiteRepository $siteRepository): Response
    {
        return $this->render('features/index.html.twig', [
            'features' => $featuresRepository->findAll(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="features_new", methods={"GET","POST"})
     */
    public function new(Request $request, SiteRepository $siteRepository): Response
    {
        $feature = new Features();
        $form = $this->createForm(FeaturesType::class, $feature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feature);
            $entityManager->flush();

            return $this->redirectToRoute('features_index');
        }

        return $this->render('features/new.html.twig', [
            'feature' => $feature,
            'form' => $form->createView(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="features_show", methods={"GET"})
     */
    public function show(Features $feature, SiteRepository $siteRepository): Response
    {
        return $this->render('features/show.html.twig', [
            'feature' => $feature,
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="features_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Features $feature, SiteRepository $siteRepository): Response
    {
        $form = $this->createForm(FeaturesType::class, $feature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('features_index');
        }

        return $this->render('features/edit.html.twig', [
            'feature' => $feature,
            'form' => $form->createView(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="features_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Features $feature, SiteRepository $siteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$feature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($feature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('features_index');
    }
}

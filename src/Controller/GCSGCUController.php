<?php

namespace App\Controller;

use App\Entity\GCSGCU;
use App\Form\GCSGCUType;
use App\Repository\SiteRepository;
use App\Repository\GCSGCURepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/gcs_gcu")
 */
class GCSGCUController extends AbstractController
{
    /**
     * @Route("/", name="g_c_s_g_c_u_index", methods={"GET"})
     */
    public function index(GCSGCURepository $gCSGCURepository, SiteRepository $siteRepository): Response
    {
        return $this->render('gcsgcu/index.html.twig', [
            'g_c_s_g_c_us' => $gCSGCURepository->findAll(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="g_c_s_g_c_u_new", methods={"GET","POST"})
     */
    public function new(Request $request, SiteRepository $siteRepository): Response
    {
        $gCSGCU = new GCSGCU();
        $form = $this->createForm(GCSGCUType::class, $gCSGCU);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gCSGCU);
            $entityManager->flush();

            return $this->redirectToRoute('g_c_s_g_c_u_index');
        }

        return $this->render('gcsgcu/new.html.twig', [
            'g_c_s_g_c_u' => $gCSGCU,
            'form' => $form->createView(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="g_c_s_g_c_u_show", methods={"GET"})
     */
    public function show(GCSGCU $gCSGCU, SiteRepository $siteRepository): Response
    {
        return $this->render('gcsgcu/show.html.twig', [
            'g_c_s_g_c_u' => $gCSGCU,
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="g_c_s_g_c_u_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GCSGCU $gCSGCU, SiteRepository $siteRepository): Response
    {
        $form = $this->createForm(GCSGCUType::class, $gCSGCU);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('g_c_s_g_c_u_index');
        }

        return $this->render('gcsgcu/edit.html.twig', [
            'g_c_s_g_c_u' => $gCSGCU,
            'form' => $form->createView(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="g_c_s_g_c_u_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GCSGCU $gCSGCU, SiteRepository $siteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gCSGCU->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gCSGCU);
            $entityManager->flush();
        }

        return $this->redirectToRoute('g_c_s_g_c_u_index');
    }
}

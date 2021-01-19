<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\InBoxType;
use App\Repository\SiteRepository;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/admin/inbox")
     */
class InBoxController extends AbstractController
{
    /**
     * @Route("/", name="admin_inbox")
     */
    public function index(SiteRepository $siteRepository, ContactRepository $contactRepository): Response
    {
        return $this->render('in_box/index.html.twig', [
            'controller_name' => 'InBoxController',
            'sites' => $siteRepository->findAll(),
            'contacts'=>$contactRepository->findAll(),
        ]);

    }
    /**
     * @Route("/{id}", name="inbox_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_inbox');
    }
}

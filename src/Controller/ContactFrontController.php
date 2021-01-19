<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFrontType;
use App\Repository\SiteRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactFrontController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(SiteRepository $siteRepository, CategoriesRepository $categoriesRepository, Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFrontType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $contact->setReply(null);

             $em = $this->getDoctrine()->getManager();
             $em->persist($contact);
             $em->flush();
        }

        return $this->render('contact_front/index.html.twig', [
            'controller_name' => 'ContactFrontController',
            'sites' => $siteRepository->findAll(),
            'categories' => $categoriesRepository->findAll(),
            'contact' => $form->createView(),
        ]);
    }
}

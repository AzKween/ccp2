<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Kinds;
use App\Form\ContactFrontType;
use App\Repository\SiteRepository;
use App\Repository\ArticlesRepository;
use App\Repository\FeaturesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\KindsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(CategoriesRepository $categoriesRepository, KindsRepository $kindsRepository, SiteRepository $siteRepository, Request $request, PaginatorInterface $paginator, ArticlesRepository $articlesRepository, FeaturesRepository $featuresRepository): Response
    {
        $pagination = $paginator->paginate(
            $articlesRepository->findAllOrgerByDate(),
            $request->query->get('page', 1), 
            3);
        
        $pagination1 = $paginator->paginate(
            $featuresRepository->findAllOrgerByDate(),
            $request->query->get('page', 1),
            3);

        $pagination2 = $paginator->paginate(
            $kindsRepository->findAll(),
            $request->query->get('page', 1),
            2);

        $contact = new Contact();
        $form = $this->createForm(ContactFrontType::class, $contact);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()){
    
            $contact->setReply(null);
    
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
        }

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'sites' => $siteRepository->findAll(),
            'articles' => $pagination,
            'categories' => $categoriesRepository->findAll(),
            'features' => $pagination1,
            'contact' => $form->createView(),
            'kind'=>$pagination2,
            'kinds' => $kindsRepository->findAll(),
        ]);
    }
}
<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\FeaturesRepository;
use App\Repository\SiteRepository;
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
    public function index(CategoriesRepository $categoriesRepository, SiteRepository $siteRepository, Request $request, PaginatorInterface $paginator, ArticlesRepository $articlesRepository, FeaturesRepository $featuresRepository): Response
    {
        $pagination = $paginator->paginate(
            $articlesRepository->findAllOrgerByDate(),
            $request->query->get('page', 1), 
            3);
        
        $pagination1 = $paginator->paginate(
            $featuresRepository->findAllOrgerByDate(),
            $request->query->get('page', 1),
            3

        );


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'sites' => $siteRepository->findAll(),
            'articles' => $pagination,
            'categories' => $categoriesRepository->findAll(),
            'features' => $pagination1,
        ]);
    }
}

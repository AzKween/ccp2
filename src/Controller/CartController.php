<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\SiteRepository;
use App\Repository\KindsRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/profile/cart", name="cart")
     */
    public function index(CategoriesRepository $categoriesRepository, KindsRepository $kindsRepository, SiteRepository $siteRepository, ArticlesRepository $articlesRepository): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'sites' => $siteRepository->findAll(),
            'categories' => $categoriesRepository->findAll(),
            'kinds' => $kindsRepository->findAll(),
            'articles' => $articlesRepository->findAll(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\SiteRepository;
use App\Repository\FeaturesRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelpController extends AbstractController
{
    /**
     * @Route("/help", name="help")
     */
    public function index(SiteRepository $siteRepository, CategoriesRepository $categoriesRepository, FeaturesRepository $featuresRepository): Response
    {
        return $this->render('help/index.html.twig', [
            'controller_name' => 'HelpController',
            'sites' => $siteRepository->findAll(),
            'categories' => $categoriesRepository->findAll(),
            'features' => $featuresRepository->findAll()
        ]);
    }
}

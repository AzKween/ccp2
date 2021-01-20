<?php

namespace App\Controller;

use App\Repository\SiteRepository;
use App\Repository\KindsRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(SiteRepository $siteRepository, KindsRepository $kindsRepository, CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'sites' => $siteRepository->findAll(),
            'categories' => $categoriesRepository->findAll(),
            'kinds' => $kindsRepository->findAll(),
        ]);
    }
}
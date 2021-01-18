<?php

namespace App\Controller;

use App\Repository\SiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(SiteRepository $siteRepository): Response
    {
        $site = $siteRepository->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'sites' => $siteRepository->findAll(),
        ]);
    }
}

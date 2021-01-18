<?php

namespace App\Controller;

use App\Repository\SiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminMainController extends AbstractController
{
    /**
     * @Route("/admin/main", name="admin_main")
     */
    public function index(SiteRepository $siteRepository): Response
    {
        return $this->render('admin_main/index.html.twig', [
            'controller_name' => 'AdminMainController',
            'sites' => $siteRepository->findAll(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\SiteRepository;
use App\Repository\KindsRepository;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    /**
     * @Route("/articles")
     */
class ArticlesFrontController extends AbstractController
{
    /**
     * @Route("/kind/{kind}", name="articles_kinds", methods={"GET"})
     */
    public function index(int $kind, CategoriesRepository $categoriesRepository, KindsRepository $kindsRepository, SiteRepository $siteRepository, ArticlesRepository $articlesRepository , Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $articlesRepository->findBy(array('Relation_kinds' => $kind )),
            $request->query->get('page', 1), 
            12);

        return $this->render('articles_front/index.html.twig', [
            'controller_name' => 'ArticlesFrontController',
            'sites' => $siteRepository->findAll(),
            'categories' => $categoriesRepository->findAll(),
            'articles'=>$pagination,
            'kinds' => $kindsRepository->findAll(),
        ]);
    }
    /**
     * @Route("/category/{category}", name="articles_category", methods={"GET"})
     */
    public function category(int $category, CategoriesRepository $categoriesRepository, KindsRepository $kindsRepository, SiteRepository $siteRepository, ArticlesRepository $articlesRepository , Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $articlesRepository->findBy(array('categories'=> $category )),
            $request->query->get('page', 1), 
            12);

        return $this->render('articles_front/index.html.twig', [
            'controller_name' => 'ArticlesFrontController',
            'sites' => $siteRepository->findAll(),
            'categories' => $categoriesRepository->findAll(),
            'articles'=>$pagination,
            'kinds' => $kindsRepository->findAll(),
        ]);
    }
}

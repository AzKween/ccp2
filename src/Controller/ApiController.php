<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Cart;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /** 
     * @Route("/api")
     */
class ApiController extends AbstractController
{
    /**
     * @Route("/cart/", name="api")
     */
    public function index(): JsonResponse
    {
        $obj = new \stdClass();
        $em = $this->getDoctrine()->getManager();
        $CartRepo = $em->getRepository(Cart::class);
        $CartLists = $CartRepo->findAll();
        $arr = [];
        foreach ($CartLists as $Cart) {
            $temp = new \stdClass();
            $temp->Id = $Cart->getId();
            $temp->Articles = $Cart->getArticles();
            $temp->Price = $Cart->getPrice();
            array_push($arr, $temp);
        }
        $obj->Cart = $arr;
        return new JsonResponse($obj);
    }

    /**
     * @Route("/new/", name="new_article", methods={"POST"})
     * @param Request $request
     */
    public function addArticles(Request $request)
    {
        $obj = new \stdClass();
        $article = $request->request->get("Articles");
        $price = $request->request->get("Price");
        $cart = new Cart();
        $cart->setArticles($article);
        $cart->setPrice($price);
        $em = $this->getDoctrine()->getManager();
        $em->persist($cart);
        $em->flush();
        

        return new JsonResponse($obj);
    }
}

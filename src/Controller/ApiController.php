<?php

namespace App\Controller;

use App\Entity\Cart;
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
            $temp->Total = $Cart->getTotal();
            array_push($arr, $temp);
        }
        $obj->Cart = $arr;
        return new JsonResponse($obj);
    }
}

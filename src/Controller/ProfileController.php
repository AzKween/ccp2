<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\SiteRepository;
use App\Repository\KindsRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
    /**
     * @Route("/profile/edit/{id}", name="profile_edit")
     */
    public function edit(Request $request, SiteRepository $siteRepository, User $user, KindsRepository $kindsRepository, CategoriesRepository $categoriesRepository, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setpassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                ));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile');
        }
        return $this->render('profile/edit.html.twig', [
            'controller_name' => 'ProfileController',
            'user' =>$user,
            'ProfileForm' => $form->createView(),
            'sites' => $siteRepository->findAll(),
            'categories' => $categoriesRepository->findAll(),
            'kinds' => $kindsRepository->findAll(),
        ]);
    }
}
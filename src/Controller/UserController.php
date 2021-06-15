<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/user/profil/modifier", name="user_profil_modifier")
     */
    public function editProfile(Request $request)
    {   
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush(); 

            $this->addFlash('message', 'Profil mis à jour !');
            return $this->redirectToRoute('user');

        }

        return $this->render('user/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

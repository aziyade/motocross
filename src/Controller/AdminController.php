<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
        /**
     * @Route("/admin/add-event", name="admin_add_event")
     */
    public function addEvent(): Response
    {
        return $this->render('admin/add_event.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
            /**
     * @Route("/admin/add-user", name="admin_add_user")
     */
    public function addUser(): Response
    {
        
        
        return $this->render('admin/add_user.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

     /**
     * @Route("/admin/liste-user", name="admin_liste_user")
     */
    public function listeUser(UserRepository $repo): Response
    {
        
        
        return $this->render('admin/liste_user.html.twig', [
            'users' => $repo->findAll(),
        ]);
    }

     /**
     * @Route("/admin/add-event", name="admin_add_event")
     */
    public function ListeEvent(EventRepository $repo): Response
    {
        
        
        return $this->render('admin/add_event.html.twig', [
            'events' => $repo->findAll(),
        ]);
    }


    /**
     * @Route("/admin/add-event", name="admin_add_event")
     */
    public function registerEvent(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(RegistrationFormType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $event->setTypes(['TYPE_EVENT']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }
    }
}

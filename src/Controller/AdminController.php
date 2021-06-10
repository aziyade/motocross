<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\UserRepository;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function addEvent(Request $request, ManagerRegistry $managerRegistry, EntityManagerInterface $em ): Response
    {
        $event = new Event();

        // Crée le formulaire
        $form = $this->createForm(EventType::class, $event);
        // Prend en charge les données du formulaire
        $form->handleRequest($request);
        // Vérifications
        if($form->isSubmitted() && $form->isValid()){
            // Persiste
            $em->persist($event);
            // Envoie en base de donnée
            $em->flush();
            // Redirige à la liste des addEvent
            return $this->redirectToRoute('admin_liste_event');
        }
        return $this->render('admin/add_event.html.twig', [
            'eventForm' => $form->createView() 
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
     * @Route("/admin/admin-liste-event", name="admin_liste_event")
     */
    public function ListeEvent(EventRepository $repo): Response
    {
        
        
        return $this->render('event/index.html.twig', [
            'events' => $repo->findAll(),
        ]);
    }


    /**
     * @Route("/admin/add-event", name="admin_add_event")
     */
  /*  public function registerEvent(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $event->setTypes(['TYPE_EVENT']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }
    }*/
}

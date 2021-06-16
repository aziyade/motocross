<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Event;
use App\Form\EventType;
use App\Repository\UserRepository;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\All;

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
     * @Route("/admin/delete-event/{id}", name="event_delete", methods={"POST"})
     * 
     */
    /*
        public function deleteEvent(Request $request, Event $event): Response
        {
            $event = new Event();
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();

            return $this->redirectToRoute('event_index');
            return new Response('événement supprimé');
        }
*/

/**
     * @Route("/admin/event/delete/{event}",name="admin_event_delete")
     */
    public function deleteEvent(Event $event, EntityManagerInterface $em)
    {
        $builder = $this->createFormBuilder();
        $builder->add('Valider', SubmitType::class);

        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('admin_liste_event');
    }




/**
     * @Route("/admin/event/change/{event}",name="admin_event_change")
     */

    public function editEvent( Request $request, EntityManagerInterface $em,  Event $event): Response
    {
       
        // on associe le bo au formulaire
        $form = $this->createForm(EventType::class, $event);
        // traiter le formulaire
        // je viens hydrater l'objet $personne
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){  //si le form est envoyé et si valide
           $message = "L'événement a été modifié : ".$event->getTitre();
            $this->addFlash('success' ,$message);
            $em->flush();
            return $this->redirectToRoute('admin_liste_event'); 
        }

       return $this->render('admin/edit_event.html.twig',[
            'eventForm' => $form->createView()
        ]);
    }

/**
     * @Route("/admin/event/view/{event}",name="admin_event_users")
     */

    public function vueUserInEvent( Event $event): Response
    {
       
   
       return $this->render('event/event_detail.html.twig',[
            'event' => $event
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
     * @Route("/admin/user/delete/{user}",name="admin_user_delete")
     */
    public function deleteUser(User $user, EntityManagerInterface $em)
    {
        $builder = $this->createFormBuilder();
        $builder->add('Valider', SubmitType::class);

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_liste_user');
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

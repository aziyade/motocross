<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Event;
use App\Entity\Inscription;
use App\Form\EventType;
use App\Repository\UserRepository;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;


class EventController extends AbstractController
{
    /**
     * @Route("/add-event", name="add_event")
     */
    
 
    /**
     * @Route("/choose/event/{user}/{type}", name="inscription_event")
     */
    public function inscriptionEvent(User $user, EventRepository $repoE, EntityManagerInterface $em, $type ): Response
    {
        //but: inscrire un user à un event

        $evenement = $repoE->recuEventByType($type); //appelle la fct du repoEvent
      // dd($evenement); // pour voir ce qui se passe = console
        //on suppose que les courses passées sont enlevées par l'admin
        //dd($evenement[0]);  //voir le 1er event du tableau = date la plus proche
       
      
        //requete sql: INSERT INTO inscription (event_id, user_id, dateinscription) VALUES (11, 1, '2021-06-14');

        $inscription = NEW Inscription;
        $inscription->setEvent($evenement[0])
            ->setUser($user) // user car on veut tout l'objet user
            ->setDateinscription(NEW \DateTime());

        $em->persist($inscription);
            // Envoie en base de donnée
        $em->flush();
            // Redirige à la liste des addEvent
        $this->addFlash("success", "Félicitation vous êtes inscrits");

        return $this->redirectToRoute('choose_event'); 
    }


         /**
     * @Route("admin/{id}", name="inscription_delete", methods={"DELETE"})
     */
    public function desinscriptionEvent(User $user, EventRepository $repoE, EntityManagerInterface $em, $type ): Response
    {

        $evenement = $repoE->recuEventByType($type); 

        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inscription_index');
    }


}

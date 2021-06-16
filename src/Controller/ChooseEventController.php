<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Entity\Inscription;
class ChooseEventController extends AbstractController
{
    /**
     * @Route("/choose/event", name="choose_event")
     */
    public function index(EventRepository $repoE): Response
    {
        
        
        $user = $this->getUser();

               
        $date = $user->getdatenaissance();
        $date2 = new \DateTime();
        $interval  = date_diff($date2,$date);

        
        //
        $age= $interval->format('%y') ;


        if ($age <= 17)
        {
            
            $events = $repoE->recuEventByType('junior'); //appelle la fct du repoEvent
            
        }else{

            $events = $repoE->recuEventByType('adulte'); //appelle la fct du repoEvent
        }

        //dd($events[0].getInscription());
        //create tab($events[0]->getInscription());
        $tab = $events[0]->getInscription();
        $i =0;
        $position =0;
       foreach($tab as $ins){ // va lire toutes les lignes du tableau une by une
        $i++;   
        //dump($ins->getUser()->getId()); 
        //si l'utilisateur est dans la liste:
        if ($ins->getUser()->getId()== $user->getId())
        {
            $position=$i;
        }
       }
        return $this->render('choose_event/index.html.twig', [
            'controller_name' => 'ChooseEventController',
            'age' => $age,
            'position' => $position,


            'event'=> $events[0]
        ]);
    }

/*
    public function age($datenaissance): 
    {
        $datenaissance = $datenaissance->getdatenaissance();
         $age = date('Y') - $datenaissance; 
           if (date('md') < date('md', strtotime($datenaissance))) { 
               return $age - 1; 
           } 
           return $age; 
       } 

    }
*/


}

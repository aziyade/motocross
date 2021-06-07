<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChooseEventController extends AbstractController
{
    /**
     * @Route("/choose/event", name="choose_event")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $date = $user->getdatenaissance();
        $date2 = new \DateTime();
        $interval  = date_diff($date2,$date);

        
        //
        $age= $interval->format('%y') ;
       
        return $this->render('choose_event/index.html.twig', [
            'controller_name' => 'ChooseEventController',
            'age' => $age
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

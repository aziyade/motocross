<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;

class HomeController extends AbstractController
{



    /**
     * @Route("/", name="index")
     */
    public function test( EventRepository $repoE ): Response
    {
        //but: inscrire un user à un event

        $event_adulte = $repoE->recuEventByType('adulte'); //appelle la fct du repoEvent

        $event_junior = $repoE->recuEventByType('junior'); //appelle la fct du repoEvent
      // dd($evenement); // pour voir ce qui se passe = console
        //on suppose que les courses passées sont enlevées par l'admin
        //dd($evenement[0]);  //voir le 1er event du tableau = date la plus proche
    
      
        //requete sql: INSERT INTO inscription (event_id, user_id, dateinscription) VALUES (11, 1, '2021-06-14');

        return $this->render('home/index.html.twig', [
            'event_adulte' => $event_adulte[0],
            'event_junior' => $event_junior[0]
        ]);
        
    }

}

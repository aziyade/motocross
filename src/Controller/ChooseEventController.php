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
        return $this->render('choose_event/index.html.twig', [
            'controller_name' => 'ChooseEventController',
        ]);
    }
}

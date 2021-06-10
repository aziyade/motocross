<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifierprofilController extends AbstractController
{
    /**
     * @Route("/modifierprofil", name="modifierprofil")
     */
    public function index(): Response
    {
        return $this->render('modifierprofil/index.html.twig', [
            'controller_name' => 'ModifierprofilController',
        ]);
    }
}

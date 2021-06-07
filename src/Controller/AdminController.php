<?php

namespace App\Controller;

use App\Repository\UserRepository;
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
}

<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController {

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(){
        return $this->render(
            'dashboard/admin.html.twig'
        );
    
    }
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(){
        return $this->render(
            'dashboard/dashboard.html.twig',
            ['title' => 'Bonjour utilisateur']
        );
    }
}

?>
<?php

namespace App\Controller;

use App\Entity\Cap;
use App\Repository\CapRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     */
    public function home(CapRepository $repo)
    {
        $caps = $repo->findByCreatedCapsAndOrder(4, 'DESC');

        return $this->render('home.html.twig', [
            'caps' => $caps
        ]);
    }
}

?>
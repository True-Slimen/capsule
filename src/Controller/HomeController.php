<?php

namespace App\Controller;

use App\Entity\Cap;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function home()
    {
        $repo = $this->getDoctrine()->getRepository(Cap::class);

        $caps = $repo->findAll();

        return $this->render('home.html.twig', [
            'caps' => $caps
        ]);
    }
}

?>
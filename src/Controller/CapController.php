<?php

namespace App\Controller;

use App\Repository\CapRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CapController extends Controller {

    /**
     * @Route("/capsules", name="cap")
     */
    public function caps(CapRepository $repo)
    {
        $caps = $repo->findAll();

        return $this->render('caps.html.twig', [
            'caps' => $caps
        ]);
    }

    /**
     * Permet d'afficher une seule capsule
     *
     * @Route("/capsules/{name}/", name="cap_show")
     * 
     * @return Response
     */
    public function show($name, CapRepository $repo)
    {
        $cap = $repo->findOneByName($name);

        return $this->render('cap.html.twig', [
            'cap' => $cap
        ]);
    }
}

?>
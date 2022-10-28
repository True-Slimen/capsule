<?php

namespace App\Controller;

use App\Entity\Cap;
use App\Entity\Brewery;
use App\Repository\CapRepository;
use App\Repository\BreweryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BreweryController extends Controller {

    /**
     * Permet d'afficher une seule brasserie
     *
     * @Route("/brewery/{id}/", name="brewery_show")
     * 
     * @return Response
     */
    public function show($id, BreweryRepository $repo)
    {
        $brewery = $repo->findOneByName($id);

        return  $brewery;
    }
}

?>
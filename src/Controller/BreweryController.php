<?php

namespace App\Controller;

use App\Entity\Cap;
use App\Form\BrewType;
use App\Entity\Brewery;
use App\Repository\CapRepository;
use App\Repository\BreweryRepository;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * Créer une brasserie
     * 
     * @Route("/dashboard/", name="brewery_create")
     * 
     * @return Response
     */
    // public function create(Request $request): Response
    // {
    //     $brewery = new Brewery();
    //     $brewForm = $this->createForm(BrewType::class, $brewery);
    //     $brewForm->handleRequest($request);
        
    //     if ($brewForm->isSubmitted() && $brewForm->isValid()) {
    //         $brewery = $brewForm->getData();
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($brewery);
    //         $entityManager->flush();

    //         $this->addFlash(
    //             'success',
    //             "Le producteur <strong>{$brewery->getName()}</strong> a été ajouté."
    //         );
            

    //     }else if($brewForm->isSubmitted() && $brewForm->isValid() == false){
    //         $this->addFlash(
    //             'danger',
    //             "La capsule n'a pas pu être ajoutée."
    //         );
    //     }

    //     return $this->render('dashboard/dashboard.html.twig', [
    //         'formi' => $brewForm->createView()
    //     ]);
    // }
}

?>
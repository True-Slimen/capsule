<?php

namespace App\Controller;

use App\Entity\Cap;
use App\Form\CapType;
use App\Entity\Brewery;
use App\Repository\CapRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CapController extends AbstractController {

    /**
     * @Route("/caps", name="cap")
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
     * @Route("/caps/{name}/", name="cap_show")
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
    
    /**
     * Créer une annon
     * 
     * @Route("/dashboard/", name="caps_create")
     * 
     * @return Response
    */
    public function create(Request $request): Response
    {
        $cap = new Cap();
        $form = $this->createForm(CapType::class, $cap);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $cap_picture */
            $capPicture = $form->get('picture_path')->getData();

            if ($capPicture) {
                $originalFilename = pathinfo($capPicture->getClientOriginalName(), PATHINFO_FILENAME);
                var_dump($originalFilename);

                $safeFilename = $form->get('name')->getData();
                $newFilename = $safeFilename.'-'.uniqid().'.'.$capPicture->guessExtension();

                // Move the file to the directory where cap are stored
                try {
                    $capPicture->move(
                        $this->getParameter('capsules_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    var_dump($e->getMessage());
                }

                // updates the 'picture_path' property to store the PDF file name
                // instead of its contents
                $cap->setPicturePath($newFilename);
            }

            $cap= $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cap);
            $entityManager->flush();
            //return new Response('News cap successfuly');
        }

        return $this->render('dashboard/dashboard.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

?>
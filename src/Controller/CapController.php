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
     * Créer une capsule
     * 
     * @Route("/dashboard/", name="caps_create")
     * 
     * @return Response
    */
    // TODO migrer cette fonction dans dashboardController
    public function create(Request $request): Response
    {   
        $cap = new Cap();
        $form = $this->createForm(CapType::class, $cap);

        if($request->request->get('cap') !== null){
            $form->handleRequest($request);

            //$errors = $form->getErrors();
            
            if ($form->isSubmitted() && $form->isValid()) {
                /** @var UploadedFile $cap_picture */

            // Process picture name to bind it with the correct path in databse
            // Params =  (picturePath, cap name)
                $cap->setPicturePath($this->persistPicture($form->get('picture_path')->getData(), $form->get('name')->getData()));

                $cap= $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cap);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    "La capsule <strong>{$cap->getName()}</strong> numéro {$cap->getCotation()} a été ajouté."
                );
                

            }else if($form->isSubmitted() && $form->isValid() == false){
                $this->addFlash(
                    'danger',
                    "La capsule n'a pas pu être ajoutée."
                );
            }
        }else if($request->request->get('name') !== null){
            $brewery = new Brewery();
            $name = $this->securityString($request->request->get('name'));
            $brewery->setName($name);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($brewery);
            $entityManager->flush();
        }
        
        
        return $this->render('dashboard/dashboard.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function securityString($str)
    {
        $str = trim($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    private function persistPicture($capPicture, $safeFilename)
    {
        if ($capPicture) {
            $originalFilename = pathinfo($capPicture->getClientOriginalName(), PATHINFO_FILENAME);

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

            // updates the 'picture_path' property to store the caps file name
            // instead of its contents
            return $newFilename;
        }
    }
}

?>
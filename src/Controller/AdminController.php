<?php

namespace App\Controller;

use App\Form\AccountType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * Permet la connexion
     * 
     * @Route("/login", name="admin_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils) : Response
    {
        $error = $utils->getLastAuthenticationError();

        $username = $utils->getLastUsername();

        return $this->render('dashboard/admin/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet la déconnexion
     * 
     * @Route("/logout", name="admin_logout")
     *
     * @return Response
     */
    public function logout()
    {
        return $this->render('dashboard/admin/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de modifier le profil utilisateur
     * 
     * @Route("dashboard/profil", name="admin_profil")
     * 
     * @return Response
     */
    public function profile(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $newPassword = password_hash($data->newPassword, PASSWORD_BCRYPT);
            
            $user->setPassword($newPassword);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('dashboard/admin/profil.html.twig', [
            'form' => $form->createView()
        ]);
    }
}



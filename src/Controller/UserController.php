<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\User\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(Request $request, UserManager $userManager, EntityManagerInterface $entityManager)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $entityManager->persist($user);
            $entityManager->flush();
        }
        $users = $userManager->getAllUsers();
        return $this->render('user/index.html.twig', [
            'form' => $form,
            'users' => $users,
        ]);
    }
}

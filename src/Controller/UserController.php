<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'app_user')]
    public function index(EntityManagerInterface $entityManager, $id): Response
    {
        $id = (int) $id;
        $user = $entityManager->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException('The user is not found');
        }

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/user/{id}/picture', name: 'app_user_picture')]
    public function edit(EntityManagerInterface $entityManager, $id): Response
    {
        $id = (int) $id;
        $user = $entityManager->getRepository(User::class)->find($id);

        return $this->render('user/profile-picture.html.twig', [
            'user' => $user,
        ]);
    }
}

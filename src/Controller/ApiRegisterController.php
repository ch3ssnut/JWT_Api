<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApiRegisterController extends AbstractController
{
    #[Route('/api/register', name: 'app_api_register')]
    public function index(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $hasher): JsonResponse
    {
        $registrationData = json_decode($request->getContent(), true);
        
        if (array_key_exists('username', $registrationData)  && array_key_exists('password', $registrationData)) {
            $username = $registrationData['username'];
            $password = $registrationData['password'];
        } else {
            return new JsonResponse('Wrong credentials', 400);
        }

        if ($em->getRepository(User::class)->findOneBy(['username' => $username])) {
            return new JsonResponse('User already exists', 400);
        }
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($hasher->hashPassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new JsonResponse(sprintf('%s was created.', $username), 200);
    }
}

<?php

namespace App\Controller;

use App\Entity\RefreshToken;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ApiLogoutController extends AbstractController
{
    #[Route('/api/token/invalidate', name: 'logout')]
    public function index(JWTTokenManagerInterface $jwt, TokenStorageInterface $tokenStorageInterface, EntityManagerInterface $entityManager): JsonResponse
    {
        $username = ($jwt->decode($tokenStorageInterface->getToken())['username']);
        
        $token = $entityManager->getRepository(RefreshToken::class)->findBy([
            "username" => $username,
        ]);

        foreach ($token as $t) {
            $entityManager->remove($t);
        }
        $entityManager->flush();

        return $this->json([
            'message' => sprintf('%s was logged out', $username),
        ]);
        

    }
}

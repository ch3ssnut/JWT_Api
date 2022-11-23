<?php

namespace App\Controller;

use App\Entity\RefreshToken;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;


class ApiLogoutController extends AbstractController
{
    #[Route('/api/token/invalidate', name: 'logout', methods: ["POST"])]
    /**
    * @OA\Parameter(
        *     name="Authorization",
        *     in="header",
        *     description="Bearer {token}",
        *     required=true
        * )
       * 
       * @OA\Response(
       *      response= 200,
       *      description= "User was logged out and his refresh tokens were removed",
       *      )
       * )
       * 
       * @OA\Response(
       *      response= 400,
       *      description= "Token is expired/invalid",
       *      )
       * )
       */
    public function index(JWTTokenManagerInterface $jwt, TokenStorageInterface $tokenStorageInterface, EntityManagerInterface $entityManager): JsonResponse
    {
        // decodes token to get username 
        $username = ($jwt->decode($tokenStorageInterface->getToken())['username']);
        
        // and entityManager is used to fetch all refresh tokens where owner is current user, and deletes them. 
        $token = $entityManager->getRepository(RefreshToken::class)->findBy([
            "username" => $username,
        ]);

        foreach ($token as $t) {
            $entityManager->remove($t);
        }
        $entityManager->flush();

        return $this->json([
            'code' => "200",
            'message' => sprintf('%s was logged out', $username),
        ]);
        

    }
}

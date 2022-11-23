<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class ApiProtectedController extends AbstractController
{
    #[Route('/api', name: 'app_api_protected', methods: ["POST"])]
    /** 
    * 
    * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Bearer {token}",
     *     required=true
     * )
    * 
    * @OA\Response(
    *      response= 200,
    *      description= "Token is valid",
    *      )
    * )
    * @OA\Response(
    *      response= 400,
    *      description= "Token is expired/invalid",
    *      )
    * )
    *
    * 
    */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Access to protected Api',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_api_login', methods: ['POST'])]
    /** 
     * @OA\RequestBody(
     *      description="Input user data as username and password",
     *      @Oa\JsonContent(
     *          @Oa\Property(type="string",property="username"),
     *          @Oa\Property(type="string",property="password"),
     *      )
     * )
     * 
     * 
     * @OA\Response(
     *      response= 200,
     *      description= "User is logged in tokens are returned as JSON",
     *      @Oa\JsonContent(
     *          @Oa\Property(type="string",property="token"),
     *          @Oa\Property(type="string",property="refresh_token"),
     *      )
     * )
     *        
     * @OA\Response(
     *      response= 401,
     *      description= "Ivalid credentials",
     *      )
     * )
     *
     * 
     * 
     * 
     */
    public function index(): void
    {
        
    }
}

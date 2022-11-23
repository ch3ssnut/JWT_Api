<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class ApiTokenRefreshController extends AbstractController
{
    #[Route('/api/refresh/token', name: 'app_api_token_refresh', methods: ["POST"])]
    /** 
     * @Oa\RequestBody(
     *      description="Input refresh token to get new JWT token",
     *      @Oa\JsonContent(
     *          @Oa\Property(type="string",property="refresh_token"),
     *      )
     * )
     * 
     * 
     * @OA\Response(
     *      response= 200,
     *      description= "refresh token is valid, new JWT token and refresh_token are returned as JSON",
     *      @Oa\JsonContent(
     *          @Oa\Property(type="string",property="token"),
     *          @Oa\Property(type="string",property="refresh_token"),
     *      )
     * )
     *        
     * @OA\Response(
     *      response= 400,
     *      description= "Invalid/expired token",
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

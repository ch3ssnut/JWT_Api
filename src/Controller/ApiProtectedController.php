<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiProtectedController extends AbstractController
{
    #[Route('/api', name: 'app_api_protected')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Access to protected Api',
        ]);
    }
}

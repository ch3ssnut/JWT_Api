<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

class ApiRegisterController extends AbstractController
{
    #[Route('/api/register', name: 'app_api_register', methods: ["POST"])]
    /** 
     * @Oa\RequestBody(
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
     *      description= "User was created",
     *      )
     * )
     *        
     * @OA\Response(
     *      response= 400,
     *      description= "User already exists/Wrong credentials",
     *      )
     * )
     *
     * 
     * 
     * 
     */
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

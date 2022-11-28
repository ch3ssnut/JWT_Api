<?php

namespace App\EventListener;

use App\Entity\RefreshToken;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;

/**
 * JWTDecodedListener
 *
 */
class JWTDecodedListener
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param JWTDecodedEvent $event
     *
     * @return void
     */
    public function onJWTDecoded(JWTDecodedEvent $event)
    {

        if (!$event) {
            return;
        }
        
        $payload = $event->getPayload();



        $refreshToken = $this->entityManager->getRepository(RefreshToken::class)->findBy([
            "username" => $payload["username"],
        ]);

        if (!$refreshToken) {
            $event->markAsInvalid();
            return;
        }

        dd($refreshToken);

        $refreshTokenDate = $refreshToken[0]->getValid();
        $refreshTokenDate->modify("-30 day");

        $refreshTokenDate = intval($refreshTokenDate->format("U"));
        $tokenDate = ($payload["iat"]);

        if ($tokenDate < $refreshTokenDate) {
            $event->markAsInvalid();
        }
    }
}
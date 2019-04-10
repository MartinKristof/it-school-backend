<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class LoginController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/login", methods={"POST"})
     */
    public function isUserRegisteredAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->userRepository->getUserByUsername($data['username']);
        $isPasswordVerified = $user->verifyPassword($data['password']);

        if (!$isPasswordVerified) {
            throw new BadCredentialsException();
        }

        return $this->json($user->getApiKey());
    }
}

<?php
// src/Controller/AuthController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

class AuthController extends AbstractController
{


    #[IsGranted('ROLE_USER')]
    #[Route('/api/check', name: 'api_check')]
    public function check() : JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return new JsonResponse([
            'message' => 'Valid JWT Token',
            'user' => $this->getUser()->getUserIdentifier()
        ]);
    }
}

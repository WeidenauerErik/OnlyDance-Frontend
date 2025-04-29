<?php

namespace App\Controller;

use App\Entity\Checklist;
use App\Entity\Stepsequence;
use App\Entity\User;
use App\Repository\ChecklistRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ChecklistController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route("/checklist/add", name: 'app_checklist_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $data = json_decode($request->getContent(), true);
        if (!isset($data['name'], $data['stepsequences'])) {
            return new JsonResponse(['error' => 'Missing required fields'], 400);
        }


        $checklist = new Checklist();
        foreach ($data["stepsequences"] as $stepsequenceID) {
            $stepsequence = $entityManager->getRepository(Stepsequence::class)->find($stepsequenceID);
            if ($stepsequence) {
                $checklist->addStepsequence($stepsequence);
            } else {
                return new JsonResponse(["error" => "a stepsequence ID cant be found in the database"]);
            }

        }


        $checklist->setName($data['name']);
        $checklist->setUserId($user);

        $entityManager->persist($checklist);
        $entityManager->flush();


        return new JsonResponse(["status" => "successfully created checklist"], 201);
    }

    #[IsGranted('ROLE_USER')]
    #[Route("/checklist/user/get", name: 'app_checklist_user', methods: ['GET'])]
    public function getUserChecklists(SerializerInterface $serializer, UserRepository $userRepository): JsonResponse {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $jwtUser = $this->getUser();

        $user = $userRepository->findOneBy(['email' => $jwtUser->getUserIdentifier()]);

        $response = $serializer->serialize(
            $user->getChecklists(),
            "json",
            ['groups' => ['checklist:read']]
        );



        return JsonResponse::fromJsonString($response);     }

    #[Route("/checklist/get", name: 'app_checklist_get', methods: ['GET'])]
    public function getChecklists(SerializerInterface $serializer, ChecklistRepository $checklistRepository): JsonResponse {


        $checklist = $checklistRepository->findAll();

        $response = $serializer->serialize(
            $checklist,
            "json",
            ['groups' => ['checklist:read']]
        );



        return JsonResponse::fromJsonString($response);    }

}



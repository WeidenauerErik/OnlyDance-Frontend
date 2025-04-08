<?php

namespace App\Controller;

use App\Entity\Badge;
use App\Entity\Dance;
use App\Entity\Step;
use App\Entity\Stepsequence;
use App\Repository\StepsequenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StepsequenceStepController extends AbstractController
{


    #[Route('/stepsequence/add', name: 'app_stepsequence_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['dance_id'], $data['badge_id'], $data['name'], $data['steps'])) {
            return new JsonResponse(['error' => 'Missing required fields'], 400);
        }

        $stepsequence = new Stepsequence();
        $dance = $entityManager->getRepository(Dance::class)->find($data['dance_id']);
        $badge = $entityManager->getRepository(Badge::class)->find($data['badge_id']);

        if (!$dance || !$badge) {
            return new JsonResponse(['error' => 'Invalid dance_id or badge_id'], 400);
        }
        $stepsequence->setDance($dance);
        $stepsequence->setBadge($badge);
        $stepsequence->setName($data["name"]);


        foreach ($data['steps'] as $stepData) {
            $step = new Step();

            $step->setHowquick($stepData['howquick']);

            $step->setM1X($stepData['m1_x']);
            $step->setM1Y($stepData['m1_y']);
            $step->setM1Rotate($stepData['m1_rotate']);
            $step->setM1Heel($stepData['m1_heel']);
            $step->setM1Toe($stepData['m1_toe']);

            $step->setM2X($stepData['m2_x']);
            $step->setM2Y($stepData['m2_y']);
            $step->setM2Rotate($stepData['m2_rotate']);
            $step->setM2Heel($stepData['m2_heel']);
            $step->setM2Toe($stepData['m2_toe']);

            $step->setW1X($stepData['w1_x']);
            $step->setW1Y($stepData['w1_y']);
            $step->setW1Rotate($stepData['w1_rotate']);
            $step->setW1Heel($stepData['w1_heel']);
            $step->setW1Toe($stepData['w1_toe']);

            $step->setW2X($stepData['w2_x']);
            $step->setW2Y($stepData['w2_y']);
            $step->setW2Rotate($stepData['w2_rotate']);
            $step->setW2Heel($stepData['w2_heel']);
            $step->setW2Toe($stepData['w2_toe']);

            $stepsequence->addHowquick($step);

            $entityManager->persist($step);

        }

        $entityManager->persist($stepsequence);
        $entityManager->flush();
        return new JsonResponse(['status' => 'Dance and steps saved'], 201);
    }

    #[Route('/stepsequence/get/{id}', name: 'app_step_byID', methods: ['GET'])]
    public function getStepsequenceByID( Stepsequence $stepsequence) :JsonResponse
    {
        $steps = [];
        foreach ($stepsequence->getHowquick() as $step) {
            $steps[] = [
                'howquick' => $step->getHowquick(),

                'm1_x' => $step->getM1X(),
                'm1_y' => $step->getM1Y(),
                'm1_rotate' => $step->getM1Rotate(),
                'm1_heel' => $step->isM1Heel(),
                'm1_toe' => $step->isM1Toe(),

                'm2_x' => $step->getM2X(),
                'm2_y' => $step->getM2Y(),
                'm2_rotate' => $step->getM2Rotate(),
                'm2_heel' => $step->isM2Heel(),
                'm2_toe' => $step->isM2Toe(),

                'w1_x' => $step->getW1X(),
                'w1_y' => $step->getW1Y(),
                'w1_rotate' => $step->isW1Rotate(),
                'w1_heel' => $step->isW1Heel(),
                'w1_toe' => $step->isW1Toe(),

                'w2_x' => $step->getW2X(),
                'w2_y' => $step->getW2Y(),
                'w2_rotate' => $step->getW2Rotate(),
                'w2_heel' => $step->isW2Heel(),
                'w2_toe' => $step->isW2Toe(),
            ];
        }
        return $this->json(["name" => $stepsequence->getName(),
            "badge" => $stepsequence->getBadge()->getName(),
            "dance" => $stepsequence->getDance()->getName(),
            "steps" =>$steps]);

    }
    #[Route('/stepsequence/get', name: 'app_step_get', methods: ['GET'])]
    public function getStepsequences(StepsequenceRepository $stepsequenceRepository) :JsonResponse
    {
        $stepsequences = $stepsequenceRepository->findAll();
        $data = [];

        foreach ($stepsequences as $sequence) {
            $steps = [];

            foreach ($sequence->getHowquick() as $step) {
                $steps[] = [
                    'howquick' => $step->getHowquick(),

                    'm1_x' => $step->getM1X(),
                    'm1_y' => $step->getM1Y(),
                    'm1_rotate' => $step->getM1Rotate(),
                    'm1_heel' => $step->isM1Heel(),
                    'm1_toe' => $step->isM1Toe(),

                    'm2_x' => $step->getM2X(),
                    'm2_y' => $step->getM2Y(),
                    'm2_rotate' => $step->getM2Rotate(),
                    'm2_heel' => $step->isM2Heel(),
                    'm2_toe' => $step->isM2Toe(),

                    'w1_x' => $step->getW1X(),
                    'w1_y' => $step->getW1Y(),
                    'w1_rotate' => $step->isW1Rotate(),
                    'w1_heel' => $step->isW1Heel(),
                    'w1_toe' => $step->isW1Toe(),

                    'w2_x' => $step->getW2X(),
                    'w2_y' => $step->getW2Y(),
                    'w2_rotate' => $step->getW2Rotate(),
                    'w2_heel' => $step->isW2Heel(),
                    'w2_toe' => $step->isW2Toe(),
                ];
            }

            $data[] = [
                'id' => $sequence->getId(),
                'name' => $sequence->getName(),
                'badge' => $sequence->getBadge()->getName(),
                'dance' => $sequence->getDance()->getName(),
                'steps' => $steps
            ];
        }

        return $this->json($data);
    }


}

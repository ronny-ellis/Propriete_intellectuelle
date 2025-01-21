<?php

namespace App\Controller;

use App\Entity\Licenses;
use App\Entity\User;
use App\Repository\LicensesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class LicenseApiController extends AbstractController{
    #[Route('/api/licenses', methods:['POST'])]
    public function create(EntityManagerInterface $em,#[MapRequestPayload(serializationContext:[
        'groups'=>['licenses.create']
        ])] Licenses $licenses){

            $userId = $licenses->getIdUser()->getId();
            $user = $em->getRepository(User::class)->find($userId);

            if (!$user) {
                return $this->json(['error' => 'User not found'], 404);
            }
            $licenses->setIdUser($user);
            $em->persist($licenses);
            $em->flush();
        return $this->json($licenses,200,[
            'groups'=>['licenses.show']
        ]);
    }
    #[Route('/api/licenses',methods:['GET'])]
    public function findAll(LicensesRepository $repository){
        $licenses=$repository->findAll();
        return $this->json($licenses,200,[
            'groups'=>['licenses.show']
        ]);
    }
    #[Route('/api/licenses/{id}',methods:['GET'],requirements:['id'=>Requirement::DIGITS])]
    public function findById(Licenses $licenses){
        return $this->json($licenses,200,[
            'groups'=>['licenses.show']
        ]);
    }
}

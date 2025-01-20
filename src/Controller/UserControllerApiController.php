<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class UserControllerApiController extends AbstractController{
    #[Route('/api/users', methods:'POST')]
    public function create(EntityManagerInterface $em,#[MapRequestPayload(serializationContext:[
        'groups'=>['users.create']
    ])] User $user){
        $em->persist($user);
        $em->flush();
        return $this->json($user,200,[
            'groups'=>['users.show']
        ]);
    }

    #[Route('/api/users', methods:'GET')]
    public function findAll(UserRepository $repository){
        $user=$repository->findAll();
        return $this->json($user,200,[
            'groups'=>['users.show']
        ]);
    }

    #[Route('/api/users/{id}', methods:'GET', requirements:['id'=>Requirement::DIGITS])]
    public function findById(User $user){
        return $this->json($user,200,[
            'groups'=>['users.show']
        ]);
    }
}

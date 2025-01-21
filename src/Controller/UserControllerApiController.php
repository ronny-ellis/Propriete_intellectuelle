<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

final class UserControllerApiController extends AbstractController{
    #[Route('/api/users', methods:['POST'])]
    public function create(EntityManagerInterface $em,#[MapRequestPayload(serializationContext:[
        'groups'=>['users.create']
    ])] User $user){
        $em->persist($user);
        $em->flush();
        return $this->json($user,200,[
            'groups'=>['users.show']
        ]);
    }

    #[Route('/api/users/login', methods:['POST'])]
    public function login(EntityManagerInterface $em, Request $request, UserRepository $repository,SerializerInterface $serializer){    
        $data = json_decode($request->getContent(), true);
        
        $user = $repository->findOneBy(['email' => $data['mail']]);
        if(!$user || $user->getMdp() != $data["mdp"]){
            return new JsonResponse(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }
        // $em->persist($user);
        // $em->flush();
        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getNom(),
        ], 200);
        
    }

    #[Route('/api/users', methods:['GET'])]
    public function findAll(UserRepository $repository){
        $user=$repository->findAll();
        return $this->json($user,200,[
            'groups'=>['users.show']
        ]);
    }

    #[Route('/api/users/{id}', methods:['GET'], requirements:['id'=>Requirement::DIGITS])]
    public function findById(User $user){
        return $this->json($user,200,[
            'groups'=>['users.show']
        ]);
    }
}

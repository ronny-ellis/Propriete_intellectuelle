<?php

namespace App\Controller;

use App\Entity\Deadlines;
use App\Repository\DeadlinesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class DeadlineApiController extends AbstractController{
    #[Route('/api/deadlines', methods:['POST'])]
    public function create(EntityManagerInterface $em,#[MapRequestPayload(serializationContext:[
        'groups'=>['deadlines.create']
    ])] Deadlines $deadlines){
        $em->persist($deadlines);
        $em->flush();
        return $this->json($deadlines,200,[
            'groups'=>['deadlines.show']
        ]);
    }
    #[Route('/api/deadlines', methods:"GET")]
    public function findAll(DeadlinesRepository $repository){
        $deadlines=$repository->findAll();
        return $this->json($deadlines,200,[
            'groups'=>['deadlines.show']
        ]);
    }
    #[Route('/api/deadlines/{id}',methods:"GET",requirements:['id'=>Requirement::DIGITS])]
    public function findById(Deadlines $deadlines){
        return $this->json($deadlines,200,[
            'groups'=>['deadlines.show']
        ]);
    }
}

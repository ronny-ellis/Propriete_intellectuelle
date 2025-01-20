<?php

namespace App\Controller;

use App\Entity\IpRight;
use App\Entity\Task;
use App\Repository\IpRightRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class IpRightControllerApiController extends AbstractController{
    
    #[Route('api/ip/rights',methods:"POST")]
    public function create(EntityManagerInterface $entityManager,#[MapRequestPayload(serializationContext : [
        'groups' => ['ipRight.create']
    ])] IpRight $ipRight){
        $entityManager->persist($ipRight);
        $entityManager->flush();
        return $this->json($ipRight,200,[
            'groups'=>['ipRight.show']
        ]);
    }

    #[Route('api/ip/rights',methods:"GET")]
    public function findAll(IpRightRepository $repository){
        $ipRight=$repository->findAll();
        return $this->json($ipRight,200,[
            'groups'=>['ipRight.show']
        ]);
    }

    #[Route('api/ip/rights/{id}',methods:"GET", requirements:['id'=>Requirement::DIGITS])]
    public function findById(IpRight $ipRight){
        return $this->json($ipRight,200,[
            'groups'=>['ipRight.show']
        ]);
    }
}

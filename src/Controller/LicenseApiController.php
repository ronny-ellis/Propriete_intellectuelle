<?php

namespace App\Controller;

// use ApiPlatform\OpenApi\Model\License;
use App\Entity\Licenses;
use App\Entity\User;
use App\Repository\LicensesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class LicenseApiController extends AbstractController
{
    #[Route('/api/licenses/', methods: ['POST'])]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        // Decode JSON request body
        $data = json_decode($request->getContent(), true);
    
        if (!isset($data['territoire'], $data['royalties'], $data['licencie'])) {
            return $this->json(['error' => 'Invalid input data'], 400);
        }
    
        // Fetch the user by ID
        $user = $em->getRepository(User::class)->find($data['idUser']);
        if (!$user) {
            return $this->json(['error' => 'User not found'], 404);
        }
    
        // Create new License entity
        $licenses = new Licenses();
        $licenses->setTerritoire($data['territoire']);
        $licenses->setRoyalties($data['royalties']);
        $licenses->setLicencie($data['licencie']);
        $licenses->setIdUser($user);
    
        // Persist and flush the new License
        $em->persist($licenses);
        $em->flush();
    
        // Return the created License
        return $this->json([
            'id' => $licenses->getId(),
            'territoire' => $licenses->getTerritoire(),
            'royalties' => $licenses->getRoyalties(),
            'licenci' => $licenses->getRoyalties(),
        ], 200);
    }
    
    
    #[Route('/api/licenses',methods:['GET'])]
    public function findAll(LicensesRepository $repository){
        $licenses=$repository->findAll();
            foreach ($licenses as $license) {
                $id = $license->getId();
                $user = $license->getIdUser()->getNom(); // Example: Access related User's name
                $territoire = $license->getTerritoire();
                $royalties = $license->getRoyalties();
                $licencie = $license->getLicencie();
        }
        return $this->json([
            'id'=>$id,
            'user'=>$user,
            'territoire'=>$territoire,
            'royalties'=>$royalties,
            'licencie'=>$licencie,
        ],200);
    }
    #[Route('/api/licenses/{id}',methods:['GET'],requirements:['id'=>Requirement::DIGITS])]
    public function findById(Licenses $licenses){
        return $this->json([
            'id' => $licenses->getId(),
            'territoire' => $licenses->getTerritoire(),
            'royalties' => $licenses->getRoyalties(),
            'licenci' => $licenses->getRoyalties(),
        ], 200);
    }
}

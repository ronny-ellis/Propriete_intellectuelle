<?php

namespace App\Controller;

use ApiPlatform\OpenApi\Model\License;
use App\Entity\Licenses;
use App\Entity\User;
use App\Repository\LicensesRepository;
use App\DTO\LicensesDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Validator\Constraints\Length;

final class LicenseApiController extends AbstractController{
    #[Route('/api/licenses/{id}', methods:['POST'])]
    public function create(EntityManagerInterface $em, int $id, Request $request){
            $data = json_decode($request->getContent());

            $licenses = new Licenses();

            $licenses->setTerritoire($data["territoire"]);
            $licenses->setRoyalties($data["royalties"]);
            $licenses->setLicencie($data["licencie"]);

            $user = $em->getRepository(User::class)->find($id);
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
        // TY le tsy mande
        return $this->json($licenses,200, [
            'groups' => 'licenses.show',
        ]);
    }
    #[Route('/api/licenses/{id}',methods:['GET'],requirements:['id'=>Requirement::DIGITS])]
    public function findById(Licenses $licenses){
        return $this->json($licenses,200,[
            'groups'=>['licenses.show']
        ]);
    }
}

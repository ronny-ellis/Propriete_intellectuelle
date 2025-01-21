<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class LitigesApiController extends AbstractController{
    #[Route('/api/litiges', name: 'app_litiges_api')]
    public function create(EntityManagerInterface $em,Request $request)
    {
        
    }
}

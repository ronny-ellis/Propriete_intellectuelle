<?php

namespace App\DTO;

use ApiPlatform\OpenApi\Model\License;
use App\Entity\Licenses;
use App\Entity\User;

class LicensesDTO
{
    public $id;
    public $idUser;
    public $territoire;
    public $royalties;
    public $licencie;

    public function __construct(Licenses $license)
    {
        $this->id = $license->getId();
        $this->territoire = $license->getTerritoire();
        $this->royalties = $license->getRoyalties();
        $this->licencie = $license->getLicencie();
        $this->idUser = array_map(function (User $user){
            return [
                'id'=> $user->getId(),
                'nom' => $user->getNom(),
                'email' => $user->getEmail()
            ];
        }, $license->getIdUser()->toArray());

    }
}
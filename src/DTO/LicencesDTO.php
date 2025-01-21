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
        $this->idUser = is_array($license->getIdUser()) 
        ? array_map(function (User $user){
            if($user instanceof User){
                return [
                    'id'=> $user->getId(),
                    'nom' => $user->getNom(),
                    'email' => $user->getEmail()
                ];
            }
            return null;
        }, $this->toArray($license->getIdUser()))
        : [];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'territoire' => $this->territoire,
            'royalties' => $this->royalties,
            'licencie' => $this->licencie,
            'idUser' => $this->idUser,
        ];
    }
}
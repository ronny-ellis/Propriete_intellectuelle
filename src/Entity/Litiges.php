<?php

namespace App\Entity;

use App\Repository\LitigesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LitigesRepository::class)]
class Litiges
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'litiges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?IpRight $idIpRight = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $resultat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdIpRight(): ?IpRight
    {
        return $this->idIpRight;
    }

    public function setIdIpRight(?IpRight $idIpRight): static
    {
        $this->idIpRight = $idIpRight;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }
}

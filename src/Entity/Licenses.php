<?php

namespace App\Entity;

use App\Repository\LicensesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LicensesRepository::class)]
class Licenses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['licenses.show'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'licenses')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['licenses.show','licenses.create'])]
    private ?User $idUser = null;

    #[ORM\Column(length: 255)]
    #[Groups(['licenses.show','licenses.create'])]
    private ?string $territoire = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    #[Groups(['licenses.show','licenses.create'])]
    private ?string $royalties = null;

    #[ORM\Column(length: 255)]
    #[Groups(['licenses.show','licenses.create'])]
    private ?string $licencie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getTerritoire(): ?string
    {
        return $this->territoire;
    }

    public function setTerritoire(string $territoire): static
    {
        $this->territoire = $territoire;

        return $this;
    }

    public function getRoyalties(): ?string
    {
        return $this->royalties;
    }

    public function setRoyalties(string $royalties): static
    {
        $this->royalties = $royalties;

        return $this;
    }

    public function getLicencie(): ?string
    {
        return $this->licencie;
    }

    public function setLicencie(string $licencie): static
    {
        $this->licencie = $licencie;

        return $this;
    }
}
